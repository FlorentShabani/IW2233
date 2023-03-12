<?php
require_once('db\config.php');

if (!isset($_SESSION)) {
    session_start();
}

class usersCRUD extends config
{

    private $pdo;

    private $id;
    private $fullname;
    private $username;
    private $email;
    private $birthdate;
    private $password;
    private $role;

    public function __construct($pdo = null, $id = null, $fullname = null, $username = null, $email = null, $birthdate = null, $password = null, $role = 'user')
    {
        $this->pdo = $pdo;
        $this->id = $id;
        $this->fullname = $fullname;
        $this->username = $username;
        $this->email = $email;
        $this->birthdate = $birthdate;
        $this->password = $password;
        $this->role = $role;
    }

    function createUser($fullname, $username, $email, $birthdate, $password, $role = 'user')
    {
        try {
            if (empty($fullname) || empty($username) || empty($email) || empty($birthdate) || empty($password)) {
                return "All fields are required";
            }

            if (!preg_match('/^[A-Za-z]+\s[A-Za-z]+$/', $fullname)) {
                return "Invalid fullname";
            }

            if (!preg_match('/^[a-zA-Z0-9_]{3,16}$/', $username)) {
                return "Invalid username";
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return "Invalid email address";
            }

            if (!preg_match('/^(19|20)\d{2}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/', $birthdate)) {
                return "Invalid birthdate format. Please use yyyy-mm-dd format";
            }

            if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $password)) {
                return "Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one number";
            }

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->pdo->prepare("INSERT INTO users (fullname, username, email, birthdate, password, role) VALUES (:fullname, :username, :email, :birthdate, :password, :role)");
            $stmt->bindParam(':fullname', $fullname);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':birthdate', $birthdate);
            $stmt->bindParam(':password', $hashed_password);
            $stmt->bindParam(':role', $role);
            $stmt->execute();
            return "Successfully created your account";
        } catch (PDOException $e) {
            return "Error creating user: " . $e->getMessage();
        }
    }

    function readAllUsers()
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM users");
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $users;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    function updateUser($id, $fullname, $username, $email, $birthdate, $role, $emp_picture)
    {
        try {
            // File upload handling
            if (isset($_FILES['emp_picture']) && $_FILES['emp_picture']['error'] == 0) {
                $file_name = $_FILES['emp_picture']['name'];
                $file_size = $_FILES['emp_picture']['size'];
                $file_tmp = $_FILES['emp_picture']['tmp_name'];
                $file_type = $_FILES['emp_picture']['type'];
                $file_ext = strtolower(pathinfo($_FILES['emp_picture']['name'], PATHINFO_EXTENSION));

                $extensions = array("jpeg", "jpg", "png");

                if (in_array($file_ext, $extensions) === false) {
                    return "extension not allowed, please choose a JPEG or PNG file.";
                }

                if ($file_size > 200000000) {
                    return 'File size must be under 200 MB';
                }

                $file_path = "style/images/emp/" . $file_name;
                move_uploaded_file($file_tmp, "style/images/emp/" . $file_name);
            } else {
                $file_path = null;
            }

            if (empty($fullname) || empty($username) || empty($email) || empty($birthdate)) {
                return "All fields are required";
            }

            if (!preg_match('/^[A-Za-z]+\s[A-Za-z]+$/', $fullname)) {
                return "Invalid fullname";
            }

            if (!preg_match('/^[a-zA-Z0-9_]{3,16}$/', $username)) {
                return "Invalid username";
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return "Invalid email address";
            }

            if (!preg_match('/^(19|20)\d{2}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/', $birthdate)) {
                return "Invalid birthdate format. Please use yyyy-mm-dd format";
            }

            $stmt = $this->pdo->prepare("UPDATE users SET fullname = :fullname, username = :username, email = :email, birthdate = :birthdate, role = :role, emp_picture = IF(:emp_picture IS NOT NULL, :emp_picture, emp_picture) WHERE id = :id");
            $stmt->bindParam(':fullname', $fullname);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':birthdate', $birthdate);
            $stmt->bindParam(':role', $role);
            $stmt->bindParam(':emp_picture', $file_path);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    function getUserById($userId)
    {

        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE id = :userId');

        $stmt->bindParam(':userId', $userId);

        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user;
    }

    function deleteUser($ID)
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
            $stmt->execute([$ID]);
            header("Location: usersDash.php");
            exit;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    function login($username, $password)
    {
        try {
            $message = '';
    
            $query = $this->pdo->prepare('SELECT id, fullname, username, email, password, role FROM users WHERE username = :username');
            $query->bindParam(':username', $username);
            $query->execute();
    
            $user = $query->fetch(PDO::FETCH_ASSOC);
    
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['username'] = $user['username'];
                $_SESSION['password'] = $user['password'];
                $_SESSION['role'] = $user['role']; // Set the session role for the user
                header("Location: index.php");
            } else {
                $message = 'Invalid username or password.';
            }
    
            return $message;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function fetchRole($username) {
        try {
            $stmt = $this->pdo->prepare("SELECT role FROM users WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result['role'];
        } catch (PDOException $e) {
            return false;
        }
    }

    function fetchEmployeeRoles()
    {
        try {
            $query = $this->pdo->prepare("SELECT emp_picture, fullname FROM users WHERE role = 'employee'");
            $query->execute();

            $emp = $query->fetchAll(PDO::FETCH_ASSOC);

            return $emp;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getFullname()
    {
        return $this->fullname;
    }

    public function setFullname($fullname)
    {
        $this->fullname = $fullname;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getBirthdate()
    {
        return $this->birthdate;
    }

    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }
}
?>
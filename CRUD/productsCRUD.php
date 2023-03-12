<?php
require_once('db/config.php');

if (!isset($_SESSION)) {
    session_start();
}

class productsCRUD extends config
{
    private $name;
    private $price;
    private $image;
    private $description;
    private $user_added;
    private $date_added;
    private $pdo;

    public function __construct($pdo = null, $name = null, $price = null, $image = null, $description = null, $user_added = null, $date_added = null)
    {
        $this->pdo = $pdo;
        $this->name = $name;
        $this->price = $price;
        $this->image = $image;
        $this->description = $description;
        $this->user_added = $user_added;
        $this->date_added = $date_added;
    }


    public function shfaqTeGjithaProduktet()
    {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM products;');
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function deleteProduct($ID)
    {
        try {
            $stm = $this->pdo->prepare('DELETE FROM products WHERE prodid = ?');
            $stm->execute([$ID]);

            header("Location: productsDash.php");
            exit;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function addProduct($name, $price, $description, $image, $user_added = null, $date_added)
    {

        try {
            // File upload handling
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_tmp = $_FILES['image']['tmp_name'];
                $file_type = $_FILES['image']['type'];
                $file_ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

                $extensions = array("jpeg", "jpg", "png");

                if (in_array($file_ext, $extensions) === false) {
                    return "extension not allowed, please choose a JPEG or PNG file.";
                }

                if ($file_size > 200000000) {
                    return 'File size must be under 200 MB';
                }

                $file_path = "style/images/" . $file_name;
                move_uploaded_file($file_tmp, "style/images/" . $file_name);
            }

            if (empty($name) || empty($price) || empty($description)) {
                return "All fields are required";
            }
            
            if (!preg_match('/^[\w\s&.\'-]+$/', $name)) {
                return "Name can only contain letters, numbers, and spaces.";
            }
    
            if (!preg_match('/^\d{1,}\.\d{2}$/', $price)) {
                return "Price must be a number with up to 2 decimal places.";
            }
    
            if (!preg_match('/^.{1,100}$/', $description)) {
                return "Description can only contain letters, numbers, and spaces.";
            }

            $stmt = $this->pdo->prepare("INSERT INTO products (name, price, description, image, user_added, date_added) VALUES (:name, :price, :description, :image, :user_added, :date_added)");

            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':image', $file_path);
            $stmt->bindParam(':user_added', $user_added);
            $stmt->bindParam(':date_added', $date_added);

            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function updateProduct($prodid, $name, $price, $description, $image, $user_added = null, $date_added)
    {
        try {
            // File upload handling
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_tmp = $_FILES['image']['tmp_name'];
                $file_type = $_FILES['image']['type'];
                $file_ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

                $extensions = array("jpeg", "jpg", "png");

                if (in_array($file_ext, $extensions) === false) {
                    return "extension not allowed, please choose a JPEG or PNG file.";
                }

                if ($file_size > 200000000) {
                    return 'File size must be under 200 MB';
                }

                $file_path = "style/images/" . $file_name;
                move_uploaded_file($file_tmp, "style/images/" . $file_name);
            } else {
                $file_path = null;
            }

            if (empty($name) || empty($price) || empty($description)) {
                return "All fields are required";
            }
            
            if (!preg_match('/^[\w\s&.\'-]+$/', $name)) {
                return "Name can only contain letters, numbers, and spaces.";
            }
    
            if (!preg_match('/^\d{1,}\.\d{2}$/', $price)) {
                return "Price must be a number with up to 2 decimal places.";
            }
    
            if (!preg_match('/^.{1,100}$/', $description)) {
                return "Description can only contain letters, numbers, and spaces.";
            }

            $stmt = $this->pdo->prepare("UPDATE products SET name = :name, price = :price, description = :description, image = IF(:image IS NOT NULL, :image, image), user_added = :user_added, date_added = :date_added WHERE prodid = :prodid");

            $stmt->bindParam(':prodid', $prodid);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':image', $file_path);
            $stmt->bindParam(':user_added', $user_added);
            $stmt->bindParam(':date_added', $date_added);

            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    function getProdById($prodid)
    {

        $stmt = $this->pdo->prepare('SELECT * FROM products WHERE prodid = :prodid');

        $stmt->bindParam(':prodid', $prodid);

        $stmt->execute();

        $prod = $stmt->fetch(PDO::FETCH_ASSOC);

        return $prod;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }
    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getUserAdded()
    {
        return $this->user_added;
    }

    public function setUserAdded($user_added)
    {
        $this->user_added = $user_added;
    }

    public function getDateAdded()
    {
        return $this->date_added;
    }

    public function setDateAdded($date_added)
    {
        $this->date_added = $date_added;
    }

}
?>
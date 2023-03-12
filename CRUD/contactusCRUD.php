<?php
require_once('db\config.php');

if (!isset($_SESSION)) {
    session_start();
}
class contactusCRUD extends config
{
    private $pdo;
    private $fullname;
    private $email;
    private $subject;
    private $message;

    public function __construct($pdo = null, $fullname = null, $email = null, $subject = null, $message = null)
    {
        $this->fullname = $fullname;
        $this->email = $email;
        $this->subject = $subject;
        $this->message = $message;
        $this->pdo = $pdo;
    }

    

    public function shfaqTeGjithaMessages()
    {
        try {
            $stm = $this->pdo->prepare('SELECT * FROM contactus;');
            $stm->execute();

            return $stm->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function deleteMessage($ID)
    {
        try{
            $stm = $this->pdo->prepare('DELETE FROM contactus WHERE id = ?');
            $stm->execute([$ID]);

            header("Location: contactusDash.php");
            exit;
        } catch(Exception $e){
            return $e->getMessage();
        }
    }
    
    public function saveToDatabase($fullname, $email, $subject, $message)
    {
        try{
            if (empty($fullname) || empty($email) || empty($subject) || empty($message)){
                return "All fields are required";
            }
            
            if (!preg_match('/^[A-Za-z]+\s[A-Za-z]+$/', $fullname)) {
                return "Invalid fullname";
            }
    
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return "Invalid email address";
            }
    
            if (!preg_match('/^[a-zA-Z0-9 ]{3,100}$/', $subject)) {
                return "Invalid subject";
            }

            if (!preg_match('/^[a-zA-Z0-9 .,!?\-]{3,480}$/', $subject)) {
                return "Invalid message";
            }

            $query = $this->pdo->prepare('INSERT INTO contactus (fullname, email, subject, message) VALUES (:fullname, :email, :subject, :message)');
            $query->bindParam(':fullname', $fullname);
            $query->bindParam(':email', $email);
            $query->bindParam(':subject', $subject);
            $query->bindParam(':message', $message);
    
            $query->execute();
        }catch(PDOException $e){
            return $message = 'Your information is invalid!';
        }

        if ($query->rowCount() > 0) {
            return $message = "Successfully sent your message";
        } else {
            return $message = "A problem occurred sending your message";
        }
    }

    public function setFullname($fullname)
    {
        $this->fullname = $fullname;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function getFullName()
    {
        return $this->fullname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function getMessage()
    {
        return $this->message;
    }

}
?>
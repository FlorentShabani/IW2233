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
        try{
            $stm = $this->pdo->prepare('DELETE FROM products WHERE prodid = ?');
            $stm->execute([$ID]);

            header("Location: productsDash.php");
            exit;
        } catch(Exception $e){
            return $e->getMessage();
        }
    }

    public function shtoProd()
    {
        //do later
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
<?php 
class Producten
{
    public $set_id;
    public $setNaam;
    public $setDiscription;
    public $Merk_id;
    public $setThema_id;
    public $setPrijs;
    public $setImage;
    public $setAantal;
    public $setLeeftijd;
    public $setStukjes;
    public $setVoorraad;

    public static function findProducten()
    {
        $conn = Database::start();

        $sql = "SELECT * FROM sets";
        $result = $conn->query($sql);

        $producten = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $product = new Producten();
                $product->set_id = $row["set_id"];
                $product->setNaam = $row["set_name"];
                $product->setDiscription = $row["set_description"];
                $product->Merk_id = $row["set_brand_id"];
                $product->setThema_id = $row["set_theme_id"];
                $product->setPrijs = $row["set_price"];
                $product->setImage = $row["set_image"];
                $product->setAantal = $row["set_stock"];
                $product->setLeeftijd = $row["set_age"];
                $product->setStukjes = $row["set_pieces"];
                $product->setVoorraad = $row["set_stock"];

                array_push($producten, $product);
            }
        }

        return $producten;
    }
    public static function deleteProduct($set_id)
    {
        $conn = Database::start();

        $set_id = mysqli_real_escape_string($conn, $set_id);

        $sql = "DELETE FROM sets WHERE set_id = '$set_id'";
        $conn->query($sql);
    }
    public function insert()
    {
        $conn = Database::start();

        $setNaam = mysqli_real_escape_string($conn, $this->setNaam);
        $setDiscription = mysqli_real_escape_string($conn, $this->setDiscription);
        $Merk_id = mysqli_real_escape_string($conn, $this->Merk_id);
        $setThema_id = mysqli_real_escape_string($conn, $this->setThema_id);
        $setPrijs = mysqli_real_escape_string($conn, $this->setPrijs);
        $setImage = mysqli_real_escape_string($conn, $this->setImage);
        $setAantal = mysqli_real_escape_string($conn, $this->setAantal);
        $setLeeftijd = mysqli_real_escape_string($conn, $this->setLeeftijd);
        $setStukjes = mysqli_real_escape_string($conn, $this->setStukjes);

        $sql = "INSERT INTO sets (
            set_name,
            set_description,
            set_brand_id,
            set_theme_id,
            set_price,
            set_image,
            set_stock,
            set_age,
            set_pieces
        ) VALUES (
            '$setNaam',
            '$setDiscription',
            '$Merk_id',
            '$setThema_id',
            '$setPrijs',
            '$setImage',
            '$setAantal',
            '$setLeeftijd',
            '$setStukjes'
        )";

        $conn->query($sql);
    }
}
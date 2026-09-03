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
}
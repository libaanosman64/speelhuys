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
    public $Merk_naam;
    public $Merk_logo;
    public $Thema_id;
    public $Thema_naam;
    



    public static function findProducten($limit = null, $offset = 0)
    {
        $conn = Database::start();

        $sql = "SELECT * FROM sets ORDER BY set_id DESC";
        if ($limit !== null) {
            $sql .= " LIMIT " . $limit . " OFFSET " .  $offset;
        }
        $result = $conn->query($sql);
        $producten = [];

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
                $producten[] = $product;
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
    public function insertProduct()
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

    public static function findProductById($set_id)
    {
        $conn = Database::start();

        $sql = "SELECT * FROM sets WHERE set_id = '$set_id'";
        $result = $conn->query($sql);

        $product = null;

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
            }
        }
        $conn->close();
        return $product;
    }
    public static function findMerkById($Merk_id)
    {
        $conn = Database::start();

        $sql = "SELECT * FROM brands WHERE brand_id = '$Merk_id'";
        $result = $conn->query($sql);

        $merk = null;

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $merk = new Producten();
                $merk->Merk_id = $row["brand_id"];
                $merk->Merk_naam = $row["brand_name"];
                $merk->Merk_logo = $row["brand_logo"];
            }
        }
        $conn->close();
        return $merk;
    }
    public static function findThemas()
    {
        $conn = Database::start();

        $sql = "SELECT * FROM themes";
        $result = $conn->query($sql);
        $themas = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $thema = new Producten();
                $thema->Thema_id = $row["theme_id"];
                $thema->Thema_naam = $row["theme_name"];
                $themas[] = $thema;
            }
        }

        return $themas;
    }
    public static function findThemaById($setThema_id)
    {
        $conn = Database::start();

        $sql = "SELECT * FROM themes WHERE theme_id = '$setThema_id'";
        $result = $conn->query($sql);

        $thema = null;

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $thema = new Producten();
                $thema->Thema_id = $row["theme_id"];
                $thema->Thema_naam = $row["theme_name"];
            }
        }
        $conn->close();
        return $thema;  
    }

    public static function pages()
    {
        $conn = Database::start();
        $result = $conn->query("SELECT COUNT(*) AS total FROM sets");
        $row = $result->fetch_assoc();
        $conn->close();

        return (int) ceil($row['total'] / 6);
    }

    public static function findMerken()
    {
        $conn = Database::start();

        $result = $conn->query("SELECT * FROM brands");
        $merken = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $merk = new Producten();
                $merk->Merk_id = $row["brand_id"];
                $merk->Merk_naam = $row["brand_name"];
                $merk->Merk_logo = $row["brand_logo"];
                $merken[] = $merk;
            }
        }

        $conn->close();
        return $merken;
    }
    public static function filter($zoekterm = '', $themaId = null, $prijsVolgorde = null, $limit = null, $offset = 0)
    {
        $conn = Database::start();
        $zoekterm = mysqli_real_escape_string($conn, trim($zoekterm));

        $voorwaarden = [];
        if ($zoekterm !== '') {
            $voorwaarden[] = "set_name LIKE '%$zoekterm%'";
        }
        if ($themaId !== null) {
            $voorwaarden[] = "set_theme_id = " . (int) $themaId;
        }

        $sql = "SELECT * FROM sets";
        if (count($voorwaarden) > 0) {
            $sql .= " WHERE " . implode(" AND ", $voorwaarden);
        }

        if ($prijsVolgorde === 'hoog-laag') {
            $sql .= " ORDER BY set_price DESC";
        } elseif ($prijsVolgorde === 'laag-hoog') {
            $sql .= " ORDER BY set_price ASC";
        } else {
            $sql .= " ORDER BY set_id DESC";
        }

        if ($limit !== null) {
            $sql .= " LIMIT " . $limit . " OFFSET " . $offset;
        }

        $result = $conn->query($sql);
        $producten = [];

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
                $producten[] = $product;
            }
        }

        $conn->close();
        return $producten;
    }

}   
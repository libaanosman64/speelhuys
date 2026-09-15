<?php
class Merk
{
    public $Merk_id;
    public $Merk_naam;
    public $Merk_logo;

    public static function findMerken()
    {
        $conn = Database::start();

        $result = $conn->query("SELECT * FROM brands");
        $merken = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $merk = new Merk();
                $merk->Merk_id = $row["brand_id"];
                $merk->Merk_naam = $row["brand_name"];
                $merk->Merk_logo = $row["brand_logo"];
                $merken[] = $merk;
            }
        }

        $conn->close();
        return $merken;
    }

    public function insertMerk()
    {
        $conn = Database::start();
        $naam = mysqli_real_escape_string($conn, $this->Merk_naam);
        $logo = mysqli_real_escape_string($conn, $this->Merk_logo);

        $sql = "INSERT INTO brands (brand_name, brand_logo) VALUES ('$naam', '$logo')";
        $conn->query($sql);
    }

    public static function deleteMerk($merkId)
    {
        $conn = Database::start();
        $merkId = (int) $merkId;

        $sql = "SELECT COUNT(*) AS aantal FROM sets WHERE set_brand_id = '$merkId'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        if ((int) $row['aantal'] > 0) {
            $conn->close();
            return false;
        }

        $sql = "DELETE FROM brands WHERE brand_id = '$merkId'";
        $result = $conn->query($sql);
        $conn->close();

        return $result;
    }

    public static function findMerkById($merkId)
    {
        $conn = Database::start();
        $merkId = (int) $merkId;

        $sql = "SELECT * FROM brands WHERE brand_id = '$merkId'";
        $result = $conn->query($sql);
        $merk = null;

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $merk = new Merk();
            $merk->Merk_id = $row["brand_id"];
            $merk->Merk_naam = $row["brand_name"];
            $merk->Merk_logo = $row["brand_logo"];
        }

        $conn->close();
        return $merk;
    }
}

<?php
class Thema
{
    public $Thema_id;
    public $Thema_naam;

    public static function findThemas()
    {
        $conn = Database::start();

        $sql = "SELECT * FROM themes";
        $result = $conn->query($sql);
        $themas = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $thema = new Thema();
                $thema->Thema_id = $row["theme_id"];
                $thema->Thema_naam = $row["theme_name"];
                $themas[] = $thema;
            }
        }

        return $themas;
    }

    public function insertThema()
    {
        $conn = Database::start();
        $naam = mysqli_real_escape_string($conn, $this->Thema_naam);

        $sql = "INSERT INTO themes (theme_name) VALUES ('$naam')";
        $conn->query($sql);
    }

    public static function deleteThema($themaId)
    {
        $conn = Database::start();
        $themaId = (int) $themaId;

        $sql = "SELECT COUNT(*) AS aantal FROM sets WHERE set_theme_id = '$themaId'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        if ($row['aantal'] > 0) {
            $conn->close();
            return false;
        }

        $sql = "DELETE FROM themes WHERE theme_id = '$themaId'";
        $result = $conn->query($sql);
        $conn->close();

        return $result;
    }

    public static function findThemaById($themaId)
    {
        $conn = Database::start();
        $themaId = (int) $themaId;

        $sql = "SELECT * FROM themes WHERE theme_id = '$themaId'";
        $result = $conn->query($sql);
        $thema = null;

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $thema = new Thema();
            $thema->Thema_id = $row["theme_id"];
            $thema->Thema_naam = $row["theme_name"];
        }

        $conn->close();
        return $thema;
    }

    public function updateThema()
    {
        $conn = Database::start();

        $naam = mysqli_real_escape_string($conn, $this->Thema_naam);
        $id = mysqli_real_escape_string($conn, $this->Thema_id);

        $sql = "UPDATE themes SET
            theme_name = '$naam'
            WHERE theme_id = '$id'";

        $conn->query($sql);
    }
}

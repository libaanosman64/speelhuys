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

    public static function insertThema($naam)
    {
        $conn = Database::start();
        $naam = mysqli_real_escape_string($conn, ($naam));

        if ($naam === '') {
            $conn->close();
            return false;
        }

        $sql = "INSERT INTO themes (theme_name) VALUES ('$naam')";
        $result = $conn->query($sql);
        $conn->close();

        return $result;
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
}

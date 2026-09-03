<?php 

class Gebruiker
{
    public $gebruikerid;
    public $gebruikersnaam;
    public $wachtwoord;
    public $rol;
    public $voornaam;
    public $achternaam;
    public $email;
   
    public static function findGebruiker($gebruikersnaam, $wachtwoord)
    {
         $conn = Database::start();

        $username = mysqli_real_escape_string($conn, $gebruikersnaam);
        $password = mysqli_real_escape_string($conn, $wachtwoord);

        $sql = "SELECT * FROM users WHERE user_username = '" . $gebruikersnaam . "' AND user_password = '" . $wachtwoord . "'";
        $result = $conn->query($sql);

        $gebruiker = null;

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $gebruiker = new Gebruiker();
                $gebruiker->gebruikersnaam = $row["user_username"];
                $gebruiker->wachtwoord = $row["user_password"];
                $gebruiker->voornaam = $row["user_firstname"];
                $gebruiker->achternaam = $row["user_lastname"];
                $gebruiker->gebruikerid = $row["user_id"];
                $gebruiker->rol = $row["user_role"];
            }
        }

        $conn->close();
        return $gebruiker;
    }
      public static function findGebruikerByid($user_id)
    {
       $conn = Database::start();

        $user_id = mysqli_real_escape_string($conn, $user_id);

        $sql = "SELECT * FROM users WHERE user_id = '" . $user_id . "'";
        $result = $conn->query($sql);

        $gebruiker = null;

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $gebruiker = new Gebruiker();
                $gebruiker->gebruikersnaam = $row["user_username"];
                $gebruiker->wachtwoord = $row["user_password"];
                $gebruiker->voornaam = $row["user_firstname"];
                $gebruiker->achternaam = $row["user_lastname"];
                $gebruiker->gebruikerid = $row["user_id"];
                $gebruiker->rol = $row["user_role"];
            }
        }
        



        $conn->close();
        return $gebruiker;
    }
}



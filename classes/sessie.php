<?php 

 class Sessie 
 {
    public $sessie_id;
    public $sessie_gebruiker_id;
    public $sessie_key;
    public $sessie_start;
    public $sessie_end;

    public function insert()
    {
         $conn = Database::start();

        $sessie_gebruiker_id = mysqli_real_escape_string($conn, $this->sessie_gebruiker_id);
        $sessie_key = mysqli_real_escape_string($conn, $this->sessie_key);
        $sessie_start = mysqli_real_escape_string($conn, $this->sessie_start);
        $sessie_end = mysqli_real_escape_string($conn, $this->sessie_end);

        $sql = "INSERT INTO sessions (
      session_user_id,
      session_key,
      session_start,
      session_end
  ) VALUES (
      '$sessie_gebruiker_id',
      '$sessie_key',
      '$sessie_start',
      '$sessie_end'
  )";

        $conn->query($sql);
    }

    public static function endSessie($sessie_key)
    {
        $conn = Database::start();
        $session_key = mysqli_real_escape_string($conn, $sessie_key);
        $sql = "DELETE FROM `sessions` WHERE session_key = '$session_key'";
        $conn->query($sql);
        $conn->close();
    }

    public static function findSessie($sessie_key)
    {
        $sessie = null;

        $conn = Database::start();

         $session_key = mysqli_real_escape_string($conn, $_COOKIE["speelhuys-session"]);

            $sql = "SELECT * FROM `sessions` WHERE session_key = '$session_key'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $sessie = new Sessie();
                    $sessie->sessie_gebruiker_id = $row["session_user_id"];
                    $sessie->sessie_key = $row["session_key"];
                    $sessie->sessie_start = $row["session_start"];
                    $sessie->sessie_end = $row["session_end"];
                }
            }
        
        $conn->close();
        return $sessie;

        
    }
 }
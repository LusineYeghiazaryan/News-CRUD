<?php
/**
 * Подключаемся к базе
*/

class ConnectDb {
  // Hold the class instance.
  private static $instance = null;
  private $conn;
  
  private $host = 'localhost';
  private $user = 'root';
  private $pass = '';
  private $name = 'crud';
   
  // The db connection is established in the private constructor.
  private function __construct()
  {
	$this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
  }
  
  public static function getInstance()
  {
    if(!self::$instance)
    {
      self::$instance = new ConnectDb();
    }
   
    return self::$instance;
  }
  
  public function getConnection()
  {
    return $this->conn;
  }
}

$mysqli = ConnectDb::getInstance();
$conn = $mysqli->getConnection();

?>

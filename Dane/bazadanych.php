<?php
class Database {

  protected $host;
  protected $user;
  protected $pwd;
  protected $dbName;
  protected $dbLink;
  protected $result;
  protected $resultObj;

  function __construct($host, $user, $pwd, $dbName){
    $this->host = $host;
    $this->user = $user;
    $this->pwd = $pwd;
    $this->dbName = $dbName;
        $this->connect();
    }

  // Po��cz si� z serwerem mySQL i wybierz baz� danych 
  public function connect() {
    try {
      $this->dbLink = @mysqli_connect($this->host, $this->user, $this->pwd, $this->dbName);
      if (!$this->dbLink) {
        throw new Exception ("Nie mo�na by�o po��czy� u�ytkownika $this->user z baz� $this->dbName");
        }
      }
    catch (Exception $e) {
      echo $e->getMessage();
      exit();
      }
    return $this->dbLink;
    }

 // Wykonaj zapytanie SQL 
  public function query($query) {
    try {
      $this->result = mysqli_query($this->dbLink, $query);
      if (!$this->result) {
        throw new Exception ('B��d MySQL: ' . mysqli_error($this->dbLink));
        }
      }
    catch (Exception $e) {
      echo $e->getMessage();
      exit();
      }
        // zapisz wynik do nowego obiektu, kt�ry b�dzie imitowa� interfejs mysqli OO 
        $this->resultObj = new MyResult($this->result);
        return $this->resultObj;
    }

   // zamknij po��czenie MySQL
  public function close(){
    mysqli_close($this->dbLink);
    }   
  }

class MyResult {

  protected $theResult;
  public $num_rows;
  
  function __construct($r) {
      if (is_bool($r)) {
            $this->num_rows = 0;
                }
          else {
            $this->theResult = $r;
            // pobierz ca�kowit� liczb� znalezionych rekord�w
            $this->num_rows = mysqli_num_rows($r);
                }
        }
  
  // pobierz asocjacyjn� tablic� wynik�w (przetwarza naraz jeden wiersz)  
  function fetch_assoc() {
    $newRow = mysqli_fetch_assoc($this->theResult);
        return $newRow;
        }
  }
?>

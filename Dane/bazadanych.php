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

  // Po³¹cz siê z serwerem mySQL i wybierz bazê danych 
  public function connect() {
    try {
      $this->dbLink = @mysqli_connect($this->host, $this->user, $this->pwd, $this->dbName);
      if (!$this->dbLink) {
        throw new Exception ("Nie mo¿na by³o po³¹czyæ u¿ytkownika $this->user z baz¹ $this->dbName");
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
        throw new Exception ('B³¹d MySQL: ' . mysqli_error($this->dbLink));
        }
      }
    catch (Exception $e) {
      echo $e->getMessage();
      exit();
      }
        // zapisz wynik do nowego obiektu, który bêdzie imitowaæ interfejs mysqli OO 
        $this->resultObj = new MyResult($this->result);
        return $this->resultObj;
    }

   // zamknij po³¹czenie MySQL
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
            // pobierz ca³kowit¹ liczbê znalezionych rekordów
            $this->num_rows = mysqli_num_rows($r);
                }
        }
  
  // pobierz asocjacyjn¹ tablicê wyników (przetwarza naraz jeden wiersz)  
  function fetch_assoc() {
    $newRow = mysqli_fetch_assoc($this->theResult);
        return $newRow;
        }
  }
?>

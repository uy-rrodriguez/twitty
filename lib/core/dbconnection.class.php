<?php

define ('HOST', 'pedago02a.univ-avignon.fr') ;
define ('USER', 'uapv1602799'  ) ;
define ('PASS', 'cFHJEJ' ) ;
define ('DB', 'etd' ) ;

class dbconnection
{
  private $link, $error ;

  public function __construct()
  {
    $this->link = null;
    $this->error = null;
    try {
        $this->link = new PDO( "pgsql:host=" . HOST . ";dbname=" . DB . ";user=" . USER . ";password=" . PASS );
        $this->link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } 
	catch( PDOException $e ) {
        $this->error =  $e->getMessage();
    }
  }

  public function getLastInsertId($att) {
    return $this->link->lastInsertId($att."_id_seq");
  }

  public function doExec($sql) {
    $prepared = $this->link->prepare( $sql );
    return $prepared->execute();
  }

  public function doQuery($sql) {
    $prepared = $this->link->prepare($sql);
    $prepared->execute();
    $res = $prepared->fetchAll( PDO::FETCH_ASSOC );
   
    return $res;
  }

  public function doQueryObject($sql,$className) {
    $prepared = $this->link->prepare($sql);
    $prepared->execute();
    $res = $prepared->fetchAll(PDO::FETCH_CLASS, $className);
   
    return $res;
  }

  public function __destruct() {
    $this->link = null;
  }
}

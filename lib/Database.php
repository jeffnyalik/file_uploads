<?php
class Database{
  public $host = DB_HOST;
  public $user = DB_USER;
  public $pass = DB_PASS;
  public $dbname= DB_NAME;

  // connection paramerters
  public $link;
  public $error;

  public function __construct(){
     $this->connectDB();
  }

  private function connectDB(){
    $this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
    if(!$this->link){
      $this->error = "failed to connect to the databse".$this->link.connect_error;
      return false;
    }
  }

  public function insert($data){
    $insert_row = $this->link->query($data) or die($this->link->error.__LINE__);
    if($insert_row){
      return $insert_row;
    }else{
      return false;
    }
  }

  public function select($data){
    $select_row = $this->link->query($data) or die($this->link->error.__LINE__);
    if($select_row->num_rows > 0){
      return $select_row;
    }else{
      return false;
    }
  }
}

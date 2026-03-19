<?php

abstract class AbstractManager {
  protected PDO $db;
  public function __construct() {
    $this->db = new PDO("mysql:host=db.3wa.io;dbname=louennpenanchoat_league", "louennpenanchoat", "5266d1b587315ca5599daa218f0166a9");
  }
}


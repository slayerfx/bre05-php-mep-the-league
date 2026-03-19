<?php

class TeamManager extends AbstractManager {
  public function __construct() {
    parent::__construct();
  }

  public function findAll(): array {
    $query = $this->db->prepare("SELECT teams.*, media.url AS logo_url, media.alt AS logo_alt FROM teams JOIN media ON teams.logo = media.id");
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    $teams = [];
    foreach ($results as $result) {
      $logo = new Media($result["logo_url"], $result["logo_alt"], $result["logo"]);
      $teams[] = new Team($result["name"], $result["description"], $logo, $result["id"]);
    }
    return $teams;
  }

  public function findOne(int $id): Team {
    $query = $this->db->prepare("SELECT teams.*, media.url AS logo_url, media.alt AS logo_alt FROM teams JOIN media ON teams.logo = media.id WHERE teams.id = :id");
    $query->execute(["id" => $id]);
    $result = $query->fetch(PDO::FETCH_ASSOC);
    $logo = new Media($result["logo_url"], $result["logo_alt"], $result["logo"]);
    return new Team($result["name"], $result["description"], $logo, $result["id"]);
  }
}
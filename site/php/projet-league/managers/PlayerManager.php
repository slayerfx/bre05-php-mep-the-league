<?php

class PlayerManager extends AbstractManager {
  public function __construct() {
    parent::__construct();
  }

  public function findAll(): array {
    $query = $this->db->prepare("SELECT players.*, media.url AS portrait_url, media.alt AS portrait_alt, teams.name AS team_name FROM players JOIN media on players.portrait = media.id JOIN teams on players.team = teams.id");
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_ASSOC);

    $players = [];
    foreach ($results as $result) {
      $portrait = new Media($result["portrait_url"], $result["portrait_alt"]);
      $team = new Team($result["team_name"], "");      
      $players[] = new Player($result["nickname"], $result["bio"], $portrait, $team, $result["id"]);
    }
    return $players;
  }

  public function findByTeam(int $teamId): array {
    $query = $this->db->prepare("SELECT players.*, media.url AS portrait_url, media.alt AS portrait_alt, teams.name AS team_name FROM players JOIN media ON players.portrait = media.id JOIN teams ON players.team = teams.id WHERE players.team = :teamId");
    $query->execute(["teamId" => $teamId]);
    $results = $query->fetchAll(PDO::FETCH_ASSOC);

    $players = [];
    foreach ($results as $result) {
      $portrait = new Media($result["portrait_url"], $result["portrait_alt"]);
      $team = new Team($result["team_name"], "");
      $players[] = new Player($result["nickname"], $result["bio"], $portrait, $team, $result["id"]);
    }
    return $players;
  }

  public function findOne(int $id): Player {
    $query = $this->db->prepare("SELECT players.*, media.url AS portrait_url, media.alt AS portrait_alt, teams.name AS team_name FROM players JOIN media ON players.portrait = media.id JOIN teams ON players.team = teams.id WHERE players.id = :id");
    $query->execute(["id" => $id]);
    $result = $query->fetch(PDO::FETCH_ASSOC);
    $portrait = new Media($result["portrait_url"], $result["portrait_alt"]);
    $team = new Team($result["team_name"], "", null, $result["team"]);
    return new Player($result["nickname"], $result["bio"], $portrait, $team, $result["id"]);
  }
}
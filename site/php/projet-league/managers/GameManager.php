<?php

class GameManager extends AbstractManager {
  public function __construct() {
    parent::__construct();
  }

  public function findLastGame(): Game {
    $query = $this->db->prepare("SELECT games.*,
        t1.name AS team1_name, m1.url AS team1_logo_url, m1.alt AS team1_logo_alt,
        t2.name AS team2_name, m2.url AS team2_logo_url, m2.alt AS team2_logo_alt
      FROM games
      JOIN teams t1 ON games.team_1 = t1.id
      JOIN media m1 ON t1.logo = m1.id
      JOIN teams t2 ON games.team_2 = t2.id
      JOIN media m2 ON t2.logo = m2.id
      ORDER BY games.date DESC
      LIMIT 1
    ");
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    $logo1 = new Media($result["team1_logo_url"], $result["team1_logo_alt"]);
    $team1 = new Team($result["team1_name"], "", $logo1);

    $logo2 = new Media($result["team2_logo_url"], $result["team2_logo_alt"]);
    $team2 = new Team($result["team2_name"], "", $logo2);

    return new Game($result["name"], $result["date"], $team1, $team2, $result["id"]);
  }

  public function findAll(): array {
    $query = $this->db->prepare("SELECT games.*,
        t1.name AS team1_name, m1.url AS team1_logo_url, m1.alt AS team1_logo_alt,
        t2.name AS team2_name, m2.url AS team2_logo_url, m2.alt AS team2_logo_alt
      FROM games
      JOIN teams t1 ON games.team_1 = t1.id
      JOIN media m1 ON t1.logo = m1.id
      JOIN teams t2 ON games.team_2 = t2.id
      JOIN media m2 ON t2.logo = m2.id"
    );
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);    
    $games = [];
    foreach ($result as $row) {
      $logo1 = new Media($row["team1_logo_url"], $row["team1_logo_alt"]);
      $team1 = new Team($row["team1_name"], "", $logo1);

      $logo2 = new Media($row["team2_logo_url"], $row["team2_logo_alt"]);
      $team2 = new Team($row["team2_name"], "", $logo2);

      $games[] = new Game($row["name"], $row["date"], $team1, $team2, $row["id"]);
  }
    return $games;
  }

  public function findOne(int $id): ?Game {
    $query = $this->db->prepare("SELECT games.*,
        t1.name AS team1_name, m1.url AS team1_logo_url, m1.alt AS team1_logo_alt,
        t2.name AS team2_name, m2.url AS team2_logo_url, m2.alt AS team2_logo_alt
      FROM games
      JOIN teams t1 ON games.team_1 = t1.id
      JOIN media m1 ON t1.logo = m1.id
      JOIN teams t2 ON games.team_2 = t2.id
      JOIN media m2 ON t2.logo = m2.id
      WHERE games.id = :id
    ");
    $query->execute(["id" => $id]);
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if ($result === false) {
      return null;
    }

    $logo1 = new Media($result["team1_logo_url"], $result["team1_logo_alt"]);
    $team1 = new Team($result["team1_name"], "", $logo1);

    $logo2 = new Media($result["team2_logo_url"], $result["team2_logo_alt"]);
    $team2 = new Team($result["team2_name"], "", $logo2);

    return new Game($result["name"], $result["date"], $team1, $team2, $result["id"]);
  }
}

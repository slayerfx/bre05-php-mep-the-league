<?php

class PlayerPerformanceManager extends AbstractManager {
  public function __construct() {
    parent::__construct();
  }

  public function findByPlayer(int $playerId): array {
    $query = $this->db->prepare(
"SELECT player_performance.*, games.name AS game_name, games.date AS game_date,
       games.team_1, games.team_2, games.winner,
       players.team AS player_team,
       t1.name AS team1_name, t2.name AS team2_name
       FROM player_performance
       JOIN games ON player_performance.game = games.id
       JOIN players ON player_performance.player = players.id
       JOIN teams t1 ON games.team_1 = t1.id
       JOIN teams t2 ON games.team_2 = t2.id
       WHERE player_performance.player = :playerId"
    );
    $query->execute(["playerId" => $playerId]);
    $results = $query->fetchAll(PDO::FETCH_ASSOC);

    $performances = [];
    foreach ($results as $result) {
      // Déterminer l'équipe adverse
      if ($result["player_team"] == $result["team_1"]) {
        $opponent = new Team($result["team2_name"], "", null, $result["team_2"]);
      } else {
        $opponent = new Team($result["team1_name"], "", null, $result["team_1"]);
      }

      // Déterminer si victoire
      $won = ($result["winner"] == $result["player_team"]);

      $game = new Game($result["game_name"], $result["game_date"], null, null, $result["game"]);

      $performances[] = new PlayerPerformance(
        $result["points"],
        $result["assists"],
        $game,
        $opponent,
        $won,
        $result["id"]
      );
    }
    return $performances;
  }
}

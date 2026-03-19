<?php

class HomeController extends AbstractController {
  public function index() : void {
    // La team à la une (Angry Owls, id = 1)
    $tm = new TeamManager();
    $team = $tm->findOne(1);

    // Les joueurs de cette team
    $pm = new PlayerManager();
    $teamPlayers = $pm->findByTeam(1);

    // Les players à la une
    $featuredPlayers = [
      $pm->findOne(3),
      $pm->findOne(14),
      $pm->findOne(12),
    ];

    // Le dernier match
    $gm = new GameManager();
    $lastGame = $gm->findLastGame();

    $this->render("home", [
      "team" => $team,
      "teamPlayers" => $teamPlayers,
      "featuredPlayers" => $featuredPlayers,
      "lastGame" => $lastGame,
    ]);
  }
}

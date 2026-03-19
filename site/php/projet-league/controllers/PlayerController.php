<?php

class PlayerController extends AbstractController {
  public function list() : void {
    $pm = new PlayerManager();
    $players = $pm->findAll();
    $this->render("players", ["players" => $players]);
  }

  public function show(int $id): void {
    $pm = new PlayerManager();
    $player = $pm->findOne($id);

    $perfManager = new PlayerPerformanceManager();
    $performances = $perfManager->findByPlayer($id);

    $teammates = $pm->findByTeam($player->getTeam()->getId());
    // Retirer le joueur actuel des coéquipiers
    $teammates = array_filter($teammates, function($p) use ($id) {
      return $p->getId() !== $id;
    });

    $this->render("player", [
      "player" => $player,
      "performances" => $performances,
      "teammates" => $teammates,
    ]);
  }
}
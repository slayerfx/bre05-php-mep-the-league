<?php

class GameController extends AbstractController {
  public function list() : void {
    $gm = new GameManager();
    $games = $gm->findAll();
    $this->render("matchs", ["games" => $games]);
  }
}
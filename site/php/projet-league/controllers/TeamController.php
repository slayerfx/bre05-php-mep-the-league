<?php

class TeamController extends AbstractController {
  public function list() : void {
    $tm = new TeamManager();
    $teams = $tm->findAll();
    $this->render("teams", ["teams" => $teams]);    
  }
}
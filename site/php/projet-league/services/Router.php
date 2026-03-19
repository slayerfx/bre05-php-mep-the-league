<?php

class Router {
  public function handleRequest(): void {
    $route = isset($_GET["route"]) ? $_GET["route"] : "home";

    if ($route === "player" && isset($_GET["id"])) {
      $ctrl = new PlayerController();
      $ctrl->show((int)$_GET["id"]);
    } elseif ($route === "players") {
      $ctrl = new PlayerController();
      $ctrl->list();
    } elseif ($route === "matchs") {
      $ctrl = new GameController();
      $ctrl->list();
    } elseif ($route === "teams") {
      $ctrl = new TeamController();
      $ctrl->list();
    } else {
      $ctrl = new HomeController();
      $ctrl->index();
    }    
  }
}
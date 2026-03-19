<?php

class Game {
  public function __construct(
    private string $name,
    private string $date,
    private ?Team $team1 = null,
    private ?Team $team2 = null,
    private ?int $id = null,
  ) {}

  public function getName(): string {
    return $this->name;
  }

  public function getDate(): string {
    return $this->date;
  }

  public function getTeam1(): ?Team {
    return $this->team1;
  }

  public function getTeam2(): ?Team {
    return $this->team2;
  }

  public function getId(): ?int {
    return $this->id;
  }
}

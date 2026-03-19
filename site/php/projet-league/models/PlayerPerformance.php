<?php

class PlayerPerformance {
  public function __construct(
    private int $points,
    private int $assists,
    private ?Game $game = null,
    private ?Team $opponent = null,
    private bool $won = false,
    private ?int $id = null,
  ) {}

  public function getPoints(): int {
    return $this->points;
  }

  public function getAssists(): int {
    return $this->assists;
  }

  public function getGame(): ?Game {
    return $this->game;
  }

  public function getOpponent(): ?Team {
    return $this->opponent;
  }

  public function getWon(): bool {
    return $this->won;
  }

  public function getId(): ?int {
    return $this->id;
  }
}

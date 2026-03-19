<?php

class Player {
  public function __construct(
    private string $nickname,
    private string $bio,
    private ?Media $portrait = null,
    private ?Team $team = null,
    private ?int $id = null,
  ) {}

  public function getNickname(): string {
    return $this->nickname;
  }

  public function getBio(): string {
    return $this->bio;
  }

  public function getPortrait(): ?Media {
    return $this->portrait;
  }

  public function getTeam(): ?Team {
    return $this->team;
  }

  public function getId(): ?int {
    return $this->id;
  }
}

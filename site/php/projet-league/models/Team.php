<?php

class Team {
  public function __construct(
    private string $name,
    private string $description,
    private ?Media $logo = null,
    private ?int $id = null
  ) {}

  public function getName(): string {
    return $this->name;
  }

  public function getDescription(): string {
    return $this->description;
  }

  public function getLogo(): ?Media {
    return $this->logo;
  }

  public function getId(): ?int {
    return $this->id;
  }
}

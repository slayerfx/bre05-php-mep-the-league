<?php

class Media {
  public function __construct(
    private string $url,
    private string $alt,
    private ?int $id = null
  ) {}
  
  public function getUrl(): string {
    return $this->url;
  }

  public function getAlt(): string {
    return $this->alt;
  }

  public function getId(): ?int {
    return $this->id;
  }
}

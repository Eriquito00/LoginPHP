<?php

namespace App\Model\Entities;

class Anime {
    private int $id;
    private int $mal_id;
    private string $title;
    private ?string $image_url;
    private ?string $synopsis;
    private ?float $score;
    private ?int $episodes;

    public function __construct() {}

    public function init(
        int $malId,
        string $title,
        ?string $imageUrl = null,
        ?string $synopsis = null,
        ?float $score = null,
        ?int $episodes = null,
        int $id = 0
    ): void {
        $this->id = $id;
        $this->mal_id = $malId;
        $this->title = $title;
        $this->image_url = $imageUrl;
        $this->synopsis = $synopsis;
        $this->score = $score;
        $this->episodes = $episodes;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getMalId(): int {
        return $this->mal_id;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getImageUrl(): ?string {
        return $this->image_url;
    }

    public function getSynopsis(): ?string {
        return $this->synopsis;
    }

    public function getScore(): ?float {
        return $this->score;
    }

    public function getEpisodes(): ?int {
        return $this->episodes;
    }

    public function toArray(): array {
        return [
            'mal_id' => $this->mal_id,
            'title' => $this->title,
            'image_url' => $this->image_url,
            'synopsis' => $this->synopsis,
            'score' => $this->score,
            'episodes' => $this->episodes,
        ];
    }
}

?>

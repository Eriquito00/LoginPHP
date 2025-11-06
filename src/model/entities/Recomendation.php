<?php
class Recomendation {
    private $id;
    private $user_id;
    private $title;
    private $description;
    private $image;

    public function __construct($id, $user_id, $title, $description, $image) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
    }

    public function getId() { return $this->id; }
    public function getUserId() { return $this->user_id; }
    public function getTitle() { return $this->title; }
    public function getDescription() { return $this->description; }
    public function getImage() { return $this->image; }

    public function __toString() {
        return "Recomendation [ID: {$this->id}, UserId: {$this->user_id}, Title: {$this->title}, Description: {$this->description}, Image: {$this->image}]";
    }
}
?>
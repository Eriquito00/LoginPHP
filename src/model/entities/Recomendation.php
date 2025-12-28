<?php
namespace App\Model\Entities;

class Recomendation {
    private int $id;
    private int $user_id;
    private string $username;
    private string $title;
    private string $description;
    private string | null $image_url;
    private string $created_at;

    /**
     * Constructor vacio para PDO::FETCH_CLASS
     */
    public function __construct() {}


    /**
     * @param array $data ARRAY ASSOC con los datos
     * 
     * @return void
     */
    public function hydrate(array $data) : void {
        foreach ($data as $k => $v) {
            if(property_exists($this, $k)) {
                $this->$k = $v;
            }
        }
    }

    
    /**
     * Funcion para hidratar el objeto como un constructor parametrizado
     * @param int $id
     * @param int $user_id
     * @param string $title
     * @param string $description
     * @param string $image_url
     * 
     * @return void
     */
    public function init(int $user_id, string $title, string $description, string $image_url = '', int $id = 0) : void {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->title = $title;
        $this->description = $description;
        $this->image_url = $image_url;
        $this->created_at = "";
    }

    public function getUsername() : string {
        return $this->username;
    }

    public function getId() : int  { 
        return $this->id; 
    }

    public function getUserId() : int { 
        return $this->user_id; 
    }

    public function getTitle() : string { 
        return $this->title; 
    }

    public function getDescription() : string { 
        return $this->description; 
    }

    public function getImageUrl() : string | null { 
        return $this->image_url; 
    }

    public function getCreatedAt() : string {
        return $this->created_at;
    }

    public function __toString() {
        return "{
                    id: {$this->id},
                    userId: {$this->user_id},
                    title: {$this->title},
                    description: {$this->description},
                    Image_url: {$this->image_url},
                    created_at: {$this->created_at}
                }";
    }
}
?>
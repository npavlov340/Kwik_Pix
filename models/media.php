<?php

include_once "model.php";

class Media extends Model {

    // SQL for saving media goes here
    public function save() {
        
    }

    public function find($media_path) {
        $sql = "SELECT * FROM media
              INNER JOIN users
              ON media.artist_id=users.user_id
              WHERE media.path='" . $media_path . "';";
        return self::query($sql);
    }

    public function all($keywords_array) {
        $keywords_regex = implode("[[:>:]]|[[:<:]]", $keywords_array) . "[[:>:]]'";

        $sql = "SELECT * FROM media WHERE keywords REGEXP '[[:<:]]" . $keywords_regex . ";";

        return $this->format_collection_response(self::query($sql));
    }

    public function older_than($id, $limit) {
        $sql = "SELECT * FROM media";
        $sql .= " WHERE media.media_id < " . $id;
        $sql .= " ORDER BY media_id DESC LIMIT ";
        $sql .= $limit . ";";

        return $this->format_collection_response(self::query($sql));
    }

    public function newer_than($id, $limit) {
        $sql = "SELECT * FROM media";
        $sql .= " WHERE media.media_id > " . $id;
        $sql .= " ORDER BY media_id DESC LIMIT ";
        $sql .= $limit . ";";

        return $this->format_collection_response(self::query($sql));
    }

    public function latest($limit) {
        $sql = "SELECT * FROM media";
        $sql .= " ORDER BY media_id DESC LIMIT ";
        $sql .= $limit . ";";

        return $this->format_collection_response(self::query($sql));
    }

    protected function format_record_response($record) {
        return '{"id" : "' . $record['media_id'] . '", "url" : "' . $record['path'] . '", "title" : "' . $record['title'] . '"},';
    }

}

?>

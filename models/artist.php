<?php

include "customer.php";

class Artist extends Customer {

    //if requestType = 0, find
    //else, all
    private $requestType;

    // Find out purchase details about a specific media
    public function find($id) {
        $this->requestType = 0;
        $sql = "SELECT * FROM `purchases` WHERE `media_id` = " . $id;
        return format_record_response(self::query($sql));
    }

    // Return all media from this user
    public function all($type) {
        $this->requestType = 1;
        $sql = "SELECT * FROM `media` WHERE artist_id = " . $type;
        return format_collection_response(self::query($sql));
    }

    public function save() {
        
    }

    protected function format_record_response($record) {
        if ($this->requestType == 0) {
            return '{"id" : "' . $record['purchase_id'] . '", "media_id" : "' . $record['media_id'] . '", "license_type" : "' . $record['license_type'] . '", "date" : "' . $record['date'] . '"},';
        } else if ($this->requestType == 1) {
            return '{"id" : "' . $record['media_id'] .
                    '", "path" : "' . $record['path'] .
                    '", "title" : "' . $record['title'] .
                    '", "description" : "' . $record['description'] .
                    '", "original_width" :"' . $record['original_width'] .
                    '", "original_height" :"' . $record['original_height'] .
                    '", "unlimited" : "' . $record['unlimited_price'] .
                    '", "web" : "' . $record['web_price'] .
                    '", "print" : "' . $record['print_price'] .
                    '", "date" : "' . $record['date'] . '"}';
        }
    }

    // SQL for saving media goes here
    public function upload($fileToUpload, $title, $description, $keywords, $unlimited, $web, $print) {
        //just to so it saves properly on my own site
        //target_dir = "/home/s16g05/public_html/uploads/";
        $target_dir = "uploads/";
        $filename = basename($fileToUpload["name"]);
        $target_file = $target_dir . $filename;
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($fileToUpload["size"] > 500000) {
            echo "<p>Sorry, your file is too large.<p>";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "<p>Sorry, only JPG, JPEG, PNG & GIF files are allowed.<p>";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "<p>Sorry, your file was not uploaded.<p>";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($fileToUpload["tmp_name"], $target_file)) {
                $imgData = file_get_contents($target_file);
                list($original_width, $original_height) = getimagesize($target_dir . $filename);
                $sql = "INSERT INTO `media`(`artist_id`, `path`, `title`, `description`, `keywords`, `unlimited_price`, `web_price`, `print_price`, `original_width`, `original_height`, `upload_date`) VALUES ('" .
                        $this->id . "','" .
                        $filename . "','" .
                        $title . "','" .
                        $description . "','" .
                        $keywords . "','" .
                        $unlimited . "','" .
                        $web . "','" .
                        $print . "','" .
                        $original_width . "','" .
                        $original_height . "'," .
                        "CURDATE())";
                self::query($sql);

                //resize the image and save the resized image
                $small_name = "_" . $filename;
                $small_width = 300;
                $ratio = $small_width / $original_width;
                $small_height = $original_height * $ratio;
                $small_image = new Imagick($target_dir . $filename);
                $small_image->resizeimage($small_width, $small_height, Imagick::FILTER_GAUSSIAN, 1);
                
                $target_dir = "images_thubnail/";
                //$target_dir = "/home/s16g05/public_html/images_thubnail/";
                $small_image->writeimage($target_dir . $small_name);

                echo "<p>The file " . $filename . " has been uploaded.<p>";
            } else {
                echo "<p>Sorry, there was an error uploading your file.<p>";
            }
        }
    }

}

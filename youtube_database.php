<?php
class Youtube{

    // database connection and table name
    private $conn;
    private $table_name = "youtube";

    // object properties
    public $channel_name;

    public $description;

    public $published_time;
    public $video_id;
    public $channel_id;

    public $thumbnail_url;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read all tweets
    function read(){
        // select all query
        $query = "SELECT `youtube`.`channel_name`,
                    `youtube`.`description`,
                    `youtube`.`published_time`,
                    `youtube`.`video_id`,
                    `youtube`.`id`,
                    `youtube`.`channel_id`,
                    `youtube`.`thumbnail_url` from ".  $this->table_name . " order by  `youtube`.`id` desc;";
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }


    // create tweet
    function create(){

        // query to insert record

        $query = "INSERT INTO ". $this->table_name ."
                    (`channel_name`,
                        `description`,
                        `published_time`,
                        `video_id`,
                        `channel_id`,
                        `thumbnail_url`)
                         VALUES('".$this->channel_name."', '".$this->description."', '".$this->published_time."', '".$this->video_id."', '".$this->channel_id."', '".$this->thumbnail_url."')";

        $stmt = $this->conn->prepare($query);

        // execute query
        if($stmt->execute()){

            return true;
        }

        return false;
    }
}
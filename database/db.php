<?php
class DataBase {
    private static $instance;
    public static $default_config = array( "host" => "localhost", "username" => "s16g05", "password" => "team5s16db", "database" => "student_s16g05" );

    private $connection;
    private $configuration;

    private function __construct($config) {
        $this->configuration = $config;
    } 

    public static function get_instance($db_config) {
        if( empty($instance) ) {
            $instance = new Database($db_config);
        }
        return $instance;
    }

    private function open_connection() {
        $this->connection = new mysqli(
        $this->configuration["host"],
        $this->configuration["username"],
        $this->configuration["password"],
        $this->configuration["database"]
        );

        if ($this->connection->connect_error) { die("Connection failed: " . $this->connection->connect_error); }
    }

    private function close_connection() {
        $this->connection->close();
    }

    public function transaction($sql) {
        $this->open_connection();
        $result = $this->connection->query($sql);
        $this->close_connection();
        return $result;
    }
}
?>

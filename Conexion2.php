<?php

class DB2 {

    // The database connection
    protected static $connection;

    /**
     * Connect to the database
     * 
     * @return bool false on failure / mysqli MySQLi object instance on success
     */
    public function connect() {
        // Try and connect to the database
       // if (!isset(self::$connection)) {
            // Load configuration as an array. Use the actual location of your configuration file
        //    self::$connection = new mysqli('localhost', 'root', 'root', 'servicioslegales');
      //  }
self::$connection = mysqli_init();
if (!self::$connection) {
    die('mysqli_init failed');
}

if (!self::$connection->options(MYSQLI_INIT_COMMAND, 'SET AUTOCOMMIT = 0')) {
    die('Setting MYSQLI_INIT_COMMAND failed');
}

if (!self::$connection->options(MYSQLI_OPT_CONNECT_TIMEOUT, 5)) {
    die('Setting MYSQLI_OPT_CONNECT_TIMEOUT failed');
}

if (!self::$connection->real_connect('localhost', 'root', 'root', 'servicioslegales')) {
    die('Connect Error (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
}
        // If connection was not successful, handle the error
        if (self::$connection === false) {
            // Handle error - notify administrator, log to a file, show an error screen, etc.
            return false;
        }
        return self::$connection;
    }

    /**
     * Query the database
     *
     * @param $query The query string
     * @return mixed The result of the mysqli::query() function
     */
    public function query($query) {
        // Connect to the database
        $connection = $this->connect();

        // Query the database
        $result = $connection->query($query);
         //$this->close();
        return $result;
    }
    public function InsertUser($nombre, $dpi, $telefono, $correo, $direccion, $USR, $pass) {
        // Connect to the database
        $connection = $this->connect();
        $stmt = $connection->prepare("call Registro_USR(?,?,?,?,?,?,?);");
        $stmt->bind_param('sssssss', $nombre, $dpi, $telefono, $correo,$direccion,$USR,$pass);
        /* execute prepared statement */
        $stmt->execute();
        /* close statement and connection */
        $stmt->close();
        //$this->close() ;
    }
      public function Login($nombre, $pass) {
        // Connect to the database
       $rows = array();
        $connection = $this->connect();
        $stmt = $connection->prepare("select Login(?,?) as login;");
        $stmt->bind_param('ss', $nombre,$pass);
        /* execute prepared statement */
        $stmt->execute();
        $result = $stmt->get_result();
        /* close statement and connection */
         $stmt->close();
        //$this->close() ;
        while ($row = $result->fetch_assoc()) {
            return $row;
        }
    }
    
    /**
     * Fetch rows from the database (SELECT query)
     *
     * @param $query The query string
     * @return bool False on failure / array Database rows on success
     */
    public function select($query) {
        $rows = array();
        $result = $this->query($query);
        if ($result === false) {
            return false;
        }
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    /**
     * Fetch the last error from the database
     * 
     * @return string Database error message
     */
    public function error() {
        $connection = $this->connect();
        return $connection->error;
    }

    /**
     * Quote and escape value for use in a database query
     *
     * @param string $value The value to be quoted and escaped
     * @return string The quoted and escaped string
     */
    public function quote($value) {
        $connection = $this->connect();
        return "'" . $connection->real_escape_string($value) . "'";
    }


}
?>
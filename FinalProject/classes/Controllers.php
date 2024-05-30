<?php
class Controllers {
    protected $db = null;
    protected $members = null;
    protected $equipment = null;
    protected $roles = null;
    protected $suppliers = null;
    protected $categories = null;
    protected $reviews = null;
    protected $purchases = null;

    public function __construct()
    {
        $type ='mysql';
        $server = '127.0.0.1';
        $db = 'finalprojectdb';
        $port = '3306';
        $charset = 'latin1';

        $username = 'root';
        $password = '';

        $dsn = "$type:host=$server;dbname=$db;port=$port;charset=$charset";
    
        try {
            $this->db = new DatabaseController($dsn, $username, $password); 
        }
        catch (PDOException $e) {
            throw new PDOException($e -> getMessage(), $e -> getCode());
        }
    }

    public function equipment() {
        if ($this->equipment === null) {
            $this->equipment = new equipmentController($this->db);
        }
        return $this->equipment;
    }

    public function members()
    {
        if ($this->members === null) {
            $this->members = new MemberController($this->db);
        }
        return $this->members;
    }

    public function roles()
    {
        if ($this->roles === null) {
            $this->roles = new RoleController($this->db);
        }
        return $this->roles;
    }

    public function reviews()
    {
        if ($this->reviews === null) {
            $this->reviews = new ReviewsController($this->db);
        }
        return $this->reviews;
    }
}
?>
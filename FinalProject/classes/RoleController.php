<?php
    class RoleController
    {
        protected $db;

        public function __construct(DatabaseController $db)
        {
            $this->db = $db;
        }

        public function create_role(array $role) 
        {
            $sql = "INSERT INTO roles(name)
            VALUES (:name);";
            
            $this->db->runSQL($sql, $role);
            
            return $this->db->lastInsertId();
        }

        public function get_role_by_id(int $id)
        {
            $sql = "SELECT * FROM roles WHERE id = :id";
            $args = ['id' => $id];
            
            return $this->db->runSQL($sql, $args)->fetch();
        }

        public function get_rolename_by_id(int $id)
        {
            $sql = "SELECT name FROM roles WHERE id = :id";
            $args = ['id' => $id];
            
            return $this->db->runSQL($sql, $args)->fetch();
        }

        public function get_all_roles()
        {
            $sql = "SELECT * FROM roles";
            
            return $this->db->runSQL($sql)->fetchAll();
        }


        public function delete_role(int $id)
        {
            $sql = "DELETE FROM roles WHERE id = :id";
            $args = ['id' => $id];
            
            return $this->db->runSQL($sql, $args);
        }
    }
?>
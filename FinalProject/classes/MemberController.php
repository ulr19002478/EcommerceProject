<?php

class MemberController {

    protected $db;

    public function __construct(DatabaseController $db)
    {
        $this->db = $db;
    }

    public function get_member_by_id(int $id)
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $args = ['id' => $id];
        return $this->db->runSQL($sql, $args)->fetch();
    }

    public function get_member_by_email(string $email)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $args = ['email' => $email];
        return $this->db->runSQL($sql, $args)->fetch();
    }

    public function get_all_members()
    {
        $sql = "SELECT * FROM users";
        return $this->db->runSQL($sql)->fetchAll();
    }

    public function update_member(array $member)
    {
        $sql = "UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, password = :password, role_id = :role_id WHERE ID = :id";
        return $this->db->runSQL($sql, $member);
    }

    public function delete_member(int $id)
    {
        $sql = "DELETE FROM users WHERE id = :id";
        $args = ['id' => $id];
        return $this->db->runSQL($sql, $args);
    }

    public function register_member(array $member)
    {
        try {
            $sql = "INSERT INTO users(firstname, lastname, email, password, role_id) 
                    VALUES (:firstname, :lastname, :email, :password, :role_id)"; 

            $this->db->runSQL($sql, $member);
            return true;

        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                return false;
            }
            throw $e;
        }
    }
    
    public function get_role_id(int $id)
    {
        $sql = "SELECT role_id FROM users WHERE id = :id";
        $args = ['id' => $id];
        return $this->db->runSQL($sql, $args)->fetch();
    }

    public function login_member(string $email, string $password)
    {
        $member = $this->get_member_by_email($email);

        if ($member) {
            $auth = password_verify($password,  $member['password']);
            return $auth ? $member : false;
        }
        return false;
    }


}

?>
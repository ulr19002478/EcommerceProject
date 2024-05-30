<?php

class equipmentController {

    protected $db;

    public function __construct(DatabaseController $db)
    {
        $this->db = $db;
    }

    public function create_equipment(array $equipment) 
{
    $sql = "INSERT INTO equipments(name, description, image, price)
            VALUES (:name, :description, :image, :price);";
    
    $this->db->runSQL($sql, $equipment);
    
    return $this->db->lastInsertId();
}

    public function get_equipment_by_id(int $id)
    {
        $sql = "SELECT * FROM equipments WHERE id = :id";
        $args = ['id' => $id];
        
        return $this->db->runSQL($sql, $args)->fetch();
    }

    public function get_all_equipments()
{
    $equipments = $this->db->runSQL("SELECT * FROM equipments")->fetchAll();

    return $equipments;
}

    public function update_equipment(array $equipment)
    {
        $sql = "UPDATE equipments SET name = :name, description = :description, image = :image, price = :price 
                WHERE id = :id";
        
        return $this->db->runSQL($sql, $equipment)->execute();
    }

    public function delete_equipment(int $id)
    {
        $sql = "DELETE FROM equipments WHERE id = :id";
        $args = ['id' => $id];
        
        return $this->db->runSQL($sql, $args)->execute();
    }

}

?>
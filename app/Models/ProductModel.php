<?php 

class ProductModel extends Model{
    private $table = "products";

    public function getAllProducts(){
        $sql = 'SELECT * FROM '.$this->table;
        $result = $this->db->getAll($sql);
        return $result;
    }

    public function getById($id){
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        $result = $this->db->getRow($sql, [$id]);
        return $result;
    }

    public function add($data){
        $sql = "INSERT INTO {$this->table} (title, slug, price, sale_price, description) VALUES (?, ?, ?, ?, ?)";
        $params = [
            $data['title'],
            $data['slug'],
            $data['price'],
            $data['sale_price'],
            $data['description'],
        ];
        $result = $this->db->insertRow($sql, $params);
        return $result;
    }
    public function update($id, $data){
        $sql = "UPDATE {$this->table} SET title = ?, slug = ?, price = ?, sale_price = ?, description = ? WHERE id = ?";
        $params = [
            $data['title'],
            $data['slug'],
            $data['price'],
            $data['sale_price'],
            $data['description'],
            $id
        ];
        $result = $this->db->updateRow($sql, $params);
        return $result;
    }

    public function delete($id){
       return $this->db->deleteRow($this->table, $id);
    }
}
<?php 
include 'Model.php';

class UserModel extends Model{

    private $table = 'users';

    public function get($id){
        $sql = 'SELECT * FROM users WHERE id = ?';
        $params = array($id);
        $result = $this->db->getRow($sql, $params);
        return $result;
    }

    public function getByEmail($email){
        $sql = "SELECT * FROM {$this->table} WHERE email = :email";
        $params = [
            ':email' => $email
        ];
        return $this->db->getRow($sql, $params);
    }
    
    public function getAll(){
        $sql = 'SELECT * FROM users';
        $result = $this->db->getAll($sql);
        return $result;
    }

    public function add($data){
        $sql = "INSERT INTO {$this->table} (first_name, last_name, email, username, password) VALUES (?, ?, ?, ?, ?)";
        $params = [
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['username'],
            $data['password']
        ];
        $result = $this->db->insertRow($sql, $params);
        return $result;
    }


}
?>
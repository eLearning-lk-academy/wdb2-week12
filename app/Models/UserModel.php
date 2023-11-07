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

    public function getByToken($token){
        $sql = "SELECT * FROM {$this->table} WHERE token = :token";
        $params = [
            ':token' => $token
        ];
        return $this->db->getRow($sql, $params);
    }
    
    public function getAll(){
        $sql = 'SELECT * FROM users';
        $result = $this->db->getAll($sql);
        return $result;
    }

    public function add($data){
        $sql = "INSERT INTO {$this->table} (first_name, last_name, email, username, password, token) VALUES (?, ?, ?, ?, ?)";
        $params = [
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['username'],
            $data['password'],
            $this->generateToken()
        ];
        $result = $this->db->insertRow($sql, $params);
        return $result;
    }

    public function restPassword($id, $password){
        $sql = "UPDATE {$this->table} SET password = :password, token = :token WHERE id = :id";

        $params = [
            ':password' => password_hash($password, PASSWORD_DEFAULT),
            ':token' => $this->generateToken(),
            ':id' => $id
        ];
        
        $result = $this->db->updateRow($sql, $params);
        return $result;
    }

    private function generateToken(){
        $token = bin2hex(random_bytes(32));
        return $token;
    }


}
?>
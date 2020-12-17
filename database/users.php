<?php
class Users
{
    public int $id;
    public string $email;
    public string $password;
    public string $name;
    public $gender;
    public $birthday;
    public $profile;
    public string $phonenum;
    public $created_at;
    public $updated_at;
    public $deleted_at;
    private PDO $conn;
    public string $key = "PrivateNayzacKey@2021";
    public function __construct()
    {
        $this->conn = new PDO("mysql:host=localhost;dbname=nour", 'root', '');
    }
    public function readAll(): array
    {
        $sql = "SELECT * FROM `users`";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(): bool
    {
        $sql = "INSERT INTO `users` (email,password,name,gender,birthday,profile,phonenum) VALUES(:email,:password,:name,:gender,:birthday,:profile,:phonenum)";
        $stmt = $this->conn->prepare($sql);
        $encryptedPassword = crypt($this->password, $this->key);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $encryptedPassword);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":gender", $this->gender);
        $stmt->bindParam(":birthday", $this->birthday);
        $stmt->bindParam(":profile", $this->profile);
        $stmt->bindParam(":phonenum", $this->phonenum);
        return $stmt->execute();
    }
    public function update(): bool
    {
        $sql = "UPDATE `users` SET email=:email,password=:password,name=:name,gender=:gender,birthday=:birthday,profile=:profile,phonenum=:phonenum WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":gender", $this->gender);
        $stmt->bindParam(":birthday", $this->birthday);
        $stmt->bindParam(":profile", $this->profile);
        $stmt->bindParam(":phonenum", $this->phonenum);
        $stmt->bindParam(":id", $this->id);
        return $stmt->execute();
    }
    public function readOne(int $id)
    {
        $sql = "SELECT * WHERE `id`=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    }
    public function readByEmail(string $email)
    {
        $sql = "SELECT * FROM `users` WHERE email=:email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":email", $_POST['email']);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    }
}

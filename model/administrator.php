<?php
class Administrator{
    public $administratorId;
    public $username;
    public $password;
    

    public function __construct($administratorId=null,$username=null,$password=null)
    {
        $this->administratorId = $administratorId;
        $this->username=$username;
        $this->password=$password;
    }

    public static function login($administrator, mysqli $conn)
    {
        $query = "SELECT * FROM administrator WHERE username='$administrator->username' and password='$administrator->password'";
        return $conn->query($query);
    }

}
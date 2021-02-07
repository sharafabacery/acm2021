<?php
class Caregiver
{

    public $name;
    public $email;
    public $password;
    public $address;
    public $date_of_birth;
    public $gender;
    public $id;

    private $conn;
    private $table_name;

    public function __construct($db)
    {
        $this->conn = $db;
        $this->table_name = "caregiver";
    }

    public function createCaregiver()
    {

        $query = "INSERT INTO " . $this->table_name . " set name=?, email=?, password=?, address=?, date_of_birth=?, gender=?";

        $obj = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));

        $this->address = htmlspecialchars(strip_tags($this->address));
        $this->date_of_birth = htmlspecialchars(strip_tags($this->date_of_birth));
        $this->gender = htmlspecialchars(strip_tags($this->gender));


        $obj->bind_param("ssssss", $this->name, $this->email, $this->password, $this->address, $this->date_of_birth, $this->gender);

        if ($obj->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function check_email()
    {
        $email_query = "SELECT  * FROM " . $this->table_name . " where email = ?";

        $user_obj = $this->conn->prepare($email_query);

        $user_obj->bind_param("s", $this->email);

        if ($user_obj->execute()) {

            $data = $user_obj->get_result();

            return $data->fetch_assoc();
        }

        return array();
    }
    public function check_login()
    {
        $email_query = "select  * from " . $this->table_name . " where email = ? ";

        $user_obj = $this->conn->prepare($email_query);

        $user_obj->bind_param("s", $this->email);

        if ($user_obj->execute()) {

            $data = $user_obj->get_result();

            return $data->fetch_assoc();
        }

        return array();
    }

    public function getCaregiverAllData()
    {
        $sql_query = "SELECT * FROM " . $this->table_name;

        $std_obj = $this->conn->prepare($sql_query);

        if ($std_obj->execute()) {
            return $std_obj->get_result(); //get all data 
        }
    }

    public function getCaregiverData()
    {
        $sql = "SELECT * FROM " . $this->table_name . " where id=?";

        $obj = $this->conn->prepare($sql);

        $obj->bind_param("i", $this->id);

        $obj->execute();

        $data = $obj->get_result();

        return $data->fetch_assoc(); //return all data
    }

    
    public function deleteCareGiver()
    {
        $delete_query = "DELETE FROM " . $this->table_name . " where id=?";

        $query_obj = $this->conn->prepare($delete_query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $query_obj->bind_param("i", $this->id);

        if ($query_obj->execute() && $query_obj->affected_rows > 0) {

            return true;
        } else {

            return false;
        }
    }
}

<?php
class Elderly
{

    public $name;
    public $email;
    public $password;
    public $user_id;
    public $date_of_birth;
    public $address;
    public $gender;

    private $conn;

    private $projects_tbl;
    private $users_tbl;
    private $users_tb2;

    public function __construct($db)
    {
        $this->conn = $db;
        $this->projects_tbl = "elderly_caregiver";

        $this->users_tbl = "elderly";
        $this->users_tb2 = "caregiver";
    }

    public function create_elderly()
    {
        $user_query = "INSERT INTO " . $this->users_tbl . " set name = ? ,email = ?,password = ?,date_of_birth=?, gender=?";

        $user_obj = $this->conn->prepare($user_query);

        $user_obj->bind_param("sssss", $this->name, $this->email, $this->password, $this->date_of_birth, $this->gender);

        if ($user_obj->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function check_email()
    {
        $email_query = "SELECT  * FROM " . $this->users_tbl . " where email = ?";

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
        $email_query = "SELECT  * FROM " . $this->users_tbl . " where email = ? ";

        $user_obj = $this->conn->prepare($email_query);

        $user_obj->bind_param("s", $this->email);

        if ($user_obj->execute()) {

            $data = $user_obj->get_result();

            return $data->fetch_assoc();
        }

        return array();
    }


    public function assign_caregiver($caregiver_id)
    {
        $project_query = "INSERT INTO " . $this->projects_tbl . " set caregiver_id=? , elderly_id=?";
        $project_obj = $this->conn->prepare($project_query);
        $project_obj->bind_param("ii", $caregiver_id, $this->user_id);

        if ($project_obj->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function get_all_assignment()
    {
        $project_query = "SELECT * FROM " . $this->projects_tbl;

        $project_obj = $this->conn->prepare($project_query);

        $project_obj->execute();

        return $project_obj->get_result();
    }

    public function get_elderly_caregivers()
    {
        $project_query = "SELECT * FROM " . $this->projects_tbl . " NATURAL JOIN " . $this->users_tb2 . " WHERE elderly_id=?";
        $project_obj = $this->conn->prepare($project_query);
        $project_obj->bind_param("i", $this->user_id);
        $project_obj->execute();

        return $project_obj->get_result();
    }
}

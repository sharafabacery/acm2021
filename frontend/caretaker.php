<?php
session_start();
include "../config/database.php";
include "../classes/elderly.php";
include "../classes/caregiver.php";
if (!isset($_SESSION['id'])) {
    header("Location: login_elder.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
<table>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Address</th>
            <th>Email</th>
            <th>Date Of Birth</th>
            <th>Gender</th>
            <th>Add CareTaker</th>
        </tr>
        <?php
        $db = new Database();
        $connection = $db->connect();
        $caregiver = new Caregiver($connection);
        $res = $caregiver->getCaregiverAllData();

        while ($rows = $res->fetch_assoc()) {
            $id = $rows['id'];
            $email = $rows['email'];
            $name = $rows['name'];
            $address = $rows['address'];
            $date_of_birth = $rows['date_of_birth'];
            $gender = $rows['gender'];
            echo "<tr>";
            echo "<td> $id </td>";
            echo "<td> $name </td>";
            echo "<td> $address </td>";
            echo "<td> $email </td>";
            echo "<td> $date_of_birth </td>";
            echo "<td> $gender </td>";
            echo '<td> <a href="caretaker.php?careTaker_id=' . $id . '">Add CareTaker</a> </td>';
            echo "</tr>";
        }
        ?>

    </table>
    <form action="caretaker.php" method="POST">

            <?php
            $db = new Database();
            $connection = $db->connect();
         //   $caregiver = new Caregiver($connection);
            $elderly = new Elderly($connection);
           // echo $_SESSION['id'];
            $elderly->user_id=$_SESSION['id'];
           // $res = $caregiver->getCaregiverAllData();
            $get_all_assignment=$elderly->get_elderly_caregivers();
            //$_SESSION['data']=$get_all_assignment;
            $data=[];
           // print_r( $_SESSION['data']);
            while ($rows = $get_all_assignment->fetch_assoc()) {
               //echo $rows['email'];
               array_push($data,$rows['email']);
                // $id = $rows['id'];
               // $email = $rows['email'];
               // $name = $rows['name'];
               // $address = $rows['address'];
               // $date_of_birth = $rows['date_of_birth'];
               // $gender = $rows['gender'];
              //  echo $email . " " . $email . " " . $name . " " . $address . " " . $date_of_birth . " " . $gender;
                // echo " <select name='' id=''></select>";
            }
            $_SESSION['data']=$data
            //print_r($data);
            ?>
       
    </form>
    
    <form action="pushing.php" method="post">
    <button type="submit" name="food" value=" ">food</button>
    <button type="submit" name="Medicine">Medicine</button>
    <button type="submit" name="emergency">emergency</button>
    <button type="submit" name="gernal help">gernal help</button>
    </form>
    
    
    

</body>
<?php

if (isset($_SESSION['id']) && isset($_GET['careTaker_id'])) {

    $elderly = new Elderly($connection);
    $elderly->user_id = $_SESSION['id'];
    $succ = $elderly->assign_caregiver($_GET['careTaker_id']);
    if($succ){
        echo "Added Successfuly";
    }else{
        echo "Error, or Already exist";
    }
}

?>
</html>
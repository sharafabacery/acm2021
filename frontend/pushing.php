<?php
//ob_start();
session_start();
require '../vendor/autoload.php';
require '../config/Config.php';
?>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    if($_POST['food']="food"){
        $_SESSION['ddd']="food";
    }elseif($_POST['Medicine']="Medicine"){
        $_SESSION['ddd']='Medicine';
    }elseif($_POST['emergency']="emergency"){
        $_SESSION['ddd']='emergency';
    }elseif($_POST['gernal help']="gernal help"){
        $_SESSION['ddd']='gernal help';
    }
    $emails_toGet=$_SESSION['data'];
    //print_r($_SESSION['data']);

     $config=new Config();
     $data=['message'=>$_SESSION['ddd']];
     $options = array(
        'cluster' => $config->cluster,
        'useTLS' => true
      );
     $pusher = new Pusher\Pusher(
        $config->key,
        $config->secret,
        $config->app_id,
        $options
      );
      foreach ($emails_toGet as $x => $y) {
          //echo $y;
        $pusher->trigger('notification',$y,$data);//channel + event+ data 
      }
//  print_r($emails_toGet);
    

}

?>
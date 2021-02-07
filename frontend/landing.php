<?php
ob_start();
session_start();
include "../config/database.php";
include "../classes/caregiver.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<p><?php $_SESSION['id']?> </p>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
  <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
  <script>

  $(document).ready(()=>{
    Pusher.logToConsole = true;

    const pusher = new Pusher('e64f89dbbf74e11eaf4d', {
      cluster: 'mt1'
    });
//food health care medicne genral
    const channel = pusher.subscribe('notification');
    channel.bind('sergi@test.com', function(data) {
    // toastr.success(`${data.message} just registerd`)
     alert(`${data.message} just registerd`)
     console.log(`${data.message} just registerd`)
    });
})

  </script>
  </html>
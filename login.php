<?php
session_start();
include "database_connection.php";

if(isset($_post['uname']) && isset($_post['pass'])) {
    
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return data;
    }
}

$uname = validate($_post['uname']);
$pass = validate($_post['pass']);

if(empty($uname)) {
    header("Location: index.php?error=User Name is required");
    exit();
}
else if(empty($pass)) {
    header("Location: index.php?error=user password is required");
    exit();
}

$sql = "SELECT * FROM users WHERE user_name='$uname' AND password='$pass'";

$result = mysqli_query($conn, $sql);

 if(mysqli_num_rows($result) === 1) {
     $row = mysqli_fetch_assoc($result);
     if($row['user_name'] === $uname && $row['password'] === $pass) {
         echo "Logged In!";
         $_SESSION['user_name'] = $row['user_name'];
         $_SESSION['name'] = $row['name'];
         $_SESSION['id'] = $row['id'];
         header("location: home.php");
         exit();
     }
     else{
         header("location: index.php?error=Incorrect user Name or password");
         exit();
     }

}
else{
    header("location: index.php");
    exit();
}
?>   



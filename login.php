<?php
session_start();
include "db_conn.php";

if(isset($_POST['uname']) && isset($_POST['password'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['uname']);
    $password = validate($_POST['password']);

    if(empty($uname)) {
        header("Location: index.php?error=user name is required");
        exit();
    } else if(empty($password)) {
        header("Location: index.php?error=password is required");
        exit();
    }

    $sql = "SELECT * FROM `form` WHERE username = '$uname' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if($result) {
        $row_count = mysqli_num_rows($result);

        if($row_count === 1) {
            $row = mysqli_fetch_assoc($result);

            if($row['username'] === $uname && $row['password'] === $password) {
                echo "Logged in";
                $_SESSION['user_name'] = $row['username'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['id'] = $row['id'];
                header("Location: home.php");
                exit();
            } else {
                header("Location: index.php?error=incorrect username or password");
                exit();
            }
        } else {
            header("Location: index.php?error=invalid number of rows returned");
            exit();
        }
    } else {
        echo "Error: " . mysqli_error($conn);
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>


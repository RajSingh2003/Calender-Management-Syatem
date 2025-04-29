<?php

session_start(); 

include "../db.php";

if (isset($_POST['username']) && isset($_POST['password'])) {

   


    $email = ($_POST['username']);

    $pass = ($_POST['password']);

    if (empty($email)) {

        header("Location: index.php?error=User Name is required");

        exit();

    }else if(empty($pass)){

        header("Location: index.php?error=Password is required");

        exit();

    }else{

        $sql = "SELECT * FROM tbl_login WHERE username='$email' AND password='$pass'";
         

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            if ($row['username'] === $email && $row['password'] === $pass) {

                echo "Logged in!";
                $user = $email;
                $_SESSION['username'] = serialize($user);

                header("Location: ../admin/index.php");

                exit();

            }else{
            // echo "<h2>dcdvvsvfvs</h2>";
            //     header("refresh:5;url=../index.php");
               echo " <script type='text/javascript'>
alert('Wrong Email & Password Kindly Try Again');
window.location.href = '../index.php';
</script>";
                exit();

            }

        }else{
            echo "<h2>ccccccccccc</h2>";
            // header("refresh:2;url=../index.php");
            echo " <script type='text/javascript'>
            alert('Wrong Email & Password Kindly Try Again');
            window.location.href = '../index.php';
            </script>";

            exit();

        }

    }

}else{

    header("Location: ../index.php");

    exit();

}

?>
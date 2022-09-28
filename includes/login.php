<?php
include "./includes/db_conn.php";
class Login
{
    var $email = null;
    var $password = null;
    var $emailErr = null;
    var $passwordErr = null;
    function emailvalidation($email)
    {
        if (empty($email)) {
            $this->emailErr = "invalid email";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->emailErr = "invalid email";
        } else {
            $this->email = $email;
        }
    }
    function passwordValidation($password)
    {
        if (empty($password)) {
            $this->passwordErr = "password required";
        } else {
            $this->password = $password;
        }
    }
    //                      $_POST['email'],$_POST['password']
    function loginValidation($email, $pass)
    {
        // $email = $_POST['email']
        // $pass = $_POST['password']
        $this->emailvalidation($email);
        $this->passwordValidation($pass);
        if (isset($this->email) && isset($this->password)) {


            $sql = "SELECT * FROM users WHERE email ='$this->email' AND password='$this->password'";
            $result = mysqli_query($GLOBALS['conn'], $sql);
            if (mysqli_num_rows($result) === 1) {
                $row = mysqli_fetch_assoc($result);

                if ($row['email'] === $this->email && $row['password'] === $this->password && $row['user_type'] == "user") {
                    $_SESSION['firstname'] = $row['first_name'];
                    $_SESSION['lastname'] = $row['family_name'];
                    $_SESSION['userType'] = $row['user_type'];
                    print_r($_SESSION);
                    header("location:welcome.php");
                } else if ($row['email'] === $this->email && $row['password'] === $this->password && $row['user_type'] == "admin") {
                    $_SESSION['userType'] = $row['user_type'];
                    $_SESSION['firstname'] = $row['first_name'];
                    $_SESSION['lastname'] = $row['family_name'];
                    print_r($_SESSION);
                    header("location:welcome.php");
                } else if($row['email'] === $this->email && $row['password'] === $this->password && $row['user_type'] == "super admin"){
                    $_SESSION['userType'] = $row['user_type'];
                    $_SESSION['firstname'] = $row['first_name'];
                    $_SESSION['lastname'] = $row['family_name'];
                    header("location:superadmin.php");
                }
                mysqli_close($GLOBALS['conn']);
            } else {
                
                $this->emailErr = "wrong pass or email";
            }
        }
    }
}

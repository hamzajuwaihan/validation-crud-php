<?php
include "./includes/head.php";
include "./includes/db_conn.php";
include "./includes/login.php";
?>
<?php
session_start();

if (isset($_POST['submit'])) {
    $attempt = new Login();
    $attempt->loginValidation($_POST['email'],$_POST['password']);

}

?>
<div class="container mt-5">
    <h1 class="text-center">Login</h1>
    <p class="text-center mt-2 fs-2 text-muted">Welcome back! login with your credentials</p>

    <form action="" class="w-75" method="post" style="margin:0 auto;" onsubmit="return validateLogin()">
        <div class="mb-3">
            <label for="inputEmail" class="form-label">Email address</label>
            <input type="text" class="form-control" id="inputEmail" name="email">
            <div id="email-error" class="error"></div>
            <span class="error">
                <?php
                if (isset($emailErr)) {
                    echo "* " . $emailErr;
                }
                ?>
            </span>
        </div>
        <div class="mb-3">
            <label for="inputPassword" class="form-label">Password</label>
            <input type="password" class="form-control" id="inputPassword" name="password">
            <div id="password-error" class="error"></div>
            <span class="error">
                <?php
                if (isset($passwordErr)) {
                    echo "* " . $passwordErr;
                }
                ?>
            </span>
            <span class="error">
                <?php
                if (isset($attempt->emailErr)) {
                    echo "* " . $attempt->emailErr;
                }
                ?>
            </span>
        </div>
        <p class="text-center mt-2 fs-2 text-muted">Don't have an account?<a href="./register.php">Register</a></p>
        <div class="d-grid gap-2 col-6 mx-auto mt-5 ">
            <button class="btn btn-primary rounded-5 fs-3" type="submit" name="submit" style="background-color:palevioletred ;">login</button>
        </div>
    </form>
</div>












<?php
include "./includes/footer.php";
?>
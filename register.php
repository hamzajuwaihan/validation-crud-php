<?php
include "./includes/head.php";
include "./includes/db_conn.php";
?>
<?php
$email = $firstName = $middleName = $lastName = $familyName = $date = $mobile = $password = $passwordConfirm = null;
$emailErr = $firstNameErr = $middleNameErr = $lastNameErr = $familyNameErr = $dateErr = $mobileErr = $passwordErr = $passwordConfirmErr = null;
$msg = null;
if (isset($_POST['submit'])) {
    if (empty($_POST['email'])) {
        $emailErr = "invalid email";
    }else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "invalid email";
    } else {
        $email = $_POST['email'];
    }

    if (empty($_POST['f-name'])) {
        $firstNameErr = "first name required";
    } else {
        $firstName = $_POST['f-name'];
    }


    if (empty($_POST['m-name'])) {
        $middleNameErr = "middle name required";
    } else {
        $middleName = $_POST['m-name'];
    }


    if (empty($_POST['l-name'])) {
        $lastNameErr = "last name required";
    } else {
        $lastName = $_POST['l-name'];
    }


    if (empty($_POST['fam-name'])) {
        $familyNameErr = "family name required";
    } else {
        $familyName = $_POST['fam-name'];
    }


    if (empty($_POST['mobile'])) {
        $mobileErr = "mobile required";
        
    } else {
        if (strlen($_POST['mobile']) != 14) {
            $mobileErr = "must length 14";
        } else {
            $mobile = $_POST['mobile'];
        }

    }

    if (empty($_POST['date'])) {
        $dateErr = "date name required";
    } else {
        $date = $_POST['date'];
    }


    if (empty($_POST['password'])) {
        $passwordErr = "family name required";
    }else {
        $password=$_POST['password'];
    }
    if (empty($_POST['passwordconfirm'])) {
        $passwordConfirmErr = "family name required";
    }

    if ($_POST['password'] != $_POST['passwordconfirm']) {
        $passwordErr = $passwordConfirmErr = "must match";
    } else {
        $password = $passwordConfirm = $_POST['password'];
    }
    if (isset($email) && isset($firstName) && isset($middleName) && isset($lastName) && isset($familyName) && isset($mobile) && isset($date) && isset($password) && isset($passwordConfirm)) {
        $msg = "registeration is successful";
        $sql = "INSERT INTO users(email,mobile,first_name,middle_name,last_name,family_name,password,date_of_birth,user_type) 
        VALUES('$email','$mobile','$firstName','$middleName','$lastName','$familyName','$password','$date','user')";;
        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        

        mysqli_close($conn);
        header("location:login.php");
    }
}

?>
<div class="container mt-5">
    <h1 class="text-center">Sign up</h1>
    <p class="text-center mt-2 fs-2 text-muted">Create an Account,its free</p>

    <form action="" method="post" class="w-75" style="margin:0 auto;" onsubmit="return Registervalidate()">
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
        <div class="row mb-3">
            <div class="col-md-3">
                <label for="inputFirstName" class="form-label">First Name</label>
                <input type="text" class="form-control" id="inputFirstName" name="f-name">
                <div id="fname-error" class="error"></div>
                <span class="error">
                    <?php
                    if (isset($firstNameErr)) {
                        echo "* " . $firstNameErr;
                    }
                    ?>
                </span>
            </div>
            <div class="col-md-3">
                <label for="inputMiddleName" class="form-label">Middle Name</label>
                <input type="text" class="form-control" id="inputMiddleName" name="m-name">
                <div id="m-name-error" class="error"></div>
                <span class="error">
                    <?php
                    if (isset($middleNameErr)) {
                        echo "* " . $middleNameErr;
                    }
                    ?>
                </span>
            </div>
            <div class="col-md-3">
                <label for="inputLastName" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="inputLastName" name="l-name">
                <div id="l-error" class="error"> </div>
                <span class="error">
                    <?php
                    if (isset($lastNameErr)) {
                        echo "* " . $lastNameErr;
                    }
                    ?>
                </span>
            </div>
            <div class="col-md-3">
                <label for="inputFamilyName" class="form-label">Family Name</label>
                <input type="text" class="form-control" id="inputFamilyName" name="fam-name">
                <div id="fam-name-error" class="error"></div>
                <span class="error">
                    <?php
                    if (isset($familyNameErr)) {
                        echo "* " . $familyNameErr;
                    }
                    ?>
                </span>
            </div>
        </div>
        <div class="mb-3">
            <label for="inputphone" class="form-label">Mobile Number</label>
            <input type="tel" class="form-control" id="inputphone" name="mobile">
            <div id="phone-error" class="error"></div>
            <span class="error">
                <?php
                if (isset($mobileErr)) {
                    echo "* " . $mobileErr;
                }
                ?>
            </span>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Date of Birth</label>
            <input type="date" class="form-control" id="date" name="date">
            <div id="date-error" class="error"></div>
            <span class="error">
                <?php
                if (isset($dateErr)) {
                    echo "* " . $dateErr;
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
        </div>
        <div class="mb-3">
            <label for="inputPasswordConfirm" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="inputPasswordConfirm" name="passwordconfirm">
            <div id="confirm-password-error" class="error"></div>
            <span class="error">
                <?php
                if (isset($passwordConfirmErr)) {
                    echo "* " . $passwordConfirmErr;
                }
                ?>
            </span>
        </div>
        <span class="error">
            <?php
            if (isset($msg)) {
                echo "* " . $msg;
            }
            ?>
        </span>
        <p class="text-center mt-2 fs-2 text-muted">Already have an account?<a href="./login.php">Login</a></p>
        <div class="d-grid gap-2 col-6 mx-auto mt-5 ">
            <button class="btn btn-primary rounded-5 fs-3" type="submit" name="submit" style="background-color:palevioletred ;">Sign up</button>
        </div>
    </form>
</div>
<?php
include "./includes/footer.php";
?>
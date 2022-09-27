<?php
session_start();
include "./includes/db_conn.php";
include "./includes/head.php";
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: index.php');
}
$sql = "SELECT COUNT(id) FROM users";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$num = $row['COUNT(id)'];
$sql = "SELECT SUM(salary) FROM users";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$salary = $row['SUM(salary)'];
$row = null;
$sql = "SELECT MAX(salary) FROM users";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

$highestSalary = $row['MAX(salary)'];

$row = null;
$sql = "SELECT MIN(salary) FROM users";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

$lowestSalary = $row['MIN(salary)'];
?>


<div class="container mt-5">
    <div class="row">
        <div class="card text-bg-success mb-3 col" style="max-width: 18rem;">
            <div class="card-header card-title">
                <h5># Number of Users</h5>
            </div>
            <div class="card-body">
                <h6 class="card-text"><?php echo $num; ?></h6>
            </div>
        </div>
        <div class="card text-bg-info mb-3 mx-3 text-white" style="max-width: 18rem;">
            <div class="card-header card-title">
                <h5>Total Salary $$$</h5>
            </div>
            <div class="card-body">
                <h6 class="card-text"><?php echo  $salary; ?></h6>
            </div>
        </div>
        <div class="card text-bg-light mb-3 " style="max-width: 18rem;" style="max-width: 18rem;">
            <div class="card-header card-title">
                <h5>Highest Salary $$$</h5>
            </div>
            <div class="card-body">
                <h6 class="card-text"><?php echo  $highestSalary; ?></h6>
            </div>
        </div>
        <div class="card text-bg-dark mb-3 mx-3" style="max-width: 18rem;" style="max-width: 18rem;">
            <div class="card-header card-title">
                <h5>Lowest Salary $$$</h5>
            </div>
            <div class="card-body">
                <h6 class="card-text"><?php echo  $lowestSalary; ?></h6>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_POST['update'])) {
    $firstName = $_POST['f-name'];
    $middleName = $_POST['m-name'];
    $lastName = $_POST['l-name'];
    $familyName = $_POST['fam-name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $dateOfBirth = $_POST['date'];
    $mobile = $_POST['mobile'];
    $role = $_POST['role'];
    $sql =  "UPDATE users SET first_name='$firstName',middle_name='$middleName',last_name='$lastName',
    family_name='$familyName',email='$email',mobile='$mobile',password='$password',date_of_birth='$dateOfBirth',user_type='$role'
     WHERE id=" . $_POST['update'];
    if (mysqli_query($conn, $sql)) {
        header("Refresh:0");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
if (isset($_POST['delete'])) {

    $sql = "DELETE FROM users WHERE id=" . $_POST['delete'];;
    if (mysqli_query($conn, $sql)) {
        header("Refresh:0");
    } else {
        echo "Error: " . $sql . "<br>";
    }
}
?>
<?php


$sql = "SELECT * FROM users where user_type='admin'";
$result = mysqli_query($conn, $sql);

echo "

<table class='table'>
    <thead class='bg-primary text-white table-bordered'>
        <th>id</th>
        <th>email</th>
        <th>mobile</th>
        <th>first name</th>
        <th>middle name</th>
        <th>last name</th>
        <th>family name</th>
        <th>password</th>
        <th>date of birth</th>
        <th>date of creation</th>
        <th>user type</th>
    </thead>
    <tbody>";
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {

        echo ("

            <tr>
            <form action='' method='post'>
            <td>" . $row['id'] . "</td>
            <td> " . $row['email'] . " </td>
            <td> " . $row['mobile'] . " </td>
            <td>" . $row['first_name'] . "</td>
            <td>" . $row['middle_name'] . "</td>
            <td>" . $row['last_name'] . "</td>
            <td>" . $row['family_name'] . "</td>
            <td>" . $row['password'] . "</td>
            <td>" . $row['date_of_birth'] . "</td>
            <td>" . $row['date_of_creation'] . "</td>
            <td>" . $row['user_type'] . "</td>
            <td>
            "); ?>
        <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#exampleModal<?php echo $row['id'] ?>'>
            update
        </button>
        <div class="modal fade" id="exampleModal<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <form action="./register.php" method="post">
                <?php
                $sqlSpecific = "SELECT * FROM users where id=" . $row['id'];
                $resultSpecific = mysqli_query($conn, $sqlSpecific);
                $rowSpecific = mysqli_fetch_assoc($resultSpecific)
                ?>
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">update user</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="inputEmail" class="form-label">Email address</label>
                                <input type="text" class="form-control" name="email" value="<?php echo $rowSpecific['email'] ?>">
                                <div id="email-error" class="error"></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="inputFirstName" class="form-label">First Name</label>
                                    <input type="text" class="form-control" name="f-name" value="<?php echo $rowSpecific['first_name'] ?>">
                                    <div id="fname-error" class="error"></div>

                                </div>
                                <div class="col-md-3">
                                    <label for="inputMiddleName" class="form-label">Middle Name</label>
                                    <input type="text" class="form-control" name="m-name" value=<?php echo $rowSpecific['middle_name'] ?>>
                                    <div id="m-name-error" class="error"></div>

                                </div>
                                <div class="col-md-3">
                                    <label for="inputLastName" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" name="l-name" value=<?php echo $rowSpecific['last_name'] ?>>
                                    <div id="l-error" class="error"> </div>

                                </div>
                                <div class="col-md-3">
                                    <label for="inputFamilyName" class="form-label">Family Name</label>
                                    <input type="text" class="form-control" name="fam-name" value=<?php echo $rowSpecific['family_name'] ?>>
                                    <div id="fam-name-error" class="error"></div>

                                    </span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="inputphone" class="form-label">Mobile Number</label>
                                <input type="tel" class="form-control" name="mobile" value=<?php echo $rowSpecific['mobile'] ?>>
                                <div id="phone-error" class="error"></div>
                            </div>
                            <label for="role" class="form-label">Role:</label>
                            <select class="form-select mb-3" aria-label="choose role" id="role" name="role" required>
                                <option selected disabled>Open this select menu</option>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                            <div class="mb-3">
                                <label for="date" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" name="date" value=<?php echo $rowSpecific['date_of_birth'] ?>>
                                <div id="date-error" class="error"></div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" value=<?php echo $rowSpecific['password'] ?>>
                                <div id="password-error" class="error"></div>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary" name="update" type="submit" value="<?php echo $rowSpecific['id'] ?>">Save changes</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
<?php
        echo ("
            </form>
            </td>
            <form action='' method='post'> 
                <td>
                <button type='submit' name='delete' value='" . $row['id'] . "' class='btn btn-danger'>Delete</button></td>
            </form>
            </tr>
                ");
    }
    echo "</tbody>
    </table>
    ";
} else {
    echo "0 results";
}
?>
<div class="container text-center mt-5">
    <form action="" method="POST">
        <button class="btn btn-primary btn-lg" name="logout" type="submit" value="submit">Logout</button>
    </form>
</div>


<?php

include "./includes/footer.php";
?>
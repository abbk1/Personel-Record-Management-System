<?php include 'includes/header.php' ?>
<?php
if (!isset($_SESSION['user_role'])) {
    header('Location: login.php');
}
?>
    <div id="wrapper">

        <!-- Navigation -->
        <?php include 'includes/nav.php' ?>
        <?php include 'includes/title.php' ?>

    <?php 
    if (isset($_GET['id'])) {

         $userId = $_GET['id'];


         if (empty($userId)) {

            $message = "<h3 class='text-warning'>No user found!!! </h3>";
        }else{

        if (authorizedUser($userId)) {
                
        $query = "SELECT * FROM `tblusers` WHERE `user_id` = $userId";
        $result = mysqli_query($conn, $query);
        confirmQuery($result);

        if ($row = mysqli_fetch_assoc($result)) {
            $user_id = $row['user_id'];
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $othername = $row['othername'];
            $gender = $row['gender'];
            $phonenumber = $row['phonenumber'];
            $email = $row['email'];
            $username = $row['username'];
            $password = $row['password'];
            $user_role = $row['user_role'];
        }

    }else{
        $message = "<p class='text-danger'> You are not authorized to view this user profile!!! </p>";
    }

}
    }


    $str = "Line 1\nLine 2\rLine 3\r\nLine 4\n";
$order   = array("\r\n", "\n", "\r");
$replace = '<br />';

// Processes \r\n's first so they aren't converted twice.
$newstr = str_replace($order, $replace, $str);
    ?>

    <style>
        .profile-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .profile-header h2,
        .profile-header h3,
        .profile-header h4 {
            margin: 0;
            padding: 5px 0;
        }

        .profile-container {
            width: 80%;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 10px;
            background: #f9f9f9;
        }

        .profile-container .profile-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
        }

        .profile-container .profile-row div {
            width: 45%;
        }

        .profile-container .profile-row div label {
            font-weight: bold;
        }

        .profile-container .profile-row div p {
            margin: 0;
        }
    </style>
<?= isset($message)? $message: ''; ?>
    <div class="profile-header">
        <h2>User Profile</h2>
        <h3><?= isset($firstname)? $firstname . " " . $lastname : '' ?></h3>
        <h4>User ID: <?= isset($user_id)? $user_id : '' ?></h4>
    </div>

    <div class="profile-container">
        <div class="profile-row">
            <div>
                <label>First Name:</label>
                <p><?= isset($firstname)? $firstname : '' ?></p>
            </div>
            <div>
                <label>Last Name:</label>
                <p><?= isset($lastname)? $lastname : '' ?></p>
            </div>
        </div>
        <div class="profile-row">
            <div>
                <label>Other Name:</label>
                <p><?= isset($othername)? $othername : '' ?></p>
            </div>
            <div>
                <label>Gender:</label>
                <p><?= isset($gender)? $gender : '' ?></p>
            </div>
        </div>
        <div class="profile-row">
            <div>
                <label>Phone Number:</label>
                <p><?= isset($phonenumber)? $phonenumber : '' ?></p>
            </div>
            <div>
                <label>Email:</label>
                <p><?= isset($email)? $email : '' ?></p>
            </div>
        </div>
        <div class="profile-row">
            <div>
                <label>Username:</label>
                <p><?= isset($username)? $username : '' ?></p>
            </div>
            <div>
                <label>Password:</label>
                <p><?= isset($password)? str_replace($password,$password,'*************') : '' ?></p>
            </div>
        </div>
        <div class="profile-row">
            <div>
                <label>User Role:</label>
                <p><?= isset($user_role)? $user_role: '' ?></p>
            </div>
        </div>
    </div>

</div>
<!-- /#wrapper -->
<?php include 'includes/footer.php'; ?>

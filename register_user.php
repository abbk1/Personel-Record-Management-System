<?php include 'includes/header.php' ?>
<?php
if (!isset($_SESSION['user_role'])) {
    header('Location: login.php');
}
?>
    <div id="wrapper">

        <!-- Navigation -->

<?php include 'includes/nav.php' ?>

<?php $heading = "REGISTER USER" ?>
<?php include 'includes/title.php' ?>
                <!-- /.row -->
                 <?php
                    if(isset($_POST['submit'])) 
                    {
                        $firstname = $_POST['firstname'];
                        $lastname = $_POST['lastname'];
                        $othername = $_POST['othername'];
                        $phonenumber = $_POST['phonenumber'];
                        $gender = $_POST['gender'];
                        $email = $_POST['email'];
                        $user_role = $_POST['user_role'];
                        $username = $_POST['username'];
                        $password = $_POST['password'];
                        $confirm_password = $_POST['confirm_password'];

                        $errorArr = [];
                        $globalMessage = '';

                        if(empty($firstname)){
                            $errorArr['firstname'] = '<p class="text-danger">This field require!</p>';
                        }else{
                            $firstname = filterName($firstname);
                            if($firstname == false){
                                $errorArr['firstname'] = '<p class="text-danger">Please enter a valid name!</p>';
                        }
                    }
                    
                        if(empty($lastname)){
                            $errorArr['lastname'] = '<p class="text-danger">This field require!</p>';
                        }else{
                            $lastname = filterName($lastname);
                            if($lastname == false){
                                $errorArr['lastname'] = '<p class="text-danger">Please enter a valid name!</p>';
                        }
                    }

                            if(!empty($othername)){
                            $othername = filterName($othername);
                            if($othername == false){
                                $errorArr['othername'] = '<p class="text-danger">Please enter a valid name!</p>';
                        }
                    }

                    $pattern = '/^(\+234\s?\d{8}|\d{11})$/';
                    if(!$match = preg_match($pattern, $phonenumber)) {

                        $errorArr['phonenumber'] = '<p class="text-danger">Please only number is allow and should not be less or above 11 digits!</p>';
                    }

                    if(empty($gender)){
                        $errorArr['gender'] = '<p class="text-danger">Please select gender!</p>';
                    }

                    if(empty($email)){
                        $errorArr['email'] = '<p class="text-danger">This field should not be empty!</p>';
                    }else{
                        $email = filterEmail($email);
                        if($email == false){
                            $errorArr['email'] = '<p class="text-danger">Please enter a valid email!</p>';
                        }
                    }

                    if(empty($user_role)){
                        $errorArr['user_role'] = '<p class="text-danger">Please select role!</p>';
                    }

                    if(empty($username)){
                        $errorArr['username'] = '<p class="text-danger">Please enter username!</p>';
                    }else{
                        $username = filterName($username);
                        if($username == false){
                            $errorArr['username'] = '<p class="text-danger">invalid username (only letters is allowed)!</p>';
                        }
                    }

                    if(empty($password)){
                        $errorArr['password'] = '<p class="text-danger">Please enter password!</p>';
                    }else{
                        $password = validatePassword($password);
                        if($password == false){

                            $errorArr['password'] = '<p class="text-danger">Please password must only contain numbers and letters!</p>';
                        }
                    }

                    if($password != $confirm_password){
                        $errorArr['confirmpassword'] = '<p class="text-danger">Password must match!</p>';
                    }

                                        

                        if(empty($errorArr)){

                        $query = "INSERT INTO `tblusers`(`firstname`, `lastname`, `othername`, `gender`, `phonenumber`, `email`, `username`, `password`, `user_role`, `status`) ";
                        $query .= " VALUES ('$firstname','$lastname','$othername','$gender','$phonenumber','$email','$username','$password','$user_role',1) ";
                        $execute_query = mysqli_query($conn, $query);

                        if(!$execute_query){
                            echo "QUERY FAILD:".mysqli_error($conn);
                            die;
                        }

                         header('Location: view_users.php?success');
                    }
        
                    }
                ?>
    
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">User Registration</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="register_user.php">
                            <fieldset>
                                <div class="form-group">
                                    <label for="firstname">First Name</label>
                                    <input class="form-control" 
                                    value="<?= (isset($firstname)) ? $firstname : ''; ?>" 
                                    placeholder="Enter first name" 
                                    name="firstname" 
                                    type="text" required>
                                    <span><?= (isset($errorArr['firstname']))? $errorArr['firstname'] : ''; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="lastname">Last Name</label>
                                    <input class="form-control" 
                                    value="<?= (isset($lastname)) ? $lastname : ''; ?>" 
                                    placeholder="Enter last name" 
                                    name="lastname" 
                                    type="text" required>
                                    <span><?= (isset($errorArr['lastname']))? $errorArr['lastname'] : ''; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="othername">Other Name</label>
                                    <input class="form-control" 
                                    value="<?= (isset($othername)) ? $othername : ''; ?>" 
                                    placeholder="Enter other name" 
                                    name="othername" 
                                    type="text">
                                    <span><?= (isset($errorArr['othername']))? $errorArr['othername'] : ''; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="phonenumber">Phone Number</label>
                                    <input class="form-control"
                                     value="<?= (isset($phonenumber)) ? $phonenumber : ''; ?>" 
                                     placeholder="08011112222" 
                                     name="phonenumber" 
                                     type="number" required>
                                     <span><?= (isset($errorArr['phonenumber']))? $errorArr['phonenumber'] : ''; ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select name="gender" id="gender" class="form-control">
                                        <?php 
                                        if(isset($gender)):?>
                                        <option value="<?=$gender?>"><?=$gender?></option>';
                                        <?php endif; ?>
                                        <option value="">--select--</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                    <span><?= (isset($errorArr['gender']))? $errorArr['gender'] : ''; ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input class="form-control"
                                    value="<?= (isset($email)) ? $email : ''; ?>" 
                                     placeholder="smith@gmail.com" 
                                     name="email" 
                                     type="email" required>
                                     <span><?= (isset($errorArr['email']))? $errorArr['email'] : ''; ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="user_role">User Role</label>
                                    <select name="user_role" id="user_role" class="form-control">
                                        <?php if(isset($user_role)):?>
                                        <option value="<?=$user_role?>"><?=$user_role?></option>';
                                        <?php endif; ?>
                                        <option value="">--select--</option>
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
                                    </select>
                                    <span><?= (isset($errorArr['user_role']))? $errorArr['user_role'] : ''; ?></span>
                                </div>
                            
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input class="form-control" 
                                    value="<?= (isset($username)) ? $username : ''; ?>" 
                                    placeholder="Enter Username" 
                                    name="username" 
                                    type="text" autofocus required>
                                    <span><?= (isset($errorArr['username']))? $errorArr['username'] : ''; ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input class="form-control" 
                                    placeholder="Password" 
                                    name="password" 
                                    type="password" 
                                    value="" required>
                                    <span><?= (isset($errorArr['password']))? $errorArr['password'] : ''; ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="confirmpassword">Re-Enter Password</label>
                                    <input class="form-control" 
                                    placeholder="Confirm Password" 
                                    name="confirm_password" 
                                    type="password" 
                                    value="" required>
                                    <span><?= (isset($errorArr['confirmpassword']))? $errorArr['confirmpassword'] : ''; ?></span>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" name="submit" class="btn btn-lg btn-success btn-block">Register</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>



        </div>
    
        </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <?php include 'includes/footer.php' ?>

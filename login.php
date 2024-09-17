<?php include 'includes/header.php' ?>

<?php
if(isset($_POST["login"])) {

	$email = escapeString($_POST["email"]);
	$password = escapeString($_POST["password"]);

	if(!empty($email) && !empty($password)) {

	$query = "SELECT * FROM tblusers WHERE email = '$email' AND password = '$password'";

	$select_user = mysqli_query($conn, $query);

	confirmQuery($select_user);

	if(mysqli_num_rows($select_user) > 0){
		while($row = mysqli_fetch_assoc($select_user)){
			$user_id   = $row['user_id'];
			$firstname = $row['firstname'];
			$lastname  = $row['lastname'];
			$user_role = $row['user_role'];
			$email 	   = $row['email'];
			$status    = $row['status'];
		}
		$_SESSION['user_id'] = $user_id;
		$_SESSION['firstname'] = $firstname;
		$_SESSION['lastname'] = $lastname;
		$_SESSION['user_role'] = trim($user_role);
		$_SESSION['user_email'] = $email;
		$_SESSION['status'] = $status;

		if(checkIfUserLogin()){
			header('Location: index.php');
		}else{
			header('Location: login.php');
		}
	
	}else {

		$message = '<p class="text-danger">Invalid User email or Password</p>';
	}
}else{
	$message = '<p class="text-danger">All fields are required</p>';
}

}

?>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                    <?= $message = (isset($message)) ? $message : '' ; ?>
                        <form role="form" method="post" action="">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="enter email or username" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" name="login" class="btn btn-lg btn-success btn-block">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>

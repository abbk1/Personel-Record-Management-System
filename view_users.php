
<?php include 'includes/header.php' ?>
<?php
if (!isset($_SESSION['user_role'])) {
    header('Location: login.php');
}
?>
    <div id="wrapper">

        <!-- Navigation -->
        <?php include 'includes/nav.php' ?>

        <?php $heading = "USER RECORDS" ?>
        <?php include 'includes/title.php' ?>
                <!-- /.row -->

                        <?php 
                          $query = "SELECT * FROM `tblusers`";
                          $result = mysqli_query($conn, $query);

                          confirmQuery($result);
                          if (mysqli_num_rows($result)) {
                           while ($row = mysqli_fetch_assoc($result)){
                               
                               $user_id   = $row['user_id'];
                               $firstname = $row['firstname'];
                               $lastname  = $row['lastname'];
                               $othername = $row['othername'];
                               $gender    = $row['gender'];
                               $phonenumber = $row['phonenumber'];
                               $email       = $row['email'];
                               $username    = $row['username'];
                               $password    = $row['password'];
                               $user_role   = $row['user_role'];
                           }
  
                          }
                        ?>
                        <?php

                    if (isset($_GET['success'])) {
                       $message = "<p class='text-success'>User created successfully!</p>";
                    }
                    if (isset($_GET['edit'])) {
                       $message = "<p class='text-success'>User updated successfully!</p>";
                    }

                    if (isset($_GET['delete'])) {
                        $deleteId = $_GET['delete'];

                        $query = "DELETE FROM tblusers WHERE user_id = $deleteId";
                        $delete_query = mysqli_query($conn, $query);
                        confirmQuery($delete_query);
                        header("Location: view_users.php");                    
                    }
                        ?>

                <!-- Data Table -->
                <div class="row">
                    <div class="col-lg-12">
                        <?= isset($message)? $message : ''; ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>FIRST NAME</th>
                                        <th>LAST NAME</th>
                                        <th>OTHER NAME</th>
                                        <th>GENDER</th>
                                        <th>PHONE NUMBER</th>
                                        <th>EMAIL</th>
                                        <th>USERNAME</th>
                                        <th>PASSWORD</th>
                                        <th>USER ROLE</th>
                                        <th>EDIT</th>
                                        <th>DELETE</th>
                                    </tr>
                                </thead>
                                <tbody>
                        <?php 
                        $query = "SELECT * FROM tblusers ORDER BY user_id DESC";
                        $select_user = mysqli_query($conn, $query);

                        confirmQuery($select_user);
                        if (mysqli_num_rows($select_user)) {
                            $i = 0;
                        while ($row = mysqli_fetch_assoc($select_user)){
                            $i=$i+1;
                            $user_id = $row['user_id'];
                            $firstname = $row['firstname'];
                            $lastname  = $row['lastname'];
                            $othername = $row['othername'];
                            $gender    = $row['gender'];
                            $phonenumber = $row['phonenumber'];
                            $email      = $row['email'];
                            $username   = $row['username'];
                            $password   = $row['password'];
                            $user_role  = $row['user_role'];
                        

                                echo "<tr>";
                                    echo  "<td>$i</td>";
                                    echo  "<td>$firstname</td>";
                                    echo  "<td>$lastname</td>";
                                    echo  "<td>$othername</td>";
                                    echo  "<td>$gender</td>";
                                    echo  "<td>$phonenumber</td>";
                                    echo  "<td>$email</td>";
                                    echo  "<td>$username</td>";
                                    echo  "<td>$password</td>";
                                    echo  "<td>$user_role</td>";
                                    echo  "<td><a class='btn btn-warning' href='edit_user.php?edit=$user_id'>Edit</a></td>";
                                    echo "<td><a class='btn btn-danger' onclick='return confirm(\"Are you sure you want to Delete\")' href='view_users.php?delete=$user_id'>Delete</a></td>";
                                echo "</tr>";
                        }
                    }
                        ?>
                                    <!-- Add more records as needed -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

      
<?php include 'includes/footer.php' ?>
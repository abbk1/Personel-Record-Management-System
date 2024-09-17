<?php include 'includes/header.php' ?>
<?php
if (!isset($_SESSION['user_role'])) {
    header('Location: login.php');
}
?>
    <div id="wrapper">

        <!-- Navigation -->

<?php include 'includes/nav.php' ?>

<?php $heading = "ADD DEPARTMENT" ?>
<?php include 'includes/title.php' ?>

            <?php
            if (isset($_POST['submit'])) {

                $errorArr = [];
                $department = escapeString($_POST['department']);
                if(empty($department)) {
                    $errorArr['department'] = '<p class="text-danger">this field is required!</p>';
                }else{
                    $department = filterName($department);
                    if($department == false) {
                        $errorArr['department'] = '<p class="text-danger">Invalid department name</p>';
                    }
                }

                if(empty($errorArr)) {
                    $query = "INSERT INTO tbldepartments(depname) VALUE ('$department')";
                    $execute_query = mysqli_query($conn, $query);
                    confirmQuery($execute_query);
                    header("Location: adddepartment.php");
                }

            }


            // edit departmenrt
            if (isset($_GET['updatedep'])) {
                $depname = $_GET['dep'];
                $dep_id = $_GET['id'];
               $query = "UPDATE tbldepartments SET depname = '$depname' WHERE dep_id = $dep_id";
               $select_depa = mysqli_query($conn, $query);
               confirmQuery($select_depa);
               header('Location: adddepartment.php');
            }
            ?>
                <!-- /.row -->

        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">ADD DEPARTMENT</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="adddepartment.php">
                            <fieldset>
                                <div class="form-group">
                                    <label for="firstname">Department Name</label>
                                    <input class="form-control" value="<?= isset($_POST['department'])? $_POST['department'] : ''; ?>" placeholder="Enter department" name="department" type="text">
                                    <span><?= (isset($errorArr['department']))? $errorArr['department'] : ''; ?></span>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" name="submit" class="btn btn-lg btn-success btn-block">ADD</button>
                            </fieldset>
                        </form>
                    </div>

                    <?php 
                    if (isset($_GET['edit'])) {
                       $dep_id = escapeString($_GET['edit']);
                       $query = "SELECT * FROM `tbldepartments` WHERE dep_id = $dep_id";
                       $select_depa = mysqli_query($conn, $query);
                       confirmQuery($select_depa);
                       if (mysqli_num_rows($select_depa)) {
                        $row = mysqli_fetch_assoc($select_depa);
                        $depname = $row['depname'];
                         }
                        ?>
                        
                    <div class="panel-heading">
                        <h3 class="panel-title">UPDATE Department</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form">
                            <fieldset>
                                <div class="form-group">
                                    <label for="firstname">Edit Name</label>
                                    <input class="form-control" value="<?= $depname; ?>" placeholder="Enter departmrnt" name="dep" type="text">
                                    <input class="form-control" value="<?= $dep_id; ?>" name="id" type="hidden">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" name="updatedep" class="btn btn-lg btn-success btn-block">UPDATE</button>
                            </fieldset>
                        </form>
                    </div>

                    <?php }?>

                </div>
            </div>

                  <?php 
                    if (isset($_GET['delete'])) {
                       $dep_id = escapeString($_GET['delete']);
                       $query = "DELETE FROM `tbldepartments` WHERE dep_id = $dep_id";
                       $delete_depa = mysqli_query($conn, $query);
                       confirmQuery($delete_depa);
                       header('Location: adddepartment.php');
                    }
                   ?>

            <div class="col-lg-6">
                        <h2 class="page-header">DEPARTMENTS</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>RANK Name</th>
                                        <th class="text-center">DELETE</th>
                                        <th class="text-center">EDIT</th>
                                    </tr>
                                </thead>
                                <tbody>

                        <?php 
                          $query = "SELECT * FROM `tbldepartments`";
                          $select_depa = mysqli_query($conn, $query);
                          confirmQuery($select_depa);
                          if (mysqli_num_rows($select_depa)) {
                           while ($row = mysqli_fetch_assoc($select_depa)){
                               $dep_id   = $row['dep_id'];
                               $department = $row['depname'];

                                   echo "<tr>";
                                       echo "<td>$dep_id</td>";
                                       echo "<td>$department</td>";
                                       echo "<td class='text-center'> <a href='adddepartment.php?edit=$dep_id' class='btn btn-warning'>Edit</a> </td>";
                                       echo "<td><a class='btn btn-danger' onclick='return confirm(\"Are you sure you want to Delete\")' href='adddepartment.php?delete=$dep_id'>Delete</a></td>";
                                  echo " </tr>";

                                }
                            }
                          ?>
                                    <!-- Add more records as needed -->
                                </tbody>
                            </table>
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

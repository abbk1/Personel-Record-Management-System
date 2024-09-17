<?php include 'includes/header.php' ?>
<?php
if (!isset($_SESSION['user_role'])) {
    header('Location: login.php');
}
?>
    <div id="wrapper">

        <!-- Navigation -->

<?php include 'includes/nav.php' ?>

<?php $heading = "ADD RANK" ?>

<?php include 'includes/title.php' ?>

<?php
            if (isset($_POST['submit'])) {
                $errorArr = [];
                $rank = escapeString($_POST['rank']);

                if(empty($rank)) {
                    $errorArr['rank'] = '<p class="text-danger">this field is required!</p>';
                }else{
                    $rank = filterName($rank);
                    if($rank == false) {
                        $errorArr['rank'] = '<p class="text-danger">Invalid rank name</p>';
                    }
                }

                if(empty($errorArr)) {
                    $query = "INSERT INTO tblrank(rankname) VALUE ('$rank')";
                    $execute_query = mysqli_query($conn, $query);
                    confirmQuery($execute_query);

                    header("Location: addrank.php");
                }
            }

            // edit rank
            if (isset($_GET['updateRank'])) {
                $rank = $_GET['rank'];
                $rank_id = $_GET['id'];

               $query = "UPDATE tblrank SET rankname = '$rank' WHERE rank_id = $rank_id";
               $select_depa = mysqli_query($conn, $query);
               confirmQuery($select_depa);
               header('Location: addrank.php');
            }
            
            ?>
       
                <!-- /.row -->

        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">ADD RANK</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="addrank.php">
                            <fieldset>
                                <div class="form-group">
                                    <label for="firstname">Rank Name</label>
                                    <input class="form-control" value="<?= isset($_POST['rank'])? $_POST['rank'] : '';?>" placeholder="Enter rank" name="rank" type="text">
                                    <span><?= isset($errorArr['rank'])? $errorArr['rank'] : ''; ?></span>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" name="submit" class="btn btn-lg btn-success btn-block">ADD</button>
                            </fieldset>
                        </form>
                    </div>


                    <?php 
                    if (isset($_GET['edit'])) {
                       $rank_id = escapeString($_GET['edit']);
                       $query = "SELECT * FROM `tblrank` WHERE rank_id = $rank_id";
                       $select_rank = mysqli_query($conn, $query);
                       confirmQuery($select_rank);
                       if (mysqli_num_rows($select_rank)) {
                        $row = mysqli_fetch_assoc($select_rank);
                        $rankname = $row['rankname'];
                        
                         }

                        ?>

                    <div class="panel-heading">
                        <h3 class="panel-title">UPDATE RANK</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form">
                            <fieldset>
                                <div class="form-group">
                                    <label for="firstname">Edit Name</label>
                                    <input class="form-control" value="<?= $rankname; ?>" placeholder="Enter rank" name="rank" type="text">
                                    <input class="form-control" value="<?= $rank_id; ?>" name="id" type="hidden">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" name="updateRank" class="btn btn-lg btn-success btn-block">UPDATE</button>
                            </fieldset>
                        </form>
                    </div>

                    <?php } ?>

                </div>
            </div>


            <?php 
                    if (isset($_GET['delete'])) {
                       $rank_id = escapeString($_GET['delete']);
                       $query = "DELETE FROM `tblrank` WHERE rank_id = $rank_id";
                       $delete_rank = mysqli_query($conn, $query);
                       confirmQuery($delete_rank);
                       header('Location: addrank.php');
                    }

                        ?>
            <div class="col-lg-6">
                        <h2 class="page-header">RANKS</h2>
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
                          $query = "SELECT * FROM `tblrank`";
                          $select_depa = mysqli_query($conn, $query);
                          confirmQuery($select_depa);
                          if (mysqli_num_rows($select_depa)) {

                           while ($row = mysqli_fetch_assoc($select_depa)){
                               $rank_id   = $row['rank_id'];
                               $rank = $row['rankname'];

                                   echo "<tr>";
                                       echo "<td>$rank_id</td>";
                                       echo "<td>$rank</td>";
                                       echo "<td class='text-center'> <a href='addrank.php?edit=$rank_id' class='btn btn-warning'>Edit</a> </td>";
                                       echo "<td><a class='btn btn-danger' onclick='return confirm(\"Are you sure you want to Delete\")' href='addrank.php?delete=$rank_id'>Delete</a></td>";
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

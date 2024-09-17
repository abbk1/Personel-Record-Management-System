
<?php include 'includes/header.php' ?>
<?php

if (!isset($_SESSION['user_role'])) {
    header('Location: login.php');
}

?>
    <div id="wrapper">
        <!-- Navigation -->
        <?php include 'includes/nav.php' ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           HOME
                            <small>Dashboard</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <!-- <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li> -->
                        </ol>
                        
          
 <div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                    <?php  
                    $query = "SELECT * FROM tblusers";
                    $select_all_users = mysqli_query($conn, $query);
                    confirmQuery($select_all_users);
                    $count_users = mysqli_num_rows($select_all_users);
                    ?>

                     <div class='huge'><?= $count_users; ?></div>
                        <div>USERS</div>
                    </div>
                </div>
            </div>
            <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
            <a href="view_users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
            <?php else: ?>
                <a href="index.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                    <?php  
                    $query = "SELECT * FROM tblusers WHERE user_role = 'admin'";
                    $select_all_admin = mysqli_query($conn, $query);
                    confirmQuery($select_all_admin);
                    $count_admins = mysqli_num_rows($select_all_admin);
                    ?>
                    
                    <div class='huge'><?= $count_admins; ?></div>
                        <div>ADMINS</div>
                    </div>
                </div>
            </div>
            <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
            <a href="view_users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
            <?php else: ?>
                <a href="index.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
            <?php endif; ?>

        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                    <?php  
                    $query = "SELECT * FROM tbldepartments";
                    $select_all_dep = mysqli_query($conn, $query);
                    confirmQuery($select_all_dep);
                    $count_departments = mysqli_num_rows($select_all_dep);
                    ?>
                 
                         <div class='huge'><?= $count_departments; ?></div>
                        <div>DEPARTMENTS</div>
                    </div>
                </div>
            </div>
            <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
            <a href="adddepartment.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
            <?php else: ?>
                <a href="index.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
            <?php endif; ?>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                    <?php  
                    $query = "SELECT * FROM tblbiodata";
                    $select_all_dep = mysqli_query($conn, $query);
                    confirmQuery($select_all_dep);
                    $count_staffs = mysqli_num_rows($select_all_dep);
                    ?>
            
                         <div class='huge'><?= $count_staffs ?></div>
                      <div>STAFFS</div>
                    </div>
                </div>
            </div>
            <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
            <a href="view_records.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
            <?php else: ?>
                <a href="index.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
            <?php endif; ?>
        </div>
    </div>
</div>
<center>
    <div id="columnchart_values" style="width: 1300px; height: 500px;"></div>
</center>


<script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "", { role: "style" } ],
        ["Users", <?= $count_users?>, "#b87333"],
        ["Admins", <?= $count_admins?>, "silver"],
        ["Departments", <?= $count_departments?>, "gold"],
        ["Staffs", <?= $count_staffs?>, "color: #e5e4e2"]
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "PERSONEL RECORD MANAGEMENT SYSTEM",
        width: 1300,
        height: 500,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }
  </script>

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
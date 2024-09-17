<?php include 'includes/header.php';?>
<?php
if (!isset($_SESSION['user_role'])) {
    header('Location: login.php');
}

if (isset($_GET['error'])) {

   $notFound = escapeString($_GET['error']);
   $message = "<h4 class='text-warning'>No Record Found!</h4>";
}
?>
    <div id="wrapper">

        <!-- Navigation -->
        <?php include 'includes/nav.php' ?>

        <?php $heading = "STAFF RECORDS" ?>
        <?php include 'includes/title.php' ?>
                <!-- /.row -->

                <?php

                    if (isset($_GET['delete'])) {
                        $deleteId = $_GET['delete'];

                        $query = "DELETE FROM tblbiodata WHERE biodata_id = $deleteId";
                        $delete_query = mysqli_query($conn, $query);
                        confirmQuery($delete_query);
                        header("Location: view_records.php?success&deleted");
                            
                    }

                    $user_id = $_SESSION['user_id'];

                        ?>
                      
                <!-- Data Table -->
                <div class="row">
                    <div class="col-lg-12">
                        <?= isset($message)? $message : ''; ?>
                        <div class="form-group">
                            <button class='btn btn-success'><a class='btn btn-success' href='export.php'>Export to Excel File</a></button> 
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>FILE NUMBER</th>
                                        <th>IPPIS NUMBER</th>
                                        <th>FIRST NAME</th>
                                        <th>LAST NAME</th>
                                        <th>OTHER NAME</th>
                                        <th>GENDER</th>
                                        <th>PHONE</th>
                                        <th>EMAIL</th>
                                        <th>QUALIFICATION</th>
                                        <th>DATE OF BIRTH</th>
                                        <th>DATE OF FIRST APPOINTMENT</th>
                                        <th>DATE OF LAST PROMOTION</th>
                                        <th>TYPE OF APP</th>
                                        <th>COUNTRY</th>
                                        <th>STATE</th>
                                        <th>LGA</th>
                                        <th>SECTION</th>
                                        <th>DEPARTMENT</th>
                                        <th>RANK</th>
                                        <th>SALARY STRU.</th>
                                        <th>CONDITESS</th>
                                        <th>STEP</th>
                                        <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                                        <th>EDIT</th>
                                        <?php endif; ?>
                                        <th>VIEW</th>
                                        <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                                        <th>DELETE</th>
                                        <?php endif; ?>

                                    </tr>
                                </thead>
                                <tbody>
                        <?php 
                        if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'user'):

                          $query = "SELECT `biodata_id`,`file_no`,`ippis_no`,`firstname`,`lastname`,`othername`,`gender`,`phonenumber`, ";
                          $query .= " `email`,`qualifications`, `dob`,`do_ap`,`do_pa`,`type_app`,`countryname`,`statename`,`lganame`, ";
                          $query .= " `section`,`department`,`rank`,`salary_structure`, `conditess`,`steps` ";
                          $query .= " FROM `tblbiodata` AS bdt INNER JOIN tbllga AS lg ON bdt.lga=lg.lgaid ";
                          $query .= " INNER JOIN tblstate AS st ON lg.stateid=st.stateid ";
                          $query .= " INNER JOIN tblcountries AS ct ON st.countryid=ct.countryid WHERE user_id = $user_id ORDER BY biodata_id DESC";
                        else:
                            $query = "SELECT `biodata_id`,`file_no`,`ippis_no`,`firstname`,`lastname`,`othername`,`gender`,`phonenumber`, ";
                            $query .= " `email`,`qualifications`, `dob`,`do_ap`,`do_pa`,`type_app`,`countryname`,`statename`,`lganame`, ";
                            $query .= " `section`,`department`,`rank`,`salary_structure`, `conditess`,`steps` ";
                            $query .= " FROM `tblbiodata` AS bdt INNER JOIN tbllga AS lg ON bdt.lga=lg.lgaid ";
                            $query .= " INNER JOIN tblstate AS st ON lg.stateid=st.stateid ";
                            $query .= " INNER JOIN tblcountries AS ct ON st.countryid=ct.countryid ORDER BY biodata_id DESC";
                        endif;
                          $result = mysqli_query($conn, $query);

                          confirmQuery($result);
                          if (mysqli_num_rows($result)) {
                            $i = 0;
                           while ($row = mysqli_fetch_assoc($result)){
                               $i = $i+1;
                               $biodata_id = $row['biodata_id'];
                               $file_no   = $row['file_no'];
                               $ippis_no   = $row['ippis_no'];
                               $firstname = $row['firstname'];
                               $lastname  = $row['lastname'];
                               $othername = $row['othername'];
                               $gender    = $row['gender'];
                               $phonenumber = $row['phonenumber'];
                               $email       = $row['email'];
                               $qualification = $row['qualifications'];
                               $dob     = $row['dob'];
                               $doapp   = $row['do_ap'];
                               $dopa    = $row['do_pa'];
                               $typeOfApp = $row['type_app'];
                               $country = $row['countryname'];
                               $state   = $row['statename'];
                               $lga     = $row['lganame'];
                               $section = $row['section'];
                               $department = $row['department'];
                               $rank = $row['rank'];
                               $salaryStructure = $row['salary_structure'];
                               $conditess = $row['conditess'];
                               $step = $row['steps'];
                         
                                    echo "<tr>";
                                      echo  "<td>$i</td>";
                                      echo  "<td>PI/$file_no</td>";
                                      echo  "<td>TI$ippis_no</td>";
                                      echo  "<td>$firstname</td>";
                                      echo  "<td>$lastname</td>";
                                      echo  "<td>$othername</td>";
                                      echo  "<td>$gender</td>";
                                      echo  "<td>$phonenumber</td>";
                                      echo  "<td>$email</td>";
                                      echo  "<td>$qualification</td>";
                                      echo  "<td>$dob</td>";
                                      echo  "<td>$doapp</td>";
                                      echo  "<td>$dopa</td>";
                                      echo  "<td>$typeOfApp</td>";
                                      echo  "<td>$country</td>";
                                      echo  "<td>$state</td>";
                                      echo  "<td>$lga</td>";
                                      echo  "<td>$section</td>";
                                      echo  "<td>$department</td>";
                                      echo  "<td>$rank</td>";
                                      echo  "<td>$salaryStructure</td>";
                                      echo " <td>$conditess</td>";
                                      echo "<td>$step</td>";
                                      if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'):
                                      echo  "<td><a class='btn btn-warning' href='edit_staff.php?id=$biodata_id'>Edit</a></td>";
                                      endif;
                                      echo  "<td><a class='btn btn-success' href='print_record.php?id=$biodata_id'>View</a></td>";
                                      if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'):
                                       echo "<td><a class='btn btn-danger' onclick='return confirm(\"Are you sure you want to Delete\")' href='view_records.php?delete=$biodata_id'>Delete</a></td>";
                                       endif;
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
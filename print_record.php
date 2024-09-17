
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
                <!-- /.row -->

    <?php 
    if (isset($_GET['id'])) {
        $recordId = $_GET['id'];

        $query = "SELECT `biodata_id`, `file_no`,`ippis_no`, `firstname`, `lastname`, `othername`, `gender`, `phonenumber`, `email`, `qualifications`, `dob`, `do_ap`, `do_pa`, `type_app`, `countryname`, `statename`, `lganame`, `section`, `department`, `rank`, `salary_structure`, `conditess`, `steps` ";
        $query .= "FROM `tblbiodata` AS bdt INNER JOIN tbllga AS lg ON bdt.lga=lg.lgaid ";
        $query .= "INNER JOIN tblstate AS st ON lg.stateid=st.stateid ";
        $query .= "INNER JOIN tblcountries AS ct ON st.countryid=ct.countryid ";
        $query .= "WHERE `biodata_id` = $recordId";

        $result = mysqli_query($conn, $query);
        confirmQuery($result);

        if ($row = mysqli_fetch_assoc($result)) {
            $file_no = $row['file_no'];
            $ippis_no = $row['ippis_no'];
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $othername = $row['othername'];
            $gender = $row['gender'];
            $phonenumber = $row['phonenumber'];
            $email = $row['email'];
            $qualifications = $row['qualifications'];
            $dob = $row['dob'];
            $do_ap = $row['do_ap'];
            $do_pa = $row['do_pa'];
            $type_app = $row['type_app'];
            $country = $row['countryname'];
            $state = $row['statename'];
            $lga = $row['lganame'];
            $section = $row['section'];
            $department = $row['department'];
            $rank = $row['rank'];
            $salary_structure = $row['salary_structure'];
            $conditess = $row['conditess'];
            $steps = $row['steps'];
        }
    }
    ?>

    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="">The Federal Polytechnic Mubi</h2>
                <h2>Adamawa State</h2>
                <h3 class="page-header">Department of Registry (Statistics Unit)</h3>
            </div>
            <div class="col-lg-12">
                <table class="table">
                    <tr>
                        <th>File Number</th>
                        <td><?php echo 'PI/'.$file_no; ?></td>
                        <th>IPPIS Number</th>
                        <td><?php echo 'TI'.$ippis_no; ?></td>
                    </tr>
                    <tr>
                        <th>First Name</th>
                        <td><?php echo $firstname; ?></td>
                        <th>Last Name</th>
                        <td><?php echo $lastname; ?></td>
                    </tr>
                    <tr>
                        <th>Other Name</th>
                        <td><?php echo $othername; ?></td>
                        <th>Gender</th>
                        <td><?php echo $gender; ?></td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td><?php echo $phonenumber; ?></td>
                        <th>Email</th>
                        <td><?php echo $email; ?></td>
                    </tr>
                    <tr>
                        <th>Qualifications</th>
                        <td><?php echo $qualifications; ?></td>
                        <th>Date of Birth</th>
                        <td><?php echo $dob; ?></td>
                    </tr>
                    <tr>
                        <th>Date of first Appointment</th>
                        <td><?php echo $do_ap; ?></td>
                        <th>Date of last Promotion</th>
                        <td><?php echo $do_pa; ?></td>
                    </tr>
                    <tr>
                        <th>Type of Appointment</th>
                        <td><?php echo $type_app; ?></td>
                        <th>Country</th>
                        <td><?php echo $country; ?></td>
                    </tr>
                    <tr>
                        <th>State</th>
                        <td><?php echo $state; ?></td>
                        <th>LGA</th>
                        <td><?php echo $lga; ?></td>
                    </tr>
                    <tr>
                        <th>Section</th>
                        <td><?php echo $section; ?></td>
                        <th>Department</th>
                        <td><?php echo $department; ?></td>
                    </tr>
                    <tr>
                        <th>Rank</th>
                        <td><?php echo $rank; ?></td>
                        <th>Salary Structure</th>
                        <td><?php echo $salary_structure; ?></td>
                    </tr>
                    <tr>
                        <th>Conditess</th>
                        <td><?php echo $conditess; ?></td>
                        <th>Step</th>
                        <td><?php echo $steps; ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="text-center">
            <button onclick="window.print();" class="btn btn-primary">Print</button>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>

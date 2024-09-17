<?php include 'includes/header.php';?>
<?php
if (!isset($_SESSION['user_role'])) {
    header('Location: login.php');
}
?>
    <div id="wrapper">

        <!-- Navigation -->

<?php include 'includes/nav.php' ?>

<?php $heading = "EDIT STAFF INFORMATION<br>"?>
<?php include 'includes/title.php' ?>

                    <?php

if (isset($_GET['id'])) {

    $staff_id = escapeString($_GET['id']);

    $query = "SELECT `biodata_id`,`user_id`,`file_no`,`ippis_no`,`firstname`,`lastname`,`othername`,`gender`,`phonenumber`, ";
    $query .= " `email`,`qualifications`, `dob`,`do_ap`,`do_pa`,`type_app`,`country`,`countryname`,`state`,`statename`,`lga`,`lganame`, ";
    $query .= " `section`,`department`,`rank`,`salary_structure`, `conditess`,`steps` ";
    $query .= " FROM `tblbiodata` AS bdt INNER JOIN tbllga AS lg ON bdt.lga=lg.lgaid ";
    $query .= " INNER JOIN tblstate AS st ON lg.stateid=st.stateid ";
    $query .= " INNER JOIN tblcountries AS ct ON st.countryid=ct.countryid WHERE biodata_id = $staff_id";

    $select_staff = mysqli_query($conn, $query);
    if(mysqli_num_rows($select_staff) > 0){
        
        while($row = mysqli_fetch_assoc($select_staff)){
            // dd($row );
            $biodata_id = escapeString($row['biodata_id']);
            $user_id = escapeString($row['user_id']);
            $firstname = escapeString($row['firstname']);
            $lastname = escapeString($row['lastname']);
            $othername = escapeString($row['othername']);
            $gender = escapeString($row['gender']);
            $phonenumber = escapeString($row['phonenumber']);
            $email = escapeString($row['email']);
            $dob  = escapeString($row['dob']);                        
            $filenumber = escapeString($row['file_no']);
            $ippis = escapeString($row['ippis_no']);
            $doap = escapeString($row['do_ap']);
            $dopa = escapeString($row['do_pa']);
            $qualification = escapeString($row['qualifications']);
            // $img_pasport = escapeString($row['img_pasport']);
            $typeOfApp = escapeString($row['type_app']);
            $countryname = escapeString($row['countryname']);
            $country_id = escapeString($row['country']);

            $statename = escapeString($row['statename']);
            $state_id = escapeString($row['state']);

            $lganame = escapeString($row['lganame']);
            $lga_id = escapeString($row['lga']);

            $section = escapeString($row['section']);
            $department = escapeString($row['department']);
            $rank = escapeString($row['rank']);
            $salaryStructure = escapeString($row['salary_structure']);
            $conditess = escapeString($row['conditess']);
            $steps = escapeString($row['steps']);


        }

    }else{
        header("Location: view_records.php?record=empty");
    }
}



        if(isset($_POST['update'])) {

            // dd($_POST);
            $errorArr = [];

            $id = escapeString($_POST['id']);
            $user_id = escapeString($_POST['user_id']);
            $firstname = escapeString($_POST['firstname']);
            $lastname = escapeString($_POST['lastname']);
            $othername = escapeString($_POST['othername']);
            $gender = escapeString($_POST['gender']);
            $phonenumber = escapeString($_POST['phonenumber']);
            $email = escapeString($_POST['email']);
            $dob  = escapeString($_POST['dob']);                        
            $filenumber = escapeString($_POST['filenumber']);
            $ippis = escapeString($_POST['ippis']);
            $doap = escapeString($_POST['doap']);
            $dopa = escapeString($_POST['dopa']);
            $qualification = escapeString($_POST['qualification']);
            $typeOfApp = escapeString($_POST['typeOfApp']);
            $country_id = escapeString($_POST['country']);
            $state_id = escapeString($_POST['state']);
            $lga_id = escapeString($_POST['lga']);
            $section = escapeString($_POST['section']);
            $department = escapeString($_POST['department']);
            $rank = escapeString($_POST['rank']);
            $salaryStructure = escapeString($_POST['salaryStructure']);
            $conditess = escapeString($_POST['conditess']);
            $steps = escapeString($_POST['steps']);

            $image_name   = $_FILES['img']['name'];
            $image_type   = $_FILES['img']['type'];
            $image_size   = $_FILES['img']['size'];
            $img_tmp_name = $_FILES['img']["tmp_name"];

            $firstname = filterName($firstname);
            if ($firstname == false) {
                $errorArr['firstname'] = "<p class='text-danger'>please enter a valid name</p>";
            }

            $lastname = filterName($lastname);
            if ($lastname == false) {
                $errorArr['lastname'] = "<p class='text-danger'>please enter a valid name</p>";
            }

            if (!empty($othername)) {
                $othername = filterName($othername);
                if ($othername == false) {
                    $errorArr['othername'] = "<p class='text-danger'>please enter a valid name</p>";
                }
            }
            if(empty($gender)) {
            $errorArr["gender"] = "<p class='text-danger'>please select valid gender</p>";
            }

            $pattern = '/^(\+234\s?\d{8}|\d{11})$/';
            if(!$match = preg_match($pattern, $phonenumber)) {
            $errorArr['phonenumber'] = '<p class="text-danger">Please only number is allowed and should not be less or above 11 digits!</p>';

                }

                $email = filterEmail($email);
                if ($email == false) {
                    $errorArr['email'] = "<p class='text-danger'>please enter a valid email</p>";
                }

                if($dob === date('Y-m-d')){
                $errorArr['dob'] = '<p class="text-danger">enter a valid date of birth</p>';
                }

                if(empty($typeOfApp)) {
                $errorArr["typeOfApp"] = "<p class='text-danger'>please select valid type of application</p>";

                }
                if(empty($country_id)) {
                $errorArr["country"] = "<p class='text-danger'>please select your country</p>";
                }
                if(empty($state_id)) {
                $errorArr["state"] = "<p class='text-danger'>please select your state</p>";
                }
                if(empty($lga_id)) {
                $errorArr["lga"] = "<p class='text-danger'>please select your lga</p>";
                }

                if(empty($section)) {
                $errorArr["section"] = "<p class='text-danger'>please select valid section</p>";
                }
                if(empty($department)) {
                $errorArr["department"] = "<p class='text-danger'>please select valid department</p>";
                }
                if(empty($rank)) {
                $errorArr["rank"] = "<p class='text-danger'>please select valid rank</p>";
                }
                if(empty($salaryStructure)) {
                $errorArr["salaryStructure"] = "<p class='text-danger'>please select salary structure</p>";
                }
                if(empty($conditess)) {
                $errorArr["conditess"] = "<p class='text-danger'>please select conditess</p>";
                }
                if(empty($steps)) {
                $errorArr["steps"] = "<p class='text-danger'>please select step</p>";
                }

            if (empty($image_name)) {
                        $query = "SELECT * FROM `tblbiodata` WHERE biodata_id = $id";
                        $execute_query = mysqli_query($conn, $query);
                        confirmQuery($execute_query);
                        if (mysqli_num_rows($execute_query)) {
                            $row = mysqli_fetch_assoc($execute_query);
                            $image_name = $row['img_pasport'];
 
                        }
                    }

            move_uploaded_file($img_tmp_name, 'img/'.$image_name);

            if(empty($errorArr)){
                $query = "UPDATE `tblbiodata` SET `user_id` = $user_id, `file_no` = $filenumber,`ippis_no` = $ippis, `firstname` = '$firstname', `lastname` = '$lastname', ";
                $query .= " `othername` = '$othername', `gender` = '$gender', `phonenumber` = '$phonenumber', `email` = '$email', `qualifications` = '$qualification', `img_pasport` = '$image_name', `dob` = '$dob', ";
                $query .= " `do_ap` = '$doap', `do_pa` = '$dopa', `type_app` = '$typeOfApp', `country` = $country_id, `state` = $state_id, `lga` = $lga_id, `section` = '$section', `department` = '$department', `rank` = '$rank', ";
                $query .= " `salary_structure` = '$salaryStructure', `conditess` = $conditess, `steps` = $steps WHERE biodata_id =$id";
               
                $execute_query = mysqli_query($conn,$query);
                // dd($query);
                confirmQuery($execute_query);

                header('Location: view_records.php?success');
            }else {
        
                header("Location: edit_staff.php?id=$id&error=1");
            }

        }

        ?>
                    
                <!-- /.row -->
                <h4 class="text-danger"> <?= isset($errorArr['globalMessage'])? strtoupper($errorArr['globalMessage']) : '';   ?></h4> 
                <div class="row">
                    <form role="form" method="post" action="edit_staff.php" enctype="multipart/form-data">
                    <div class="col-lg-6">
                            <div class="form-group">
                                <label for="firstname">First Name <span style="color:red;">*</span></label>
                                <input type="text" name="firstname" value="<?= isset($firstname)? $firstname : ''; ?>" class="form-control" placeholder="Enter first name" required>
                                <span><?= (isset($errorArr['firstname']))? $errorArr['firstname'] : ''; ?></span>
                            </div>

                            <div class="form-group">
                                <label for="lastname">Last Name<span style="color:red;">*</span></label>
                                <input type="text" name="lastname" value="<?= isset($lastname)? $lastname : ''; ?>" class="form-control" placeholder="Enter last name" required>
                                <span><?= (isset($errorArr['lastname']))? $errorArr['lastname'] : ''; ?></span>
                            </div>

                            <div class="form-group">
                                <label for="othername">Other Name</label>
                                <input type="text" name="othername" value="<?= isset($othername)? $othername : ''; ?>" class="form-control" placeholder="Enter other name">
                                <span><?= (isset($errorArr['othername']))? $errorArr['othername'] : ''; ?></span>
                            </div>

                            <div class="form-group">
                                <label>Gender<span style="color:red;">*</span></label>
                                <select name="gender" class="form-control">
                                    <?php if(isset($gender)):?>
                                         <option value="<?=$gender;?>"><?=$gender;?></option>';
                                         <?php endif; ?>
                                    <option value="">--select--</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                <span><?= (isset($errorArr['gender']))? $errorArr['gender'] : ''; ?></span>
                            </div>

                            <div class="form-group">
                                <label for="phonenumber">Phone Number<span style="color:red;">*</span></label>
                                <input type="number" name="phonenumber" value="<?= isset($phonenumber)? $phonenumber : ''; ?>" class="form-control" placeholder="Enter phone number" required>
                                <span><?= (isset($errorArr['phonenumber']))? $errorArr['phonenumber'] : ''; ?></span>
                            </div>

                            <div class="form-group">
                                <label for="email">Email<span style="color:red;">*</span></label>
                                <input type="email" name="email" value="<?= isset($email)? $email : ''; ?>" class="form-control" placeholder="Enter email" required>
                                <span><?= (isset($errorArr['email']))? $errorArr['email'] : ''; ?></span>
                            </div>

                            <div class="form-group">
                                <label for="dob">Date of Birth<span style="color:red;">*</span></label>
                                <input type="date" name="dob" value="<?= isset($dob)? $dob : ''; ?>" class="form-control" required>
                                <span><?= (isset($errorArr['dob']))? $errorArr['dob'] : ''; ?></span>
                            </div>
                            
                            <div class="form-group">
                                <label for="img">Picture Upload<span style="color:red;">*</span></label>
                                <input type="file" name="img" value="<?= isset($img_pasport)? $img_pasport : ''; ?>" id="img" class="form-control">
                                <span><?= (isset($errorArr['img']))? $errorArr['img'] : ''; ?></span>
                            </div>

                            <div class="form-group">
                                <label>File Number<span style="color:red;">*</span></label>
                                <input type="number" name="filenumber" value="<?= isset($filenumber)? $filenumber : ''; ?>" class="form-control" placeholder="Enter file number" required>
                            </div>
                            <div class="form-group">
                                <label>IPPIS Number<span style="color:red;">*</span></label>
                                <input type="number" name="ippis" value="<?= isset($ippis)? $ippis : ''; ?>" class="form-control" placeholder="Enter IPPIS number" required>
                            </div>

                            <div class="form-group">
                                <label for="doap">Date of Application<span style="color:red;">*</span></label>
                                <input type="date" name="doap" value="<?= isset($doap)? $doap : ''; ?>" class="form-control" placeholder="Data of application" required>
                            </div>

                            <div class="form-group">
                                <label for="dopa">Date of P-A<span style="color:red;">*</span></label>
                                <input type="date" name="dopa" value="<?= isset($dopa)? $dopa : ''; ?>" class="form-control" placeholder="" required>
                            </div>
                                </div>


                                <!-- another column -->
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="qualification">Qualifications<span style="color:red;">*</span></label>
                                            <input type="text" name="qualification" value="<?= isset($qualification)? $qualification : ''; ?>" class="form-control" placeholder="FLSC, SSCE, B.SC, M.SC, Phd etc" >
                                        </div>
                                        <div class="form-group">
                                        <label for="toap">Type of Application<span style="color:red;">*</span></label>
                                        <select name="typeOfApp" class="form-control">
                                        <?php if(isset($typeOfApp)):?>
                                        <option value="<?=$typeOfApp?>"><?=$typeOfApp?></option>';
                                        <?php endif; ?>
                                            <option value="">--select--</option>
                                            <option value="PREV">Prevision (PREV)</option>
                                            <option value="PMT">Permanent (PMT)</option>
                                        </select>
                                        <span><?= (isset($errorArr['typeOfApp']))? $errorArr['typeOfApp'] : ''; ?></span>
                                    </div>
                                        <div class="form-group" >
                                            <label>Country <span style="color:red;">*</span></label>
                                            <select class="form-control" id="country" name="country">
                                            <?php if(isset($countryname)):?>
                                                <option value="<?=$country_id?>"><?=$countryname?></option>';
                                             <?php endif; ?>
                                                <option>--select--</option>
                                                    <?php
                                                    $query = "SELECT * FROM tblcountries";
                                                    $result = mysqli_query($conn, $query);
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                    echo '<option value="'.$row['countryid'].'">'.$row['countryname'].'</option>';
                                                    }
                                                    ?>
                                            </select>
                                            <span><?= (isset($errorArr['country']))? $errorArr['country'] : ''; ?></span>
                                        </div>

                                        <div class="form-group">
                                            <label>State<span style="color:red;">*</span></label>
                                            <select class="form-control" id="state" name="state">
                                            <?php if(isset($statename)):?>
                                                <option value="<?=$state_id?>"><?=$statename?></option>';
                                             <?php endif; ?>
                                                <option>--select--</option>
                                               
                                            </select>
                                            <span><?= (isset($errorArr['state']))? $errorArr['state'] : ''; ?></span>
                                        </div>

                                        <div class="form-group">
                                            <label>LGA<span style="color:red;">*</span></label>
                                            <select class="form-control" id="lga" name="lga">
                                            <?php if(isset($lganame)):?>
                                                <option value="<?=$lga_id?>"><?=$lganame?></option>';
                                             <?php endif; ?>
                                                <option>--select--</option>
                                            </select>
                                            <span><?= (isset($errorArr['lga']))? $errorArr['lga'] : ''; ?></span>
                                        </div>

                                        <div class="form-group">
                                            <label>Section<span style="color:red;">*</span></label>
                                            <select name="section" class="form-control">
                                                <?php if(isset($section)):?>
                                                <option value="<?=$section?>"><?=$section?></option>';
                                                <?php endif; ?>
                                                <option value="">--select--</option>
                                                <option value="Academic Staff">Academic Staff</option>
                                                <option value="Non-Academic Staff">Non Academic Staff</option>
                                            </select>
                                            <span><?= (isset($errorArr['section']))? $errorArr['section'] : ''; ?></span>
                                        </div>

                                        <div class="form-group">
                                            <label>Department<span style="color:red;">*</span></label>
                                            <select name="department" class="form-control">
                                            <?php if(isset($department)):?>
                                                <option value="<?=$department?>"><?=$department?></option>';
                                                <?php endif; ?>
                                                <option value="">--select--</option>
                                                <?php
                                                    $query = "SELECT * FROM tbldepartments";
                                                    $result = mysqli_query($conn, $query);
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                    echo '<option value="'.$row['depname'].'">'.$row['depname'].'</option>';
                                                    }
                                                ?>
                                            </select>
                                            <span><?= (isset($errorArr['department']))? $errorArr['department'] : ''; ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Rank<span style="color:red;">*</span></label>
                                            <select name="rank" class="form-control">
                                            <?php if(isset($rank)):?>
                                                <option value="<?=$rank?>"><?=$rank?></option>';
                                                <?php endif; ?>
                                                <option value="">--select--</option>
                                                <?php
                                                    $query = "SELECT * FROM tblrank";
                                                    $result = mysqli_query($conn, $query);
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                    echo '<option value="'.$row['rankname'].'">'.$row['rankname'].'</option>';
                                                    }
                                                ?>
                                            </select>
                                            <span><?= (isset($errorArr['rank']))? $errorArr['rank'] : ''; ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Salary Structure<span style="color:red;">*</span></label>
                                            <select name="salaryStructure" class="form-control">
                                                <?php if(isset($salaryStructure)):?>
                                                <option value="<?=$salaryStructure?>"><?=$salaryStructure?></option>';
                                                <?php endif; ?>
                                                <option value="">--select--</option>
                                                <option value="cotediss">Contediss</option>
                                                <option value="compcass">Compcass</option>
                                                <option value="conhess">Conhess</option>
                                            </select>
                                            <span><?= (isset($errorArr['salaryStructure']))? $errorArr['salaryStructure'] : ''; ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Conditess<span style="color:red;">*</span></label>
                                            <select name="conditess" class="form-control">
                                                <?php if(isset($conditess)):?>
                                                <option value="<?=$conditess?>"><?=$conditess?></option>';
                                                <?php endif; ?>
                                                <option value="">--select--</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                            </select>
                                            <span><?= (isset($errorArr['conditess']))? $errorArr['conditess'] : ''; ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Steps<span style="color:red;">*</span></label>
                                            <select name="steps" class="form-control">
                                                <?php if(isset($steps)):?>
                                                <option value="<?=$steps?>"><?=$steps?></option>';
                                                <?php endif; ?>
                                                <option value="">--select--</option>
                                                <option  value="1">1</option>
                                                <option  value="2">2</option>
                                                <option  value="3">3</option>
                                                <option  value="4">4</option>
                                                <option  value="5">5</option>
                                                <option  value="6">6</option>
                                                <option  value="7">7</option>
                                                <option  value="8">8</option>
                                                <option  value="9">9</option>
                                                <option  value="10">10</option>
                                                <option  value="11">11</option>
                                                <option  value="12">12</option>
                                                <option  value="13">13</option>
                                                <option  value="14">14</option>
                                                <option  value="15">15</option>
                                            </select>
                                            <span><?= (isset($errorArr['steps']))? $errorArr['steps'] : ''; ?></span>
                                            <input type="hidden" name="id" value="<?= $staff_id; ?>">
                                            <input type="hidden" name="user_id" value="<?= $user_id; ?>">
                                        </div>
                                        <!-- <div class="form-group"> -->
                                            <input type="submit" name="update" value="UPDATE" class="btn btn-default btn-custom btnlg btn-block btn-primary"></input>
                                        <!-- </div> -->
                        </div>
                    </form>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->


    <script>
    $(document).ready(function() {
        $('#country').on('change', function() {
            var countryID = $(this).val();
            if(countryID) {
                $.ajax({
                    type: 'POST',
                    url: 'includes/ajaxData.php',
                    data: 'country_id=' + countryID,
                    success: function(html) {
                        $('#state').html(html);
                        $('#lga').html('<option value="">Select State First</option>'); 
                    }
                }); 
            } else {
                $('#state').html('<option value="">Select Country First</option>');
                $('#lga').html('<option value="">Select State First</option>'); 
            }
        });
        
        $('#state').on('change', function() {
            var stateID = $(this).val();
            if(stateID) {
                $.ajax({
                    type: 'POST',
                    url: 'includes/ajaxData.php',
                    data: 'state_id=' + stateID,
                    success: function(html) {
                        $('#lga').html(html);
                    }
                }); 
            } else {
                $('#lga').html('<option value="">Select State First</option>'); 
            }
        });
    });
    </script>
    <?php include 'includes/footer.php' ?>

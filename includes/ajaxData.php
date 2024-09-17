<?php
include 'db.php';

if(isset($_POST['country_id'])) {
    $country_id = $_POST['country_id'];
    $query = "SELECT * FROM tblstate WHERE countryid = $country_id";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0) {
        echo '<option value="">Select State</option>';
        while($row = mysqli_fetch_assoc($result)) {
            echo '<option value="'.$row['stateid'].'">'.$row['statename'].'</option>';
        }
    } else {
        echo '<option value="">No States Available</option>';
    }
}

if(isset($_POST['state_id'])) {
    $state_id = $_POST['state_id'];
    $query = "SELECT * FROM tbllga WHERE stateid = $state_id";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0) {
        echo '<option value="">Select LGA</option>';
        while($row = mysqli_fetch_assoc($result)) {
            echo '<option value="'.$row['lgaid'].'">'.$row['lganame'].'</option>';
        }
    } else {
        echo '<option value="">No LGAs Available</option>';
    }
}
?>

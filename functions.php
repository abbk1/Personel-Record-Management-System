<?php
function confirmQuery($query) {
    global $conn;
    if(!$query){
        die("QUERY FAILD".mysqli_error($conn));
    }

}
// Functions to filter user inputs
function filterName($field){
    // Sanitize user name
    $field = filter_var(trim($field), FILTER_SANITIZE_STRING);
    
    // Validate user name
    if(filter_var($field, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        return $field;
    } else{
        return FALSE;
    }
}  


//function to filter email
function filterEmail($field){
    // Sanitize e-mail address
    $field = filter_var(trim($field), FILTER_SANITIZE_EMAIL);
    
    // Validate e-mail address
    if(filter_var($field, FILTER_VALIDATE_EMAIL)){
        return $field;
    } else{
        return FALSE;
    }
}

// validate input password
function validatePassword($field){

    $pattern = '/^[a-zA-Z0-9]+$/';
    if(preg_match($pattern, $field)){
        return $field;
    }else{
        return FALSE;
    }
}

function escapeString($string){
    global $conn;
    return mysqli_escape_string($conn, trim($string));

}

function dd($arr){
    echo '<pre>';
    var_dump($arr);
    echo '</pre>';
    die;
}

function emaiExists($email){
    global $conn;
    $execute = mysqli_query($conn, "SELECT * FROM `tblbiodata` WHERE  email = '$email'");
    if(mysqli_num_rows($execute) === 0) {
        return true;
    }else{
        return false;
    }
   }
function fileNumberExists($fileNumber){
    global $conn;
    $execute = mysqli_query($conn, "SELECT * FROM `tblbiodata` WHERE  file_no = '$fileNumber'");
    if(mysqli_num_rows($execute) === 0) {
        return true;
    }else{
        return false;
    }
   }
function ippisNumberExists($ippis){
    global $conn;
    $execute = mysqli_query($conn, "SELECT * FROM `tblbiodata` WHERE  ippis_no = '$ippis'");
    if(mysqli_num_rows($execute) === 0) {
        return true;
    }else{
        return false;
    }
   }



   
function is_logged_in(){
    if (isset($_SESSION['user_role']) && isset($_SESSION['email'])) {
      return true;
    }else{
        return false;
    }
}

function checkIfUserLogin (){
if (isset($_SESSION['user_role'])){
    return true;
}else {
    return false;
}
}

function isUsreSignIn(){
    
    if (!isset($_SESSION['user_role'])) {

        header('Location: login.php');
      }
}

function authorizedUser($userId){
    return $_SESSION['user_id'] === $userId;
}
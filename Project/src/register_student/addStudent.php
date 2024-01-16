<?php
include_once("../sys/initSession.php");
$msgerr = "";

if (isset($_POST['add']))
{
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $checkF = is_string($fname) && !empty($fname);
    $checkL = is_string($lname) && !empty($lname);

    if ($checkF && $checkL)
    {
        $student = $Handler->newStudent($fname, $lname);
    } else if (!$checkF && !$checkL){
        $msgerr = "You have to enter first and last names.";
    }
    else if (!$checkF){
        $msgerr = "You have to enter a valid first name (string lateral)";
    } else if (!$checkL){
        $msgerr = "You have to enter a valid last name (string lateral)";
    } else {
        $msgerr = "unexpected error. Please try again."; // should never occur.
    }
}
if (isset($_POST['back'])) {
    header("location:../../index.php");
}
if (isset($_POST['reset'])) {
    $msgerr = "form reset";
}
include_once("formStudent.php");
?>
<?php
include_once("../sys/initSession.php");

$msgerr = "";

if (isset($_POST['add']))
{
    $name = $_POST['IName'];
    $duration = $_POST['IDuration'];
    $company = $_POST['ICompany'];
    $max_numbers = $_POST['IMaxInterns'];

    $checkN = is_string($name) && !empty($name);
    $checkD = is_string($duration) && !empty($duration);
    $checkC = is_string($company) && !empty($company);
    $checkM = is_numeric($max_numbers) && !empty($max_numbers);

    if ($checkN && $checkD && $checkC && $checkM)
    {
        $internship = $Handler->newInternship($name, $duration, $company, $max_numbers);
    } else if ($checkN && $checkD && $checkC) 
    {
        $internship = $Handler->newInternship($name, $duration, $company, 1);
    }
    else if (!$checkN){
        $msgerr = "You have to enter a valid Internship name";
    }
    else if ($checkD){
        $msgerr = "You have to enter a valid duration";
    }
    else if ($checkC){
        $msgerr = "You have to enter a valid company name";
    } else {
        $msgerr = "An unexpected error occured. Please try again."; //should never happen
    }
}
if (isset($_POST['back'])) {
    header("location:../../index.php");
}
if (isset($_POST["reset"])) {
    $msgerr = "form reset";
}
include_once("formInternship.php");    
?>
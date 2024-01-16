<?php
include_once("../sys/initSession.php");
if (!isset($_SESSION['Assigner'])){
    $_SESSION['Assigner'] = array(
        "okPressed" => false,
        "internship" => null,
        "msg" => ""
    );
    $okPressed = false;
    // $selectedInternship = null;
    // $msg = "";
} else {
    $okPressed = $_SESSION['Assigner']['okPressed'];
    $selectedInternship = $_SESSION['Assigner']['internship'];
    $msg = $_SESSION['Assigner']['msg'];
}
function reset_page(){
    $_SESSION['Assigner'] = array (
        "okPressed" => false,
        "internship" => null,
        "msg" => ""
    );
    global $okPressed;
    $okPressed = false;
}

if (isset($_POST['ok'])){
    // var_dump($_POST['ISelector']);
    if (isset($_POST['ISelector']) && ($_POST['ISelector'] != "----")){
        $selectedInternship = $_POST['ISelector'];
        $selectedInternship = $Handler->listInternships[$selectedInternship];
        //load the data for later
        $_SESSION["Assigner"]["internship"] = $selectedInternship;
        $_SESSION["Assigner"]["okPressed"] = true;

        // set the vars for now
        $okPressed = true;
        // $msg = "$selectedInternship selected";
        } else {
            reset_page();
        }
}
if (isset($_POST['back'])){
    reset_page();
    header("Location:../../index.php");
}
if (isset($_POST['reset'])){
    reset_page();
}
if (isset($_POST['check'])){
    
    if (isset($_POST['checkbox'])){
        $checkedArr = $_POST['checkbox'];
        $count = count($checkedArr);
        // var_dump($checkedArr);

        $check = ($selectedInternship->hasSlots() >= $count);

        if ($check){
            foreach($checkedArr as $v){
                $intern = $Handler->listStudents[$v];
                $checkI = $Handler->addIntern($selectedInternship, $intern);
            }
            if ($selectedInternship->hasSlots() == 0 || empty($Handler->listNotInterns)){
                reset_page();   
            }
        } else {
            $msg = "Selected more than".$selectedInternship->hasSlots().". Retry!.";
        }
    } else {
        $msg = "There are none checked. Try again!";
    }
}
?>
<!DOCTYPE html>
<html>
<body>
    <h1>Assign Students to an Internship</h1>
    <form action="assignStudents.php" method="post">
        <p>
            <label><b>Select Internship:</b></label>
            <select name="ISelector"<?php if($okPressed) echo 'disabled';?>>
                <?php if($okPressed) echo "<option>$selectedInternship->IID</option>" ?>
                <option>----</option>
                <?php
                if (!empty($Handler->listInternships)){
                    foreach ($Handler->listInternships as $key => $ship){
                        if ($ship->hasSlots() > 0){
                            $n = $ship->IID;
                            echo "<option value=\"$n\">$n</option>";
                        }
                    }
                } else {
                    $msg = "No internships registered";
                }
                ?>
            </select>
            <input type="submit" name="ok" value="Ok"<?php if($okPressed) echo 'disabled';?>>
            <input type="submit" name="reset" value="Reset">
            <input type="submit" name="back" value="Back">

        </p>
        <?php
            if ($okPressed){
                echo "<h2>Choose Students</h2>";
                if ($selectedInternship != null){ //safety check
                    if (!empty($Handler->listNotInterns)){
                        foreach ($Handler->listNotInterns as $student){
                            echo "<input type=\"checkbox\" name=\"checkbox[]\" value=\"$student->SID\"><label>$student->SID</label><br />";
                        }
                        echo '<input type="submit" name="check" value="Ok">';
                    } else {
                        $msg = "There are no Students not assigned to internships left.";
                    }
                }
            }
            if (!isset($msg)){
                $msg = " ";
            }
            echo $msg;
        ?>
    </form>
</body>
</html>
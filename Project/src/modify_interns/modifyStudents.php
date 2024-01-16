<?php
include_once("../sys/initSession.php");
if (!isset($_SESSION['Modifier'])){
    $_SESSION['Modifier'] = array(
        "okPressed" => false,
        "internship" => null,
        "msg" => "",
        "intern" => null
    );
    $okPressed = false;
} else {
    $okPressed = $_SESSION['Modifier']['okPressed'];
    $selectedInternship = $_SESSION['Modifier']['internship'];
    $msg = $_SESSION['Modifier']['msg'];
}
function reset_page(){
    $_SESSION['Modifier'] = array (
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
        $_SESSION["Modifier"]["internship"] = $selectedInternship;
        $_SESSION["Modifier"]["okPressed"] = true;

        // set the vars for now
        $okPressed = true;
        // $msg = "$selectedInternship selected";
        } else {
            reset_page();
        }
}
if (isset($_POST['reset'])) {
    reset_page();
}
if (isset($_POST['back'])) {
    reset_page();
    header("location:../../index.php");
}
if (isset($_POST['remove'])){
    $intern = $_POST['remove'];
    $internName = $intern;
    $intern = $Handler->listInterns[$internName];

    $checkR = $Handler->removeIntern($selectedInternship, $intern);

    if (empty($selectedInternship->interns)){
        reset_page();
    } else {
        $okPressed = true;       
    }
}
if (isset($_POST['replace'])){
    // var_dump($Handler->listInterns[$_POST['replace']]);
    $_SESSION['Modifier']['intern'] = $Handler->listInterns[$_POST['replace']];
    header("location:switchStudent.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<body>
    <h1>Modify Internship Interns</h1>
    <form action="modifyStudents.php" method="post"> <!-- Difference -->
        <p>
            <label><b>Select Internship:</b></label>
            <select name="ISelector"<?php if($okPressed) echo 'disabled';?>>
                <?php if($okPressed) echo '<option>'.$selectedInternship->IID."</option>" ?>
                <option>----</option>
                <?php
                if (!empty($Handler->listInternships)){
                    foreach ($Handler->listInternships as $key => $ship){
                        if ($ship->hasInterns()){
                            $n = $ship->IID;
                            echo "<option value=\"$n\">$n</option>";
                        }
                    }
                } else {
                    $msg = "No internships registered";
                }
                ?>
            </select>
            <input type="submit" name="ok" value="Ok" <?php if($okPressed) echo 'disabled'; ?>>
            <input type="submit" name="reset" value="Reset">
            <input type="submit" name="back" value="Back">
        </p>
        <?php
        if ($okPressed){
            echo "<h2>Current Interns</h2>";
            if (!empty($selectedInternship->interns)){
                $iInterns = $selectedInternship->interns;
                echo "<table border=1px>";
                foreach ($iInterns as $i => $value){
                    echo "<tr><td>$value->SID</td>";
                    echo '<td><button type="submit" name="remove" value="'.$value->SID.'">Remove</button></td>';
                    echo '<td><button type="submit" name="replace" value="'.$value->SID.'">Replace</button></td>';
                    echo '</tr>';
                }
                echo '</table>';
                // var_dump($selectedInternship);
            } else {
                $msg = "There are no Interns in this internship";
                // Will never trigger because we are only allowing selection of Internships with interns.
                // on line 52
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
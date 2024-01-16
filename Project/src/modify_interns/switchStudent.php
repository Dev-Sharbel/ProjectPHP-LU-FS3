<?php
include_once("../sys/initSession.php");
$internship = $_SESSION['Modifier']['internship'];
$intern = $_SESSION['Modifier']['intern'];
// $_SESSION['Modifier']['success'] = false;
// $success = $_SESSION['Modifier']['success'];
// $notInterns = $managerClass->getInternsByStatus(1);

if (isset($_POST['ok'])){
    if (!empty($_POST['selection'])){
        $v = $_POST['selection'];
        
        $internOld = $intern;
        $internNew = $Handler->listStudents[$v];
        
        $check = $Handler->replaceIntern($internship, $internOld, $internNew);

        // Load data before going back
        $_SESSION['Modifier']['intern'] = $internNew;
        $_SESSION['Modifier']['internship'] = null;
        $_SESSION['Modifier']['okPressed'] = false;
        
        // // Redirect back
        header("Location: ./modifyStudents.php");
        exit;
    }
}
if (isset($_POST['ok2'])){
	$_SESSION['Modifier']['intern'] = $intern;
	$_SESSION['Modifier']['internship'] = null;
	$_SESSION['Modifier']['okPressed'] = false;

	header("Location: ./modifyStudents.php");
	exit;
}
?>
<!DOCTYPE html>
<html>
<body>
    <h1>Replace an Internship Intern</h1>
    <div>
        <label">Internship</label>
        <input type="text" value=<?php echo $internship->IID;?> disabled>
        <label">Intern</label>
        <?php echo '<input type="text" value="'.$intern->SID.'" disabled>';?>
    </div>
    <form action="switchStudent.php" method="post">
        <?php
            $checkOnce = true;
            if (!empty($Handler->listNotInterns)){
                foreach($Handler->listNotInterns as $student){
                    $v = $student->SID;
                    echo '<label><input type="radio" name="selection" value="'.$v.'" '.($checkOnce ? "checked": "").'>';
                    echo $v.'</input></label><br />';
                    $checkOnce = false;
                }
        	echo '<input type="submit" name="ok" value="Ok">';
	    } else {
		    echo "<p>There are no students to replace with- Ok to go back<p>";
		    echo "<input type=\"submit\" name=\"ok2\" value=\"Ok\">";
	    }
        ?>
    </form>
</body>
</html>

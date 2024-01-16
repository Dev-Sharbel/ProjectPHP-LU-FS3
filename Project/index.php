<?php
include_once("src/sys/initSession.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Students & Internships Project</title>
  </head>
  <body>
    <header>
      <h1>Menu - Students & Internships</h1>
    </header>
    <main style="font-size: large;">
    <hr />
      <a href="src/register_student/addStudent.php">Register Student</a>
      <br />
      <br />
      <a href="src/register_internship/addInternship.php">Register Internship</a>
      <br />
      <hr />
      <a href="src/assign_interns/assignStudents.php">Assign Students to an Internship</a>
      <br />
      <br />
      <a href="src/modify_interns/modifyStudents.php">Modify Students of an Internship</a>
      <br />
      <hr />
      <a href="src/display_interns/display.php">Display Intern Students</a>
      <br />
    </main>
    <footer>
      <hr />
      @Author - Charbel Chaak
      @FileNumber - 29491
      @Contact - +961-81-268-401
      @Mail - charbelchaak@gmail.com
      @Note - Prefer WhatsApp over mail
      <div>
        <hr />
        Admin Panel
        <br />
        <form action="index.php" method="post">
          <input type="submit" value="Delete_Session" name="delSession">
          <input type="submit" value="Fill_Data" name="fillSession">
        </form>
        <?php
          $var = "";
          if (session_status() === PHP_SESSION_ACTIVE){
            $var = "active";
          }
          if (isset($_POST['delSession'])){
              session_unset();
              session_destroy();
              $var = "new session";
          }
          if (isset($_POST['fillSession'])){
            include_once("src/sys/makeFillerData.php");
          }
          echo "<i>session - ".$var."</i>";
        ?>
      </div>
    </footer>
  </body>
</html>

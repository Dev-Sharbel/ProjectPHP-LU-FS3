<!DOCTYPE html>
<html>
<body>
    <h1>Register a Student</h1>
    <?php echo $msgerr."<br>";?>
    <form action="addStudent.php" method="post">
        <p>
            <label>First Name:</label>
            <input type="text" name="fname">
        </p>
        <p>
            <label>Last Name:</label>
            <input type="text" name="lname">
        </p>
        <p>
            <input type="submit" name="add" value="Add">
            &nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="reset" value="Discard">
            &nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="back" value="Menu">
        </p>
    </form>
</body>
</html>
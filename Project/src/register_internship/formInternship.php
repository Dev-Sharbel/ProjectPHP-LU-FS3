<!DOCTYPE html>
<html>
<body>
    <h1>Register an Internship</h1>
    <?php echo $msgerr."<br>"; ?>
    <form action="addInternship.php" method="post">
        <p>
            <label>Internship Name:</label>
            <input type="text" name="IName">
        </p>
        <p>
            <label>Internship Duration:</label>
            <input type="text" name="IDuration">
        </p>
        <p>
            <label>Internship Company:</label>
            <input type="text" name="ICompany">
        </p>
        <p>
            <label>Numbers of Interns:</label>
            <input type="number" name="IMaxInterns" value="1">
        </p>
        <p>
            <input type="submit" name="add" value="Add">
            &nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" value="Discard">
            &nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="back" value="Back">

        </p>
    </form>
</body>
</html>
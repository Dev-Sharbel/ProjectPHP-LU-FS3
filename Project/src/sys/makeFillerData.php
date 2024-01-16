<?php
$firstNames = ['John', 'Jane', 'Bob', 'Alice', 'Charlie', 'Sarah', 'Mike', 'Kate', 'Chris', 'Jennifer'];
$lastNames = ['Smith', 'Johnson', 'Williams', 'Jones', 'Brown', 'Davis', 'Miller', 'Wilson', 'Moore', 'Taylor'];


// Internships
$I1 = $Handler->newInternship("Internship-001","1y","Company-A", 2);
$I2 = $Handler->newInternship("Internship-002","2y","Company-B", 2); 
$I3 = $Handler->newInternship("Internship-003","5mo","Company-C", 1);
$I4 = $Handler->newInternship("Internship-004","45d","Company-A", 1);
$I5 = $Handler->newInternship("Internship-005","6mo","Company-X", 1);
$I6 = $Handler->newInternship("Internship-006","1mo","Company-Z", 1);
$I7 = $Handler->newInternship("Internship-007","2mo","Company-Y", 1);
$I8 = $Handler->newInternship("Internship-008","8mo","Company-P", 2);

$Is = [$I1, $I2, $I3, $I4, $I5, $I6, $I7, $I8];

foreach ($Is as $internship){
    $Handler->listInternships[$internship->IID] = $internship;
}



$j = $k = 0;
for ($i = 0; $i < 10; $i++) {
    $randomLastNameIndex = rand(0, count($lastNames) - 1);
    $randomLastName = $lastNames[$randomLastNameIndex];
    $index = $firstNames[$i]." ".$randomLastName;

    // Create student
    $student = $Handler->newStudent($firstNames[$i], $randomLastName);

    // Make 7 students as Interns
    if ($i < 2){
        $j = 0;
        $Handler->addIntern($Is[$j], $student);
    } else if ($i > 1 && $i < 4) {
        $j = 1;
        $Handler->addIntern($Is[$j], $student);
    } else if ($i < 7){
        $j++;
        $Handler->addIntern($Is[$j], $student);
    }
}
$Handler->updateStudentLists();
?>
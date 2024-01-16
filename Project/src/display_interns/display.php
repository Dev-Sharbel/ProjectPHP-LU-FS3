<?php
include_once("../sys/initSession.php");
$title = "<h1>All Current Interns</h1>";
$tableStart = ["Student", "Internship", "Company", "Duration"];

$ships = $Handler->listInternships;
$interns = $Handler->listInterns;
// $interns = $managerClass->listIntern;


// Title
initDisplay([$title, $tableStart, $interns]);

function initDisplay($data){
    printTitle($data[0]);
    startTable($data[1]);
    printTable($data[2]);
}

function printTitle($title){
    echo $title;
}

function startTable($tableStart){
    echo "<table border=1>";
    echo "<tr>";
    foreach ($tableStart as $data){
        echo "<td>".$data."</td>";
    }
    echo "</tr>";
}

function printTable($interns){
    // var_dump(count ($interns));
    if ($interns != null){
        foreach ($interns as $intern){
            $internship = $intern->internship;
            echo "<tr>";
            echo "<td>".$intern->SID."</td>";
            echo "<td>".$internship->IID."</td>";
            echo "<td>".$internship->company."</td>";
            echo "<td>".$internship->duration."</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
}


echo "<br />
    <div style=\"background-color:rgba(0%,0%,80%,20%);display:inline-block;\">
    <a href='../../index.php' style=\"border: 2px solid black;\">--Back--
    </a>
    </div>";


// echo "<pre>";
// var_dump($interns);
// echo "</pre>";  
?>
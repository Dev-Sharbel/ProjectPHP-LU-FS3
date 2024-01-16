<?php
/**
 * dump and dies
 */
function dd(...$args) {
    echo "<pre style='font-family: monospace'>";
    var_dump(...$args);
    echo "</pre>";
    die();
}

class Student {
    public $firstName;
    public $lastName;
    public $SID;

    public function __construct($firstName, $lastName) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->SID = "$firstName $lastName";
    }
}

class Intern extends Student {
    public $isIntern = false;
    public $internship;

    public function isIntern(): bool {
        if (isset($this->internship) && $this->internship instanceof Internship) {
            $this->isIntern = true;
        } else {
            $this->isIntern = false;
        }
        return ($this->isIntern);
    }

    public function addInternship($internship): bool {
        if ($internship instanceof Internship){
            $this->internship = $internship;
            return $this->isIntern();
        }
        return false;
    }
    public function removeInternship(): bool {
        if (isset($this->internship)){
            unset($this->internship);
            return true;
        }
        return false;
    }
}

class Internship {
    public $name;
    public $duration;
    public $company;
    public $maxInterns;
    public $countInterns;
    public $interns;
    public $IID;

    public function __construct($name,$duration,$company,$maxInterns) {
        $this->name = $name;
        $this->duration = $duration;
        $this->company = $company;
        $this->maxInterns = $maxInterns;
        $this->countInterns = 0;
        $this->interns = array();
        $this->IID = "$name";
    }
    private function countInterns() : int {
        return count($this->interns);
    }
    public function hasInterns(): bool {
        return ($this->countInterns > 0);
    }
    public function hasSlots(): int {
        return ($this->maxInterns - $this->countInterns());
    }

    public function addIntern($intern) : bool {
        if ($intern instanceof Intern && $this->hasSlots() > 0) {
            $this->interns[$intern->SID] = $intern;
            $this->countInterns = $this->countInterns();

            //correspondence
            // $intern->internship = $this;
            // $intern->isIntern = true;
            //success
            return $this->hasInterns();
        }
        //fail
        return false;
    }
    public function removeIntern($intern) : bool {
        if ($intern instanceof Intern) {
            if (isset($this->interns[$intern->SID])) {
                unset($this->interns[$intern->SID]);
                $this->countInterns = $this->countInterns();

                return true;
            }
            // fail if couldn't remove or intern isnt part of this internship
        }
        return false;
    }
}

class Handler {
    private $INTERNAL_handlerID;
    private static $INTERNAL_counter = 0;
    public $listInternships;
    public $listStudents;
    public $listInterns;
    public $listNotInterns;

    public function __construct(){
        $this->listInternships = array();
        $this->listStudents = array();
        $this->listInterns = array();
        $this->listNotInterns = array();
        
        //hayda zedto bss hek, useless.
        Handler::$INTERNAL_counter++;
        $this->INTERNAL_handlerID = Handler::$INTERNAL_counter;

    }
    public function newStudent($fname, $lname): Intern {
        $student = new Intern($fname, $lname);
        $check = $this->addStudent($student);
        return $student;
    }
    public function newInternship($name,$duration,$company,$max): Internship {
        $internship = new Internship($name, $duration, $company, $max);
        $check = $this->addInternship($internship);
        return $internship;
    }
    private function deleteStudent($intern): bool{
        return true;
    }
    private function deleteInternship($internship): bool{
        return true;
    }

    public function addStudent($student) : bool {
        if ($student instanceof Intern) {
            if (!isset($this->listStudents[$student->SID])) {
                $this->listStudents[$student->SID] = $student;
                $this->updateStudentLists();
                return true;
            }
        }
        return false;
    }
    public function addInternship($internship): bool {
        if ($internship instanceof Internship) {
            if (!isset($this->listInternships[$internship->IID])) {
                $this->listInternships[$internship->IID] = $internship;
                return true;
            }
        }
        return false;
    }
    public function addIntern($internship,$intern) : bool {
        if ($intern instanceof Intern && $internship instanceof Internship) {
            $checkInternship = $internship->addIntern($intern);
            $checkIntern = $intern->addInternship($internship);
            if ($checkInternship && $checkIntern){
                //add to list of interns
                $this->listInterns[$intern->SID] = $intern;
                //remove from list of non interns
                if (isset($this->listNotInterns[$intern->SID])) {
                    unset($this->listNotInterns[$intern->SID]);
                }
                return true;
            }
        }
        return false;
    }
    public function removeIntern($internship,$intern): bool {
        if ($intern instanceof Intern && $internship instanceof Internship){
            $checkInternship = $internship->removeIntern($intern);
            $checkIntern = $intern->removeInternship();
            if ($checkIntern && $checkInternship){
                // remove from list of interns
                if (isset($this->listInterns[$intern->SID])) {
                    unset($this->listInterns[$intern->SID]);
                }
                // add to list of non interns
                $this->listNotInterns[$intern->SID] = $intern;
                return true;
            }
        }
        return false;
    }
    public function replaceIntern($internship,$oldIntern,$newIntern): bool {
        if ($internship instanceof Internship && $oldIntern instanceof Intern && $newIntern instanceof Intern){
            $checkInternOld = $this->removeIntern($internship,$oldIntern);
            $checkInternNew = $this->addIntern($internship,$newIntern);
            return ($checkInternOld && $checkInternNew);
        }
        return false;
    }
    public function updateStudentLists() {
        foreach ($this->listStudents as $value){
            if ($value->isIntern()){
                $this->listInterns[$value->SID] = $value;
            } else {
                $this->listNotInterns[$value->SID] = $value;
            }
        }
    }
}

?>
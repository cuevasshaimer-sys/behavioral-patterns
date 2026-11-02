<?php

interface State {
    public function enroll(Student $student): void;
    public function drop(Student $student): void;
    public function graduate(Student $student): void;
    public function getName(): string;
}

class ApplicantState implements State {
    public function enroll(Student $student): void {
        echo "Student must complete pre-assessment first.<br>";
    }

    public function drop(Student $student): void {
        echo "Applicant cannot drop because not yet enrolled.<br>";
    }

    public function graduate(Student $student): void {
        echo "Applicant cannot graduate yet.<br>";
    }

    public function getName(): string {
        return "Applicant";
    }
}

class PreAssessedState implements State {
    public function enroll(Student $student): void {
        echo "Student successfully enrolled.<br>";
        $student->setState(new EnrolledState());
    }

    public function drop(Student $student): void {
        echo "Student is not yet enrolled.<br>";
    }

    public function graduate(Student $student): void {
        echo "Student cannot graduate yet.<br>";
    }

    public function getName(): string {
        return "Pre-Assessed";
    }
}

class EnrolledState implements State {
    public function enroll(Student $student): void {
        echo "Student is already enrolled.<br>";
    }

    public function drop(Student $student): void {
        echo "Student successfully dropped.<br>";
        $student->setState(new DroppedState());
    }

    public function graduate(Student $student): void {
        echo "Student successfully graduated.<br>";
        $student->setState(new GraduatedState());
    }

    public function getName(): string {
        return "Enrolled";
    }
}

class DroppedState implements State {
    public function enroll(Student $student): void {
        echo "Student successfully re-enrolled.<br>";
        $student->setState(new EnrolledState());
    }

    public function drop(Student $student): void {
        echo "Student is already dropped.<br>";
    }

    public function graduate(Student $student): void {
        echo "Dropped student cannot graduate.<br>";
    }

    public function getName(): string {
        return "Dropped";
    }
}

class GraduatedState implements State {
    public function enroll(Student $student): void {
        echo "Graduated student cannot enroll again.<br>";
    }

    public function drop(Student $student): void {
        echo "Graduated student cannot drop.<br>";
    }

    public function graduate(Student $student): void {
        echo "Student is already graduated.<br>";
    }

    public function getName(): string {
        return "Graduated";
    }
}

class Student {
    private State $state;

    public function __construct(State $state) {
        $this->state = $state;
    }

    public function setState(State $state): void {
        $this->state = $state;
    }

    public function getState(): string {
        return $this->state->getName();
    }

    public function enroll(): void {
        $this->state->enroll($this);
    }

    public function drop(): void {
        $this->state->drop($this);
    }

    public function graduate(): void {
        $this->state->graduate($this);
    }

    public function completePreAssessment(): void {
        if ($this->state instanceof ApplicantState) {
            echo "Pre-assessment completed.<br>";
            $this->setState(new PreAssessedState());
        }
    }
}

// Demonstration
$student = new Student(new ApplicantState());

echo "<h2>State - Student Enrollment Status</h2>";

echo "Current Status: " . $student->getState() . "<br>";
echo "Attempting to enroll:<br>";
$student->enroll();

echo "<br>Completing pre-assessment:<br>";
$student->completePreAssessment();

echo "<br>Current Status: " . $student->getState() . "<br>";
echo "Attempting to enroll again:<br>";
$student->enroll();

echo "<br>Current Status: " . $student->getState();
?>
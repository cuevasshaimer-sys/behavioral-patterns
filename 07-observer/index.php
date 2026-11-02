<?php


interface Observer {
    public function update(float $grade): void;
}


class GradeSystem {

    
    private array $observers = [];

        public function attach(Observer $observer): void {
        $this->observers[] = $observer;
    }

    
    public function updateGrade(float $grade): void {
        
        echo "Grade updated: " . number_format($grade, 2) . "<br>";

        foreach ($this->observers as $observer) {
            $observer->update($grade);
        }
    }
}

class StudentPortal implements Observer {

        public function update(float $grade): void {
        echo "Student Portal: New grade posted (" .
             number_format($grade, 2) . ").<br>";
    }
}

class EmailNotification implements Observer {

    public function update(float $grade): void {
        echo "Email Notification: Your grade has been updated to " .
             number_format($grade, 2) . ".<br>";
    }
}

class ParentNotification implements Observer {

    public function update(float $grade): void {
        echo "Parent Notification: Student grade has been posted (" .
             number_format($grade, 2) . ").<br>";
    }
}

$gradeSystem = new GradeSystem();

$gradeSystem->attach(new StudentPortal());
$gradeSystem->attach(new EmailNotification());
$gradeSystem->attach(new ParentNotification());

echo "<h2>Observer Pattern - Grade Notification System</h2>";
$gradeSystem->updateGrade(1.75);

?>
<?php

abstract class Report {

    // Template Method
    public function generateReport(): void {
        $this->generateHeader();
        $this->retrieveData();
        $this->formatData();
        $this->generateFooter();
    }

    protected function generateHeader(): void {
        echo "<h3>" . $this->getReportTitle() . "</h3>";
        echo "================================<br>";
    }

    abstract protected function getReportTitle(): string;
    abstract protected function retrieveData(): void;
    abstract protected function formatData(): void;

    protected function generateFooter(): void {
        echo "<br>================================<br>";
        echo "END OF REPORT<br>";
    }
}

class StudentReport extends Report {

    protected function getReportTitle(): string {
        return "Student Report";
    }

    protected function retrieveData(): void {
        echo "<strong>Student Information:</strong><br>";
        echo "Student ID: 2026-001<br>";
        echo "Name: Juan Dela Cruz<br>";
        echo "Program: BSIT<br>";
    }

    protected function formatData(): void {
        echo "Format: Student Information Report<br>";
    }
}

class GradeReport extends Report {

    protected function getReportTitle(): string {
        return "Grade Report";
    }

    protected function retrieveData(): void {
        echo "<strong>Grade Information:</strong><br>";
        echo "Student ID: 2026-001<br>";
        echo "Subject: Integrative Programming 2<br>";
        echo "Grade: 1.75<br>";
    }

    protected function formatData(): void {
        echo "Format: Grade Report<br>";
    }
}

class EnrollmentReport extends Report {

    protected function getReportTitle(): string {
        return "Enrollment Report";
    }

    protected function retrieveData(): void {
        echo "<strong>Enrollment Information:</strong><br>";
        echo "Student ID: 2026-001<br>";
        echo "Program: BSIT<br>";
        echo "Status: Enrolled<br>";
    }

    protected function formatData(): void {
        echo "Format: Enrollment Report<br>";
    }
}

// Demonstration
echo "<h2>Template Method - Student Report Generation</h2>";

$studentReport = new StudentReport();
$studentReport->generateReport();

echo "<br>";

$gradeReport = new GradeReport();
$gradeReport->generateReport();

echo "<br>";

$enrollmentReport = new EnrollmentReport();
$enrollmentReport->generateReport();

?>
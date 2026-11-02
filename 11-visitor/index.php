
<?php

// Visitor Interface
interface Visitor {
    public function visitStudent(Student $student): void;
    public function visitFaculty(Faculty $faculty): void;
    public function visitAlumni(Alumni $alumni): void;
}

// Element Interface
interface Element {
    public function accept(Visitor $visitor): void;
}

// Student Class
class Student implements Element {
    public function accept(Visitor $visitor): void {
        $visitor->visitStudent($this);
    }
}

// Faculty Class
class Faculty implements Element {
    public function accept(Visitor $visitor): void {
        $visitor->visitFaculty($this);
    }
}

// Alumni Class
class Alumni implements Element {
    public function accept(Visitor $visitor): void {
        $visitor->visitAlumni($this);
    }
}

// CSV Export Visitor
class CSVExportVisitor implements Visitor {
    public function visitStudent(Student $student): void {
        echo "Student exported.<br>";
    }

    public function visitFaculty(Faculty $faculty): void {
        echo "Faculty exported.<br>";
    }

    public function visitAlumni(Alumni $alumni): void {
        echo "Alumni exported.<br>";
    }
}

// Report Visitor
class ReportVisitor implements Visitor {
    public function visitStudent(Student $student): void {
        echo "Student report generated.<br>";
    }

    public function visitFaculty(Faculty $faculty): void {
        echo "Faculty report generated.<br>";
    }

    public function visitAlumni(Alumni $alumni): void {
        echo "Alumni report generated.<br>";
    }
}

// Statistics Visitor
class StatisticsVisitor implements Visitor {
    private int $studentCount = 0;
    private int $facultyCount = 0;
    private int $alumniCount = 0;

    public function visitStudent(Student $student): void {
        $this->studentCount++;
    }

    public function visitFaculty(Faculty $faculty): void {
        $this->facultyCount++;
    }

    public function visitAlumni(Alumni $alumni): void {
        $this->alumniCount++;
    }

    public function displayStatistics(): void {
        echo "Total Students: " . $this->studentCount . "<br>";
        echo "Total Faculty: " . $this->facultyCount . "<br>";
        echo "Total Alumni: " . $this->alumniCount . "<br>";
    }
}

// Challenge: PDF Report Visitor
class PDFReportVisitor implements Visitor {
    public function visitStudent(Student $student): void {
        echo "Student PDF report generated.<br>";
    }

    public function visitFaculty(Faculty $faculty): void {
        echo "Faculty PDF report generated.<br>";
    }

    public function visitAlumni(Alumni $alumni): void {
        echo "Alumni PDF report generated.<br>";
    }
}

// Create Records
$records = [
    new Student(),
    new Faculty(),
    new Alumni()
];

// Demonstration
echo "<h2>Visitor - Student Record Operations</h2>";

// CSV Export Operation
echo "<h3>CSV Export Visitor</h3>";

$csvVisitor = new CSVExportVisitor();

foreach ($records as $record) {
    $record->accept($csvVisitor);
}

// Generate Report Operation
echo "<h3>Report Visitor</h3>";

$reportVisitor = new ReportVisitor();

foreach ($records as $record) {
    $record->accept($reportVisitor);
}

// Calculate Statistics Operation
echo "<h3>Statistics Visitor</h3>";

$statisticsVisitor = new StatisticsVisitor();

foreach ($records as $record) {
    $record->accept($statisticsVisitor);
}

$statisticsVisitor->displayStatistics();

// Challenge: PDF Report Operation
echo "<h3>PDF Report Visitor</h3>";

$pdfVisitor = new PDFReportVisitor();

foreach ($records as $record) {
    $record->accept($pdfVisitor);
}

?>

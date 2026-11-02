
<?php

// Student class
class Student {
    private string $studentId;
    private string $name;

    public function __construct(string $studentId, string $name) {
        $this->studentId = $studentId;
        $this->name = $name;
    }

    public function getStudentId(): string {
        return $this->studentId;
    }

    public function getName(): string {
        return $this->name;
    }
}

// Student collection using IteratorAggregate
class StudentCollection implements IteratorAggregate {
    private array $students = [];

    public function add(Student $student): void {
        $this->students[] = $student;
    }

    public function getIterator(): Traversable {
        return new ArrayIterator($this->students);
    }
}

// Main Program
$students = new StudentCollection();

$students->add(new Student("2026-001", "Juan"));
$students->add(new Student("2026-002", "Maria"));
$students->add(new Student("2026-003", "Pedro"));

echo "<h2>Iterator - Student Record Collection</h2>";
echo "Student List<br><br>";

// Access records through the iterator
foreach ($students as $student) {
    echo $student->getStudentId() . " - ";
    echo $student->getName() . "<br>";
}

?>


<?php

// Memento class
class StudentProfileMemento {
    private string $name;
    private string $program;
    private int $year;
    private string $email;

    public function __construct(
        string $name,
        string $program,
        int $year,
        string $email
    ) {
        $this->name = $name;
        $this->program = $program;
        $this->year = $year;
        $this->email = $email;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getProgram(): string {
        return $this->program;
    }

    public function getYear(): int {
        return $this->year;
    }

    public function getEmail(): string {
        return $this->email;
    }
}

// Originator class
class StudentProfile {
    private string $name;
    private string $program;
    private int $year;
    private string $email;

    public function __construct(
        string $name,
        string $program,
        int $year,
        string $email
    ) {
        $this->name = $name;
        $this->program = $program;
        $this->year = $year;
        $this->email = $email;
    }

    public function changeProfile(
        string $program,
        int $year
    ): void {
        $this->program = $program;
        $this->year = $year;
    }

    public function save(): StudentProfileMemento {
        return new StudentProfileMemento(
            $this->name,
            $this->program,
            $this->year,
            $this->email
        );
    }

    public function restore(StudentProfileMemento $memento): void {
        $this->name = $memento->getName();
        $this->program = $memento->getProgram();
        $this->year = $memento->getYear();
        $this->email = $memento->getEmail();
    }

    public function displayProfile(): void {
        echo "Name: " . $this->name . "<br>";
        echo "Program: " . $this->program . "<br>";
        echo "Year: " . $this->year . "<br>";
        echo "Email: " . $this->email . "<br>";
    }
}

// Caretaker class
class ProfileHistory {
    private array $history = [];

    public function saveProfile(StudentProfileMemento $memento): void {
        $this->history[] = $memento;
    }

    public function undo(): ?StudentProfileMemento {
        if (empty($this->history)) {
            return null;
        }

        return array_pop($this->history);
    }
}

// Main Program
$profile = new StudentProfile(
    "Juan Dela Cruz",
    "BSIT",
    3,
    "juan@example.com"
);

$history = new ProfileHistory();

// Save original profile
$history->saveProfile($profile->save());

// Change profile
$profile->changeProfile("BSCS", 4);

echo "<h2>Memento - Student Profile Undo System</h2>";

echo "<strong>Current Profile:</strong><br>";
$profile->displayProfile();

// Undo changes
echo "<br>Undo...<br>";

$previousProfile = $history->undo();

if ($previousProfile !== null) {
    $profile->restore($previousProfile);
}

echo "<br><strong>Restored Profile:</strong><br>";
$profile->displayProfile();

?>

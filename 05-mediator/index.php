
<?php

// Mediator interface
interface Mediator {
    public function addStudent(Student $student): void;
    public function sendMessage(string $message, Student $sender): void;
}

// Concrete Mediator
class ChatMediator implements Mediator {
    private array $students = [];

    public function addStudent(Student $student): void {
        $this->students[] = $student;
    }

    public function sendMessage(string $message, Student $sender): void {
        foreach ($this->students as $student) {
            if ($student !== $sender) {
                $student->receiveMessage($message, $sender->getName());
            }
        }
    }
}

// Student class
class Student {
    private string $name;
    private Mediator $mediator;

    public function __construct(string $name, Mediator $mediator) {
        $this->name = $name;
        $this->mediator = $mediator;
    }

    public function getName(): string {
        return $this->name;
    }

    public function sendMessage(string $message): void {
        echo $this->name . ": " . $message . "<br>";
        $this->mediator->sendMessage($message, $this);
    }

    public function receiveMessage(string $message, string $senderName): void {
        echo $this->name . " receives:<br>";
        echo $senderName . ": " . $message . "<br>";
    }
}

// Main Program
$chatMediator = new ChatMediator();

$juan = new Student("Juan", $chatMediator);
$maria = new Student("Maria", $chatMediator);
$pedro = new Student("Pedro", $chatMediator);

// Register students in the mediator
$chatMediator->addStudent($juan);
$chatMediator->addStudent($maria);
$chatMediator->addStudent($pedro);

echo "<h2>Mediator - Student Communication System</h2>";

// Juan sends a message
$juan->sendMessage("Hello everyone!");

?>

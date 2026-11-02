
<?php

interface Command {
    public function execute(): void;
    public function undo(): void;
}

class StudentSystem {
    public function enrollStudent(): void {
        echo "Student successfully enrolled.<br>";
    }

    public function dropSubject(): void {
        echo "Subject successfully dropped.<br>";
    }

    public function printRegistration(): void {
        echo "Registration successfully printed.<br>";
    }

    public function logout(): void {
        echo "Student successfully logged out.<br>";
    }
}

class EnrollCommand implements Command {
    private StudentSystem $system;

    public function __construct(StudentSystem $system) {
        $this->system = $system;
    }

    public function execute(): void {
        $this->system->enrollStudent();
    }

    public function undo(): void {
        echo "Enrollment undone.<br>";
    }
}

class DropSubjectCommand implements Command {
    private StudentSystem $system;

    public function __construct(StudentSystem $system) {
        $this->system = $system;
    }

    public function execute(): void {
        $this->system->dropSubject();
    }

    public function undo(): void {
        echo "Subject drop undone.<br>";
    }
}

class PrintRegistrationCommand implements Command {
    private StudentSystem $system;

    public function __construct(StudentSystem $system) {
        $this->system = $system;
    }

    public function execute(): void {
        $this->system->printRegistration();
    }

    public function undo(): void {
        echo "Registration print cannot be undone.<br>";
    }
}

class LogoutCommand implements Command {
    private StudentSystem $system;

    public function __construct(StudentSystem $system) {
        $this->system = $system;
    }

    public function execute(): void {
        $this->system->logout();
    }

    public function undo(): void {
        echo "Logout cannot be undone.<br>";
    }
}

// Invoker
class StudentSystemInvoker {
    private ?Command $lastCommand = null;

    public function executeCommand(Command $command): void {
        $command->execute();
        $this->lastCommand = $command;
    }

    public function undo(): void {
        if ($this->lastCommand !== null) {
            echo "Undo<br>";
            $this->lastCommand->undo();
            $this->lastCommand = null;
        }
    }
}

// Main Program
$system = new StudentSystem();
$invoker = new StudentSystemInvoker();

echo "<h2>Command - Student System Actions</h2>";

echo "Executing: Enroll Student<br>";
$invoker->executeCommand(new EnrollCommand($system));

echo "<br>Executing: Drop Subject<br>";
$invoker->executeCommand(new DropSubjectCommand($system));

echo "<br>";
$invoker->undo();

echo "<br>Executing: Print Registration<br>";
$invoker->executeCommand(new PrintRegistrationCommand($system));

echo "<br>Executing: Logout<br>";
$invoker->executeCommand(new LogoutCommand($system));

?>

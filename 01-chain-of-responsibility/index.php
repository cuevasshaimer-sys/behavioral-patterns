
<?php

class StudentRequest {
    private string $type;

    public function __construct(string $type) {
        $this->type = $type;
    }

    public function getType(): string {
        return $this->type;
    }
}

interface Handler {
    public function setNext(Handler $handler): Handler;
    public function handle(StudentRequest $request): void;
}

abstract class BaseHandler implements Handler {
    protected ?Handler $nextHandler = null;

    public function setNext(Handler $handler): Handler {
        $this->nextHandler = $handler;
        return $handler;
    }

    protected function passToNext(StudentRequest $request): void {
        if ($this->nextHandler !== null) {
            $this->nextHandler->handle($request);
        } else {
            echo "No office can process this request.<br>";
        }
    }
}

class StudentAffairsHandler extends BaseHandler {
    public function handle(StudentRequest $request): void {
        if ($request->getType() === "Good Moral Certificate") {
            echo "Student Affairs: Processing Good Moral Certificate...<br>";
        } else {
            echo "Student Affairs: Cannot process request.<br>";
            $this->passToNext($request);
        }
    }
}

class RegistrarHandler extends BaseHandler {
    public function handle(StudentRequest $request): void {
        if (
            $request->getType() === "Certificate of Enrollment" ||
            $request->getType() === "Transcript of Records"
        ) {
            echo "Registrar: Processing " . $request->getType() . "...<br>";
        } else {
            echo "Registrar: Cannot process request.<br>";
            $this->passToNext($request);
        }
    }
}

class FinanceHandler extends BaseHandler {
    public function handle(StudentRequest $request): void {
        if ($request->getType() === "Student ID Concern") {
            echo "Finance: Processing Student ID Concern...<br>";
        } else {
            echo "Finance: Cannot process request.<br>";
            $this->passToNext($request);
        }
    }
}

class ICTHandler extends BaseHandler {
    public function handle(StudentRequest $request): void {
        if ($request->getType() === "Student ID Concern") {
            echo "ICT: Processing Student ID Concern...<br>";
        } else {
            echo "ICT: Cannot process request.<br>";
            $this->passToNext($request);
        }
    }
}

// Create the handlers
$studentAffairs = new StudentAffairsHandler();
$registrar = new RegistrarHandler();
$finance = new FinanceHandler();
$ict = new ICTHandler();

// Connect the chain
$studentAffairs->setNext($registrar)
               ->setNext($finance)
               ->setNext($ict);

// Submit a student request
$request = new StudentRequest("Transcript of Records");

echo "<h2>Chain of Responsibility - Student Request Processing System</h2>";
echo "Request: " . $request->getType() . "<br>";

$studentAffairs->handle($request);

?>

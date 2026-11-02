
<?php

class StudentContext {
    private string $program;
    private int $year;

    public function __construct(string $program, int $year) {
        $this->program = $program;
        $this->year = $year;
    }

    public function getProgram(): string {
        return $this->program;
    }

    public function getYear(): int {
        return $this->year;
    }
}

interface Expression {
    public function interpret(StudentContext $student): bool;
}

class TerminalExpression implements Expression {
    private string $field;
    private $value;

    public function __construct(string $field, $value) {
        $this->field = $field;
        $this->value = $value;
    }

    public function interpret(StudentContext $student): bool {
        if ($this->field === "PROGRAM") {
            return $student->getProgram() === $this->value;
        }

        if ($this->field === "YEAR") {
            return $student->getYear() === $this->value;
        }

        return false;
    }
}

class AndExpression implements Expression {
    private Expression $left;
    private Expression $right;

    public function __construct(Expression $left, Expression $right) {
        $this->left = $left;
        $this->right = $right;
    }

    public function interpret(StudentContext $student): bool {
        return $this->left->interpret($student)
            && $this->right->interpret($student);
    }
}

class OrExpression implements Expression {
    private Expression $left;
    private Expression $right;

    public function __construct(Expression $left, Expression $right) {
        $this->left = $left;
        $this->right = $right;
    }

    public function interpret(StudentContext $student): bool {
        return $this->left->interpret($student)
            || $this->right->interpret($student);
    }
}

// Main Program
$student = new StudentContext("BSIT", 4);

// PROGRAM = "BSIT" AND YEAR = 4
$programExpression = new TerminalExpression("PROGRAM", "BSIT");
$yearExpression = new TerminalExpression("YEAR", 4);

$andExpression = new AndExpression(
    $programExpression,
    $yearExpression
);

echo "<h2>Interpreter - Student Search/Query System</h2>";

echo "Expression:<br>";
echo 'PROGRAM = "BSIT" AND YEAR = 4<br>';

echo "Result: ";
echo $andExpression->interpret($student) ? "TRUE" : "FALSE";

// Challenge: OR expression
$bsitExpression = new TerminalExpression("PROGRAM", "BSIT");
$bscsExpression = new TerminalExpression("PROGRAM", "BSCS");

$orExpression = new OrExpression(
    $bsitExpression,
    $bscsExpression
);

echo "<br><br>Challenge Expression:<br>";
echo 'PROGRAM = "BSIT" OR PROGRAM = "BSCS"<br>';

echo "Result: ";
echo $orExpression->interpret($student) ? "TRUE" : "FALSE";

?>

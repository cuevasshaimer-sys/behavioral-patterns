<?php

interface GradeStrategy {
    public function calculate(array $grades): float;
}

class SimpleAverageStrategy implements GradeStrategy {
    public function calculate(array $grades): float {
        return array_sum($grades) / count($grades);
    }
}

class WeightedAverageStrategy implements GradeStrategy {
    public function calculate(array $grades): float {
        $weights = [0.30, 0.30, 0.40];

        $total = 0;

        foreach ($grades as $index => $grade) {
            $total += $grade * $weights[$index];
        }

        return $total;
    }
}

class TransmutedGradeStrategy implements GradeStrategy {
    public function calculate(array $grades): float {
        $average = array_sum($grades) / count($grades);

        if ($average >= 90) {
            return 1.25;
        } elseif ($average >= 85) {
            return 1.50;
        } elseif ($average >= 80) {
            return 1.75;
        } elseif ($average >= 75) {
            return 2.00;
        } else {
            return 5.00;
        }
    }
}

class GradeCalculator {
    private GradeStrategy $strategy;

    public function __construct(GradeStrategy $strategy) {
        $this->strategy = $strategy;
    }

    public function setStrategy(GradeStrategy $strategy): void {
        $this->strategy = $strategy;
    }

    public function calculateGrade(array $grades): float {
        return $this->strategy->calculate($grades);
    }
}

// Demonstration
$grades = [85, 90, 92];

$calculator = new GradeCalculator(new SimpleAverageStrategy());

echo "<h2>Strategy - Grade Calculation System</h2>";

echo "Simple Average: ";
echo number_format($calculator->calculateGrade($grades), 2);

echo "<br><br>";

$calculator->setStrategy(new WeightedAverageStrategy());

echo "Weighted Average: ";
echo number_format($calculator->calculateGrade($grades), 2);

echo "<br><br>";

$calculator->setStrategy(new TransmutedGradeStrategy());

echo "Transmuted Grade: ";
echo number_format($calculator->calculateGrade($grades), 2);

?>
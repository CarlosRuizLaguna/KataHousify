<?php

class Rover {
    public $x;
    public $y;
    public $direction;
    private $obstacles;

    public function __construct($x, $y, $direction) {
        $this->x = $x;
        $this->y = $y;
        $this->direction = $direction;
        $this->obstacles = [];
    }

    public function moveForward() {
        $newX = $this->x;
        $newY = $this->y;

        if ($this->direction === 'N') $newY++;
        elseif ($this->direction === 'S') $newY--;
        elseif ($this->direction === 'E') $newX++;
        elseif ($this->direction === 'W') $newX--;

        if ($this->isPositionValid($newX, $newY)) {
            $this->x = $newX;
            $this->y = $newY;
        } else {
            echo "Obstacle detected at ($newX, $newY)\n";
            return false;
        }
        return true;
    }

    public function turnLeft() {
        $directions = ['N', 'W', 'S', 'E'];
        $currentIndex = array_search($this->direction, $directions);
        $this->direction = $directions[($currentIndex + 1) % 4];
    }

    public function turnRight() {
        $directions = ['N', 'E', 'S', 'W'];
        $currentIndex = array_search($this->direction, $directions);
        $this->direction = $directions[($currentIndex + 1) % 4];
    }

    private function isPositionValid($x, $y) {
        if (in_array("$x,$y", $this->obstacles)) return false;
        return $x >= 0 && $x < 200 && $y >= 0 && $y < 200;
    }

    public function executeCommands($commands) {
        for ($i = 0; $i < strlen($commands); $i++) {
            $command = $commands[$i];
            if ($command === 'F') {
                if (!$this->moveForward()) break;
            } elseif ($command === 'L') {
                $this->turnLeft();
            } elseif ($command === 'R') {
                $this->turnRight();
            } else {
                echo "Unknown command: $command\n";
            }
        }
    }

    public function addObstacle($x, $y) {
        $this->obstacles[] = "$x,$y";
    }
}

// Ejemplo de uso
$rover = new Rover(0, 0, 'N');
$rover->addObstacle(1, 1);
$rover->executeCommands('FFRFFLFF');
echo "Final position: ({$rover->x}, {$rover->y}), Direction: {$rover->direction}\n";
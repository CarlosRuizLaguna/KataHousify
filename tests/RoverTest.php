<?php

use PHPUnit\Framework\TestCase;

require_once 'rover.php';

class RoverTest extends TestCase
{
    public function testMoveForward()
    {
        $rover = new Rover(0, 0, 'N');
        $rover->moveForward(); 
        $this->assertEquals(1, $rover->y); 
    }

    public function testTurnLeft()
    {
        $rover = new Rover(0, 0, 'N'); 
        $rover->turnLeft(); 
        $this->assertEquals('W', $rover->direction); 
    }

    public function testTurnRight()
    {
        $rover = new Rover(0, 0, 'N'); 
        $rover->turnRight(); 
        $this->assertEquals('E', $rover->direction);
    }

    public function testObstacleDetection()
    {
        $rover = new Rover(0, 0, 'N');
        $rover->addObstacle(0, 1); 
        $this->assertFalse($rover->moveForward()); 
    }

    public function testBoundaryLimits()
    {
        $rover = new Rover(199, 199, 'N'); 
        $this->assertTrue($rover->moveForward()); 
        $this->assertEquals(199, $rover->y); 
    }

    public function testExecuteCommands()
    {
        $rover = new Rover(0, 0, 'N'); 
        $rover->executeCommands('FFRFFLFF'); 
        $this->assertEquals(2, $rover->x); 
        $this->assertEquals(2, $rover->y); 
        $this->assertEquals('N', $rover->direction);
    }

    public function testUnknownCommand()
    {
        $rover = new Rover(0, 0, 'N'); 
        $this->expectOutputString("Unknown command: X\n");
        $rover->executeCommands('X');
    }
}
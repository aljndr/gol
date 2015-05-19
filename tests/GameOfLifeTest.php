<?php
/**
 * Game Of Life
 *
 * Class that test the Conway's Game of Life implementation 
 *
 * @author     Alejandro Franco Rojas <alejandro.f.rojas@gmail.com>
 */

class GameOfLifeTest extends PHPUnit_Framework_TestCase{

	public function invokeMethod(&$object,$methodName,array $parametes = array()){
		$reflection = new ReflectionClass(get_class($object));
		$method = $reflection->getMethod($methodName);
		$method->setAccessible(true);
		return $method->invokeArgs($object,$parametes);
	}

	public function testOneOrZeroForTestOnlyThree(){
		$gol = new GameOfLife();
		for ($i=0; $i < 20; $i++) { 
			$this->assertLessThanOrEqual(1,$this->invokeMethod($gol,'testOnlyThree',array($i)));
			$this->assertGreaterThanOrEqual(0,$this->invokeMethod($gol,'testOnlyThree',array($i)));		
		}
	}

	public function testOneOrZeroForTestOnlyTwo(){
		$gol = new GameOfLife();
		for ($i=0; $i < 20; $i++) { 
			$this->assertLessThanOrEqual(1,$this->invokeMethod($gol,'testOnlyTwo',array($i,1)));
			$this->assertLessThanOrEqual(1,$this->invokeMethod($gol,'testOnlyTwo',array($i,0)));
			$this->assertGreaterThanOrEqual(0,$this->invokeMethod($gol,'testOnlyTwo',array($i,0)
				));
			$this->assertGreaterThanOrEqual(0,$this->invokeMethod($gol,'testOnlyTwo',array($i,1)
				));
		}
	}

	public function testBlinkerOscilator(){
		$gol = new GameOfLife();
		$board = $gol->getBoard();
		$board[9][9] 	= 1;
        $board[10][9] 	= 1;
		$board[11][9]	= 1;
		$gol->setBoardRequest($board);
		$gol->move();
		$board = $gol->getBoard();
		$this->assertEquals($board[10][8],1);
		$this->assertEquals($board[10][9],1);
		$this->assertEquals($board[10][10],1);

	}

	public function testStillBlock(){
		$gol = new GameOfLife();
		$board = $gol->getBoard();
		$board[9][8]	=1;
		$board[10][8]	=1;
		$board[9][9]	=1;
		$board[10][9]	=1;
		$gol->setBoardRequest($board);
		$gol->move();
		$board = $gol->getBoard();
		$this->assertEquals($board[9][8],1);
		$this->assertEquals($board[10][8],1);
		$this->assertEquals($board[9][9],1);
		$this->assertEquals($board[10][9],1);
	}

	public function testStillBoat(){
		$gol = new GameOfLife();
		$gol = new GameOfLife();
		$board = $gol->getBoard();
		$board[9][8]	=1;
		$board[10][8]	=1;
		$board[9][9]	=1;
		$board[11][9]	=1;
		$board[10][10]	=1;
		$gol->setBoardRequest($board);
		$gol->move();
		$board = $gol->getBoard();
		$this->assertEquals($board[9][8],1);
		$this->assertEquals($board[10][8],1);
		$this->assertEquals($board[9][9],1);
		$this->assertEquals($board[11][9],1);
		$this->assertEquals($board[10][10],1);	
	}
}



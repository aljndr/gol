<?php
/**
 * Game Of Life
 *
 * Class that implements the Conway's Game of Life 
 *
 * @author     Alejandro Franco Rojas <alejandro.f.rojas@gmail.com>
 */


class GameOfLife{

	/**
     * Orignal board before changes
     *
     * @var array
     */
	protected $pastBoard;
	/**
     * The game board
     *
     * @var array
     */
	protected $board;
	/**
     * User request board
     *
     * @var array
     */
	protected $boardRequest;	// User request board
	/**
     *  Html string to print the board
     *
     * @var string
     */
	protected $stringBoard;

	public function __construct(){
		$this->stringBoard="";
		$this->board = array(
			array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
			array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
			array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
			array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
			array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
			array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
			array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
			array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
			array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
			array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
			array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
			array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
			array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
			array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
			array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
			array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
			array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
			array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
			array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
			array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
			array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
			array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
		);	
		$this->boardRequest = $this->board;
	}
	

	/**
	 * Test if the cell have only three Neighbours
	 *
	 * @param  int $sum Sum of all Neighbours status
	 * @return int
	 */
	protected function testOnlyThree($sum){
		return (((1 << $sum ) & 8) >> 3);
	}

	/**
	 * Test if the cell have only two Neighbours
	 *
	 * @param  int $sum Sum of all Neighbours status
	 * @param  int $value Vale of the cell to test
	 * @return int
	 */
	protected function testOnlyTwo($sum,$value){
		return (((1 << $sum ) & 4) >> 2) & $value;
	}

	/**
	 * Move accross the first dimension of the array to set the user request
	 *
	 * @param  array The row to walk
	 * @param  int Index of the actual row 
	 * @return int
	 */
	protected function setAndMoveY($row,$indexY){
		array_walk(array_slice($row,0,-2), array($this,"setAndMoveX"),$indexY);		
		return 0;
	}


	/**
	 * Move accross the second dimension of the array to set the user request
	 *
	 * @param  int Cell value
	 * @param  int Index of the actual cell
	 * @param int Index of the actual row
	 * @return int 
	 */
	protected function setAndMoveX($cell,$indexX,$indexY){
		$this->board[($indexX+1)][($indexY+1)] = $this->boardRequest[($indexX+1)][($indexY+1)];
		return 0;
	}


	/**
	 * Move accross the first dimension of the array to test the cells
	 *
	 * @param  array The row to walk
	 * @param  int Index of the actual row 
	 * @return int
	 */
	protected function moveY($row,$indexY){
		array_walk(array_slice($row,0,-2), array($this,"moveX"),$indexY);		
		return 0;
	}

	/**
	 * Move accross the second dimension of the array to test the cell and generates * the Html string
	 *
	 * @param  int Cell value
	 * @param  int Index of the actual cell
	 * @param int Index of the actual row
	 * @return int 
	 */
	protected function moveX($cell,$indexX,$indexY){
		$value =  $this->pastBoard[($indexX+1)][($indexY+1)];
		$sum = $this->sumNeighbours($indexX+1,$indexY+1);
		$value = $this->testOnlyTwo($sum,$value) | $this->testOnlyThree($sum) ; 
		$this->board[($indexX+1)][($indexY+1)] = $value;

		$class = array(" ","live");
		$checked = array(" ","checked");

		$this->stringBoard.=
		"<div data-x=\"".($indexX+1)."\" data-y=\"".($indexY+1)."\" id=\"cell_".($indexX+1)."_".($indexY+1)."\" class=\"cell ".$class[$value]."\"></div>
                  <input class=\"cell-input\" style=\"display:none\" ".$checked[$value]." type=\"checkbox\" value=\"".$value."\" id=\"input_".($indexX+1)."_".($indexY+1)."\" name=\"board[".($indexX+1)."][".($indexY+1)."]\">";

		return 0;
	}

	/**
	 * Sum the status of all neighbours
	 * @param  int Index of the actual cell
	 * @param  int Index of the actual row
	 * @return int 
	 */
	protected function sumNeighbours($x,$y)
	{
		$b = $this->pastBoard;
		return 	$b[$x-1][$y-1] + $b[$x-1][$y] + $b[$x-1][$y+1] +
				$b[$x+1][$y-1] + $b[$x+1][$y] + $b[$x+1][$y+1] +
				  $b[$x][$y-1] + $b[$x][$y+1] ;
	}

	/**
	 * Move across the board to test the game rules and set the correct values
	 * @return string
	 */
	public function move(){
		$this->pastBoard = $this->board;
		array_walk(array_slice($this->board,0,-2), array($this,"moveY"));		
		return "<form id=\"form_board\">".$this->stringBoard."</form>";
	}

	/**
	 * Simulates Y infinity 
	 */
	protected function noYBoundaries($row,$indexY){
		$this->board[$indexY][0]=$this->board[$indexY][sizeof($this->board)-2]; 
		$this->board[$indexY][sizeof($this->board)-1]=$this->board[$indexY][1]; 
	}

	/**
	 * Simulates X infinity 
	 */
	protected function noXBoundaries($row,$indexX){
		$this->board[0][$indexX]=$this->board[sizeof($this->board)-2][$indexX]; 
		$this->board[sizeof($this->board)-1][$indexX]=$this->board[1][$indexX]; 
	}

	/**
	 * Set the board based in the user request 
	 */
	public function setBoardRequest($request = array()){
		var_dump($request);
		$this->boardRequest = $request;
		//Array walk to set the board to user request
		array_walk(array_slice($this->board,0,-2), array($this,"setAndMoveY"));
		array_walk($this->board, array($this,"noYBoundaries"));
		array_walk($this->board[0], array($this,"noXBoundaries"));
	}

	public function getBoard(){
		return $this->board;
	}
}
















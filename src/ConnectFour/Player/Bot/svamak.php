<?php


namespace ConnectFour\Player\Bot;


use ConnectFour\Game\Grid\Helper;
use ConnectFour\Player\PlayerInterface;

class svamak implements PlayerInterface
{
    /**
     * Returns next move of player by given grid
     *
     * <code>
     * $grid = [
     *    [0,0,0,1,2,2,0],
     *    [0,0,0,1,2,0,0],
     *    [0,0,0,0,1,0,0],
     *    [0,0,0,0,0,0,0],
     *    [0,0,0,0,0,0,0],
     *    [0,0,0,0,0,0,0],
     * ]
     * </code>
     *
     * @param array $grid Grid representation in 7 columns, 6 rows array
     *
     * @return int 0 to 6 index of column to drop disk
     */
    public function move($grid)
    {
        $columns = Helper::getAvailableColumns($grid);
        $bestColumn = $this->bestInColumns($columns);
		return $bestColumn;
    }
	
	public function goodInSingleColumn($column){
		//idea: count 1's in a single occurence
		//1 1 2 = 2
		//2 1 2 1 1 = 0
		$goodOne = 0;
		foreach($column as $index){
			if($index == 1){
				$goodOne++;
			}else{
				$goodOne = 0;
			}
		}
		return $goodOne;
	}
	
	public function bestInColumns($columns){
		//return column index with biggest success on column
		$bestByColumn = [];
		$i = 0;
		foreach($columns as $column){
			$bestByColumn [] = ["amount" => $this->goodInSingleColumn($column), "columnIndex" => $i];
			$i++;
		}
		
		$bestByColumn = $this->sortByKeyValue($bestByColumn, "amount");
		$bestByColumn = $bestByColumn[0]["columnIndex"];
		
		return $bestByColumn;
	}
	
	public function sortByKeyValue($data, $sortKey, $sort_flags = SORT_DESC){
		if (empty($data) or empty($sortKey)) return $data;

		$ordered = array();
		foreach ($data as $key => $value)
			$ordered[$value[$sortKey]] = $value;

		ksort($ordered, $sort_flags);

		return array_values($ordered); 
	}
}

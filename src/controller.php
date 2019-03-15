<?php
class Controller extends DB {

  function get($year){

  	$year_before = $year - 1;
  	$year_after = $year + 1;

    return $this->select("SELECT 
    	car_id, year, SUM(price) AS price
    	FROM
    	car_price
    	where year in ('".$year_before."','".$year."','".$year_after."')
    	GROUP BY car_id , year");
  }

  function car(){
  	return $this->select("SELECT * FROM car");
  }
}

?>
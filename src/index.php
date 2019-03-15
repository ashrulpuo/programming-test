<!DOCTYPE htm>
<html>
<body>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	</head>
	<?php
	require "model.php";
	require "controller.php";

	$car = new Controller();
	// echo "<pre>";
	// print_r($car->civic());
	// echo "</pre>";

	//use array_unique & array_column to remove duplicate data
	//$temp = array_unique(array_column($car->get(), 'year'));
	//$unique_arr = array_intersect_key($car->get(), $temp);

	//get value form post data
	$year = $_REQUEST['year'];
	$year_before = $year - 1;
  	$year_after = $year + 1;
	// echo "<pre>";
	// print_r($unique_arr);
	// echo "</pre>";
	?>

	<br/>
	<form id="form" action="/index.php">
		<div class="row"><label>Price year : </label>
			<input type="text" maxlength="4" id="year" name="year" value="">
			<input type="submit" id="submit" value="Submit">&nbsp;&nbsp;<span id="errmsg">
		</div>
	</form> 

	<table id="t01">
		<tr>
			<td rowspan="2" style="text-align: center">Car Name</td>
			<td colspan="3" style="text-align: center">Years</td>
		</tr>
		<tr>
			<td><?php echo $year_before;?></td>
			<td><?php echo $year;?></td>
			<td><?php echo $year_after;?></td>
		</tr>
		<tr>
			<?php 
			$result = [];
			foreach ($car->get($year) as $u) {
				$result[$u['car_id']][$u['year']] = $u['price'];
			}
			// echo '<pre>';
			// print_r($result );
			// echo '</pre>';
			?>
		</tr>
		<?php
		//foreach year using array_unique
		foreach ($car->car() as $u) {
			echo "<tr>";
			echo "<th style='text-align: center;' >" . $u['car_name'] . "</th>";
			echo "<td>". (isset($result[$u['car_id']][$year_before])?$result[$u['car_id']][$year_before]:'0') ."</td>";
			echo "<td>". (isset($result[$u['car_id']][$year])?$result[$u['car_id']][$year]:'0') ."</td>";
			echo "<td>". (isset($result[$u['car_id']][$year_after])?$result[$u['car_id']][$year_after]:'0') ."</td>";
			echo "</tr>";
		}
		?>
	</table>

	<script>
		$(document).ready(function(){     
			$('#submit').click(function(){
				if(($('#year').val()) == ''){
					$("#errmsg").html("please specify the price year").show().delay(5000).fadeOut();
			        return false;
				}
			});

			$("#year").keypress(function (e) {
			     //if the letter is not digit then display error and don't type anything
			     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
			        //display error message
			        $("#errmsg").html("please specify only number for the price year").show().delay(5000).fadeOut();
			        return false;
			    }
			});
		});
	</script>

	<style type="text/css">
	table {
		width:100%;
	}
	table, th, td {
		border: 1px solid black;
		border-collapse: collapse;
	}
	th, td {
		padding: 15px;
		text-align: left;
	}
	table#t01 tr:nth-child(even) {
		background-color: #eee;
	}
	table#t01 tr:nth-child(odd) {
		background-color: #fff;
	}
	table#t01 th {
		background-color: grey;
		color: white;
	}
	#errmsg
	{
		color: red;
	}
</style>

</body>
</html>
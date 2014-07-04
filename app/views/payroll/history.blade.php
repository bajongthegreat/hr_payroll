@extends('layout.master')


@section('content')

<h2 class="page-header"> Payroll History</h2>


<table class="table table-hover">
	<thead>
		<th width="10%">Start [Period]</th>
		<th width="30%">End [Period]</th>
		<th width="30%">For company</th>
		<th width="10%"></th>
	</thead>

	<tbody>
	<?php 

		if ($handle = opendir( public_path() . '\\' . 'json' )) {

		    while (false !== ($entry = readdir($handle))) {

		        if ($entry != "." && $entry != "..") {
		        	echo '<pre>';
		        	var_dump(explode('_',$entry ));

		        	$filenameArr = explode('_',$entry );
		        	$last = explode('.', $filenameArr[count($filenameArr) -1]);
		        	echo '<tr>';
		            echo "<td>" . $filenameArr[3] . '-' . $filenameArr[4] . '-' .$filenameArr[2] . " \n </td>";
		            echo "<td>" . $filenameArr[7] . '-' . $last[0] . '-' .$filenameArr[6] . " \n </td>";
		            echo '</tr>';
		        }
		    }

		    closedir($handle);
		}
	?>
	</tbody>

@stop



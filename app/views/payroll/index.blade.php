@extends('layout.master')


@section('content')

	<?php 

		if ($handle = opendir( public_path() . '\\' . 'json' )) {

		    while (false !== ($entry = readdir($handle))) {

		        if ($entry != "." && $entry != "..") {

		            echo "$entry\n <br>";
		        }
		    }

		    closedir($handle);
		}
	?>

@stop



@extends('layout.master')

@section('content')
	
	<style>
	
	 
	.listing ol {
	 
	}
	 
	.listing .num-title {
		 color: #ccc;
	  list-style-type: none;
	  font: bold italic 31px/1.5 Helvetica, Verdana, sans-serif;

	}

	.listing .content {
		
		margin-left: 25px;

		color: #555;

	}
	</style>
	

	<div class="content-center">
		<div class="page-header"><h3>Payroll Setup</h3> </div>
			
				<div class="listing part_1">

					<div >
						<div class="step">
							<span class="num-title">1.</span> <span class="content">Set Pay period.</span> 
						</div>

					</div>

					<div >
						<div class="step">
							<span class="num-title">2.</span> <span class="content">Select included employees.</span>
						</div>
					</div>
					
					<div >
						<div class="step">
							<span class="num-title">3.</span> <span class="content">Process and save.</span>
						</div>
					</div>
					
						
					
				</div>

			

	</div>

@stop
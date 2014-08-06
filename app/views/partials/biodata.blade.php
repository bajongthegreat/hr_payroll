<html>
<head>
	<title>Member Profile</title>
</head>
<body>
<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

<style type="text/css">
	body {

	}	
	.header-container {
		font-family:  'Roboto', sans-serif;
		margin: 25px 15px;
		border: 1px solid #000;
		height: 115px;
	}
	.logo {
		margin-left: 50px;
		margin-top: 5px;
		width: 120px;
		float: left;
	}

	.company_name .title{
		font-size: 20px;
		margin-top: 20px;
	}

	.container {
		margin: 25px 15px;
		/*border: 1px solid #000;*/
	}

	.text-center {
		text-align: center;
	}

	.text-left {
		text-align: left;
	}

	.text-right {
		text-align: right;
	}

	.info-header {
		font-family:  'Roboto', sans-serif;
		font-size: 25px;
		padding-bottom: 9px;
		margin: 10px 15px;
		border-bottom: 1px solid #eeeeee;
	}

	.info-body{
		width: 100%;
		height: 1px;
		margin: 0 0 -1px;
		padding: 5px;
		clear: both;
	}
	.info-body :after {
		clear: both;
	}

	.info-label {
		font-family: 'Open Sans', sans-serif;	
		width: 150px;
		float:left;
		font-size: 14px;
		/*font-family: sans-serif !important;*/
		display: inline-block;
		margin-bottom: 5px;
		/*font-weight: bold;*/
	}

	.info-value {
		margin-left: 15px;
		width: 400px;
		float:left;
		/*border-bottom: 1px solid #000;*/
	}	

	.spacer{ 
		height: 10px;
		clear:both;
	}

</style>
<!-- Main header container -->
<div class="header-container">

	<!-- Logo container -->
	<div class="logo">
		<img src="{{ asset('img/logo.png') }}">
	</div>

	<!-- Company name holder -->
	<div class="company_name">
			<div class="title">TIBUD sa Katibawasan Multi-Purpose Cooperative</div>
			<div>Purok Rañada, Brgy. Poblacion, Polomolok, South Cotabato</div>
			<div>CDA Registration No. 9520-12008158; Tel. No. (083) 500-8467</div>
	</div>


</div>


<!-- Body -->
<div class="container">

	<!-- Personal Information -->
	<div class="info-container">

		<div class="info-header text-center">
			Personal Information
		</div>

		<div class="info-body">
			<div class="info-label text-right"><strong>Full name</strong>: </div>
			<div class="info-value"><span class="firstname">John</span> <span class="lastname">Doe</span> </div>
		</div>	

		<div class="info-body">
			<div class="info-label text-right"><strong>Birth date</strong>: </div>
			<div class="info-value">November 11, 1979 (34 years old) </div>
		</div>	

		<div class="info-body">
			<div class="info-label text-right"><strong>Birth place</strong>: </div>
			<div class="info-value">POBLACION LAMBAYONG SULTAN KUDARAT </div>
		</div>	

		<div class="info-body">
			<div class="info-label text-right"><strong>Address</strong>: </div>
			<div class="info-value">POBLACION LAMBAYONG SULTAN KUDARAT </div>
		</div>	


		<div class="info-body">
			<div class="info-label text-right"><strong>Marital Status</strong>: </div>
			<div class="info-value">Single </div>
		</div>	

		<div class="info-body">
			<div class="info-label text-right"><strong>Gender</strong>: </div>
			<div class="info-value">Male </div>
		</div>			


	</div>



</div>


	<!-- Personal Information -->
	<div class="info-container">

		<div class="info-header text-center">
			Work Information
		</div>

		<div class="info-body">
			<div class="info-label text-right"><strong>Employee ID</strong>: </div>
			<div class="info-value">2393-3293</div>
		</div>	

		<div class="info-body">
			<div class="info-label text-right"><strong>Date hired</strong>: </div>
			<div class="info-value">November 11, 2014 </div>
		</div>	

		<div class="spacer"></div>

		<div class="info-body">
			<div class="info-label text-right"><strong>SSS ID</strong>: </div>
			<div class="info-value">2-392392932-2</div>
		</div>	

		<div class="info-body">
			<div class="info-label text-right"><strong>Philhealth ID</strong>: </div>
			<div class="info-value">2-392392932555-52</div>
		</div>	

		<div class="info-body">
			<div class="info-label text-right"><strong>HDMF ID</strong>: </div>
			<div class="info-value">2-392392932555-52</div>
		</div>	


		<div class="info-body">
			<div class="info-label text-right"><strong>TIN ID</strong>: </div>
			<div class="info-value">2-392392932555-52</div>
		</div>	

		
	</div>


</body>
</html>
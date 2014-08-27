<?php 

	$links = ['profile' => ['icon' => 'glyphicon-user',
	                        'url' => 'profile'],
	           'leaves' => ['icon' => 'glyphicon-home',
	           				'url' => 'leaves'],
	           'medical' => ['icon' => 'glyphicon-briefcase',
	           				 'url' => 'medical'],
	           'violations' => [ 'icon' => 'glyphicon-hand-down',
	                             'url' => 'violations' ],

	           'loans' => ['icon' => 'glyphicon-th-list',
	                        'url' => 'loans'],
	            'Daily Time Record' => ['icon' => 'glyphicon-th-list',
	                        'url' => 'dtr'],
	            'files' => ['icon' => 'glyphicon glyphicon-file',
	                         'url' => 'files']
 	         ];



?>

	@foreach( $links as $key => $value)
		
		@if ($v == $key)
			<a href="?v={{$value['url']}}" class="list-group-item active"> <span class="glyphicon {{ $value['icon'] }}"></span> &nbsp;  {{ ucfirst($key) }}</a>
		
		@elseif ($v == '' && $key == 'profile')
				<a href="?v=profile" class="list-group-item active"> <span class="glyphicon glyphicon-user"></span> &nbsp;  Profile</a>
		
		@else
			<a href="?v={{$value['url']}}" class="list-group-item"> <span class="glyphicon {{ $value['icon'] }}"></span> &nbsp;  {{ ucfirst($key) }}</a>
		@endif
		
	@endforeach
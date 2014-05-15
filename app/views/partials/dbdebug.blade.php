<?php

if (Input::has('__dbdebug')) {
	Event::listen('illuminate.query', function ($sql, $bindings, $times) {
			echo '<h3 class="page-header">Database Query</h3>';
				var_dump($sql);
		});
}

<?php

set_include_path(__DIR__.'/../lib'
        . PATH_SEPARATOR . $pear_path
        . PATH_SEPARATOR . get_include_path());

if (file_exists($c=dirname(__FILE__).'/../vendor/.composer/autoload.php'))
	require realpath($c);
else
	spl_autoload_register(
	    function($className) {
	        $fileParts = explode('\\', ltrim($className, '\\'));

	        if (false !== strpos(end($fileParts), '_'))
	            array_splice($fileParts, -1, 1, explode('_', current($fileParts)));

	        $file = implode(DIRECTORY_SEPARATOR, $fileParts) . '.php';

	        foreach (explode(PATH_SEPARATOR, get_include_path()) as $path) {
	            if (file_exists($path = $path . DIRECTORY_SEPARATOR . $file))
	                return require $path;
	        }
	    }
	);
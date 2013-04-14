<?php
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

// Setup autoloading
require 'init_autoloader.php';

// Set global PHP settings
date_default_timezone_set('Australia/Sydney');

// Run the application!
Zend\Mvc\Application::init(require 'config/application.config.php')->run();

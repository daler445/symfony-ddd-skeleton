<?php
use App\Kernel;

require_once dirname(__DIR__) . '/vendor/autoload_runtime.php';

global $processor;
$processor = new Monolog\Processor\UidProcessor(16);

return function (array $context) {
	return new Kernel($context['APP_ENV'], (bool)$context['APP_DEBUG']);
};

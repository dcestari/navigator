<?php

require_once __DIR__.'/../navigator/NavigatorKernel.php';

$kernel = new NavigatorKernel('dev', true);
$kernel->run();


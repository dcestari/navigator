<?php

require_once __DIR__.'/../navigator/NavigatorKernel.php';

$kernel = new NavigatorKernel('prod', false);
$kernel->run();


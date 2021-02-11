<?php
declare(strict_types=1);

require 'vendor/autoload.php';
require 'Entity.php';

$engine = Annotations\Engine\Engine::Start('Entity');

echo json_encode($engine->process());

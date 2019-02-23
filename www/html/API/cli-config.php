<?php
// cli-config.php

use Doctrine\ORM\EntityManager;
require_once "bootstrap.php";

$entityManager = $container[EntityManager::class];
return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);
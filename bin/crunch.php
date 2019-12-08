#!/usr/bin/env php
<?php

require __DIR__ . '/vendor/autoload.php';

use Crunch\Commands\CrunchPharCommand;
use Symfony\Component\Console\Application;

$application = new Application();

$application->add(new Crunch\Commands\CrunchPharCommand());

$application->run();

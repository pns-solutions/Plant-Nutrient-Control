<?php

require_once(__DIR__ . '/../assets/composer/vendor/autoload.php');
require_once(__DIR__ . '/../core/functions.php');
require_once(__DIR__ . '/../init/10_database.php');

\PNS\SolverResult::runSolver();
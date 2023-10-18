<?php

use KSamuel\OptimizeMe\Fast\Search as FastSearch;
use KSamuel\OptimizeMe\Slow\Search as SlowSearch;
use KSamuel\OptimizeMe\Writer\EchoWriter;

require_once 'vendor/autoload.php';

$fastSearch = new FastSearch;
$writer = new EchoWriter;
$slowSearch = new SlowSearch;

$t = microtime(true);
memory_reset_peak_usage();

//$slowSearch->search('data/users.txt', $writer);
// test new version
$fastSearch->search('data/users.txt', $writer);

echo PHP_EOL . 'Time: ' .
    number_format(microtime(true) - $t, 6)  . ' sec.' . PHP_EOL .
    'Memory: ' . number_format(memory_get_peak_usage() / 1024, 3) . ' kb.' .
    PHP_EOL;

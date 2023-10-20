<?php

use KSamuel\OptimizeMe\Fast\Search as FastSearch;
use KSamuel\OptimizeMe\Slow\Search as SlowSearch;

use KSamuel\OptimizeMe\Writer\MemoryWriter;
use KSamuel\OptimizeMe\Writer\NullWriter;

require_once 'vendor/autoload.php';

$fastSearch = new FastSearch;
$nullWriter = new NullWriter;
$memWriter = new MemoryWriter;
$slowSearch = new SlowSearch;

$filePath = 'data/users.txt';


//== check result=========================
$slowSearch->search($filePath, $memWriter);
$sResult = $memWriter->getBuffer();
$memWriter->flush();

$fastSearch->search($filePath, $memWriter);
$fResult = $memWriter->getBuffer();

if ($sResult != $fResult) {
    echo 'Slow and Fast results are not equal';
    exit;
}
//=========================================

//== Check Memory usage ===================
// PHP 8.2 case
if (function_exists('memory_reset_peak_usage')) {
    memory_reset_peak_usage();
    $slowSearch->search($filePath, $nullWriter);
    $slowPeak = memory_get_peak_usage();

    gc_collect_cycles();

    memory_reset_peak_usage();
    $fastSearch->search($filePath, $nullWriter);
    $fastPeak = memory_get_peak_usage();

    $slowPeak = number_format($slowPeak / 1024, 3) . ' kb';
    $fastPeak = number_format($fastPeak / 1024, 3) . ' kb';
    gc_collect_cycles();
} else {
    $slowPeak = '- (PHP >=8.2)';
    $fastPeak = '- (PHP >=8.2)';
}

//== bench =================================
$timeLimit = 1;
$slowCount = 0;
$slowTime = null;
$t = microtime(true);
for ($i = 0; $i < 10000; $i++) {
    $iStart = microtime(true);
    $slowSearch->search($filePath, $nullWriter);
    $iEnd = microtime(true);
    if ($iEnd - $t > $timeLimit) {
        break;
    }
    if ($i == 0) {
        $slowTime = $iEnd - $iStart;
    } else {
        $cTime = $iEnd - $iStart;
        if ($cTime < $slowTime) {
            $slowTime = $cTime;
        }
    }
    $slowCount++;
}

gc_collect_cycles();

$fastCount = 0;
$fastTime = null;
$t = microtime(true);
for ($i = 0; $i < 100000; $i++) {
    $iStart = microtime(true);
    $fastSearch->search($filePath, $nullWriter);
    $iEnd = microtime(true);
    if ($iEnd - $t > $timeLimit) {
        break;
    }
    if ($i == 0) {
        $fastTime = $iEnd - $iStart;
    } else {
        $cTime = $iEnd - $iStart;
        if ($cTime < $fastTime) {
            $fastTime = $cTime;
        }
    }
    $fastCount++;
}


//== format results =====
$results = [
    ['', 'Count', 'Memory', 'Best Time'],
    ['Slow', $slowCount, $slowPeak, number_format($slowTime, 6) . ' s.'],
    ['Fast', $fastCount, $fastPeak, number_format($fastTime, 6) . ' s.'],
];
$width = [10, 10, 20, 18];
echo PHP_EOL;
foreach ($results as $index => $val) {
    foreach ($val as $i => $col) {
        echo str_pad($col, $width[$i], ' ', STR_PAD_LEFT);
    }
    echo PHP_EOL;
}
echo PHP_EOL;

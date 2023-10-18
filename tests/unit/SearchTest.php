<?php

use PHPUnit\Framework\TestCase;
use KSamuel\OptimizeMe\Fast\Search as FastSearch;
use KSamuel\OptimizeMe\Slow\Search as SlowSearch;

use KSamuel\OptimizeMe\Writer\MemoryWriter;
use KSamuel\OptimizeMe\Writer\NullWriter;

class SearchTest extends TestCase
{
    public function testSearch(): void
    {
        $filePath = 'data/users.txt';

        $fastSearch = new FastSearch;
        $memWriter = new MemoryWriter;
        $slowSearch = new SlowSearch;

        $slowSearch->search($filePath, $memWriter);
        $sResult = $memWriter->getBuffer();
        $memWriter->flush();

        $fastSearch->search($filePath, $memWriter);
        $fResult = $memWriter->getBuffer();
        $this->assertEquals($sResult, $fResult);
    }
}

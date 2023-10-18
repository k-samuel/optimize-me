<?php

declare(strict_types=1);

namespace KSamuel\OptimizeMe\Fast;

use KSamuel\OptimizeMe\Slow\Search as SlowSearch;
use KSamuel\OptimizeMe\WriterInterface;

class Search extends SlowSearch
{
    public function search(string $filePath, WriterInterface $writer): void
    {
        // Create your own implementation here, replace parent::search
        parent::search($filePath, $writer);
    }
}

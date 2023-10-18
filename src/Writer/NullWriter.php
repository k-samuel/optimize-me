<?php

declare(strict_types=1);

namespace KSamuel\OptimizeMe\Writer;

use KSamuel\OptimizeMe\WriterInterface;

class NullWriter implements WriterInterface
{
    public function write(string $message): void
    {
    }
}

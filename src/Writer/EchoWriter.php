<?php

declare(strict_types=1);

namespace KSamuel\OptimizeMe\Writer;

use KSamuel\OptimizeMe\WriterInterface;

class EchoWriter implements WriterInterface
{
    public function write(string $message): void
    {
        echo $message;
    }
}

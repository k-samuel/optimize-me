<?php

declare(strict_types=1);

namespace KSamuel\OptimizeMe\Writer;

use KSamuel\OptimizeMe\WriterInterface;

class MemoryWriter implements WriterInterface
{
    private string $buffer = '';

    public function write(string $message): void
    {
        $this->buffer .= $message;
    }

    public function getBuffer(): string
    {
        return $this->buffer;
    }

    public function flush(): void
    {
        $this->buffer = '';
    }
}

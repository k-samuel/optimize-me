<?php

declare(strict_types=1);

namespace KSamuel\OptimizeMe;

interface WriterInterface
{
    public function write(string $message): void;
}

<?php

declare(strict_types=1);

namespace KSamuel\OptimizeMe;

interface SearchInterface
{
    public function search(string $filePath, WriterInterface $writer): void;
}

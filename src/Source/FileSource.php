<?php
declare(strict_types=1);

namespace App\Source;

final class FileSource implements SourceInterface
{
    private string $filepath;

    public function __construct(string $filepath)
    {
        $this->filepath = $filepath;
    }

    public function getData(): string
    {
        return file_get_contents($this->filepath);
    }
}

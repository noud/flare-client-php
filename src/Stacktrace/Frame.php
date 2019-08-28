<?php

namespace Facade\FlareClient\Stacktrace;

use SplFileObject;

class Frame
{
    /** @var string */
    private $file;

    /** @var int */
    private $lineNumber;

    /** @var string */
    private $method;

    /** @var string */
    private $class;

    public function __construct(
        string $file,
        int $lineNumber,
        string $method = null,
        string $class = null
    ) {

        $this->file = $file;

        $this->lineNumber = $lineNumber;

        $this->method = $method;

        $this->class = $class;
    }

    public function toArray(): array
    {
        $codeSnippet = (new Codesnippet())
            ->snippetLineCount(31)
            ->surroundingLine($this->lineNumber)
            ->get($this->file);

        return [
            'line_number' => $this->lineNumber,
            'method' => $this->method,
            'class' => $this->class,
            'code_snippet' => $codeSnippet,
            'file' => $this->file,
        ];
    }

    public function getFile(): string
    {
        return $this->file;
    }

    public function getLinenumber(): int
    {
        return $this->lineNumber;
    }
}


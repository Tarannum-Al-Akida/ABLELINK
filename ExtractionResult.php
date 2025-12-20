<?php

namespace App\Services\DocumentProcessing;

final class ExtractionResult
{
    /**
     * @param  list<string>  $warnings
     */
    public function __construct(
        public readonly string $text,
        public readonly array $warnings = [],
    ) {
    }
}

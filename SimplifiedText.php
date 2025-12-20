<?php

namespace App\Services\TextSimplification;

final class SimplifiedText
{
    /**
     * @param  list<string>  $bullets
     */
    public function __construct(
        public readonly string $simplifiedText,
        public readonly array $bullets,
    ) {
    }
}

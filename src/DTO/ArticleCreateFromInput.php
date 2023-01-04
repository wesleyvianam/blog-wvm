<?php

declare(strict_types=1);

namespace App\DTO;

class ArticleCreateFromInput
{
    public function __construct(
        public string $title = '',
        public string $author = '',
        public string $content = '',
    ) {  
    }
}
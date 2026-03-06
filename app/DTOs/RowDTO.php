<?php

namespace App\DTOs;



class RowDTO
{

    public array $rows = [];
    public ?string $url = null;

    /**
     * @throws \Exception
     */
    public function __construct( array $rows,?string $url = null)
    {
        $this->rows = $rows;
        $this->url = $url;
    }
}

<?php

namespace App\DTOs;

class TableDTO
{
    public array $columns = [];
    public array $rows = [];
    public ?array $total = null;


    /**
     * @throws \Exception
     */
    public function __construct(array $columns, array $rows, ?array $total = null)
    {
        $columnCount = count($columns);

        // 1. Validate Rows
        if (isset($rows[0]) && count($rows[0]) !== $columnCount) {
            throw new \Exception("Rows array count mismatch: expected {$columnCount} columns.");
        }

        // 2. Validate Total (if provided)
        if ($total !== null && count($total) !== $columnCount) {
            throw new \Exception("Total array count mismatch: expected {$columnCount} columns.");
        }

        $this->columns = $columns;
        $this->rows = $rows;
        $this->total = $total;
    }

}

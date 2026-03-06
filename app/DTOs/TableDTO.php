<?php

namespace App\DTOs;

class TableDTO
{
    /**
     * @throws \Exception
     */
    public function __construct(
        public array $columns,
        public array $rows, // Array of RowDTOs
        public array $total = []
    ) {
        $columnCount = count($this->columns);

        if (!empty($this->rows)) {
            $firstRow = $this->rows[0];

            $actualCount = ($firstRow instanceof \App\DTOs\RowDTO)
                ? count($firstRow->rows)
                : count($firstRow);

            if ($actualCount !== $columnCount) {
                throw new \Exception("Rows count mismatch: expected {$columnCount} columns, found {$actualCount}.");
            }
        }
    }

    /**
     * Converts the DTO into a plain array for Livewire compatibility.
     */
    public function toArray(): array
    {
        return [
            'columns' => $this->columns,
            'rows' => array_map(function ($row) {
                if ($row instanceof RowDTO) {
                    return [
                        'rows' => $row->rows,
                        'url' => $row->url,
                    ];
                }
                return $row;
            }, $this->rows),
            'total' => $this->total,
        ];
    }
}

<?php

namespace App\Enums;

enum Status: string
{
    case Done = 'Done';
    case Forgotten = 'Forgotten';
    case Failed = 'Failed';
    case Pending = 'Pending';

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Done => 'success',      // Green
            self::Forgotten => 'warning',  // Amber
            self::Failed => 'danger',      // Red
            self::Pending => 'gray',       // Gray
        };
    }
}

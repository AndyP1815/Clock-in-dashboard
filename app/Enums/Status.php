<?php

namespace App\Enums;

enum Status: string
{
    case Done = 'Done';
    case Forgotten = 'Forgotten';
    case Failed = 'Failed';
    case Pending = 'Pending';
}

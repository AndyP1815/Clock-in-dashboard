<?php
namespace App\Casts;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class LocalizedDatetime implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes): ?Carbon
    {
        if (!$value) return null;
        // From DB (UTC) to User/Amsterdam
        return Carbon::parse($value)->timezone(auth()->user()?->timezone ?? 'Europe/Amsterdam');
    }

    public function set($model, string $key, $value, array $attributes)
    {
        if (!$value) return null;

        // If it's already a Carbon instance from the Picker, convert to UTC
        if ($value instanceof \DateTimeInterface) {
            return Carbon::instance($value)->utc();
        }

        // If it's a string, treat it as Local/Amsterdam time and convert to UTC
        return Carbon::parse($value, auth()->user()?->timezone ?? 'Europe/Amsterdam')->utc();
    }
}

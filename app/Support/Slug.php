<?php

namespace App\Support;

use Illuminate\Support\Str;

class Slug
{
    /**
     * Generate a slug that is unique within the given model's table.
     *
     * @param  class-string<\Illuminate\Database\Eloquent\Model>  $modelClass
     */
    public static function unique(string $modelClass, string $value, ?int $ignoreId = null, string $column = 'slug'): string
    {
        $base = Str::slug($value) ?: 'item';
        $slug = $base;
        $i = 2;

        while (
            $modelClass::query()
                ->where($column, $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base.'-'.$i;
            $i++;
        }

        return $slug;
    }
}

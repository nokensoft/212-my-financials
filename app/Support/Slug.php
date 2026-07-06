<?php

namespace App\Support;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Slug
{
    /**
     * Generate a slug that is unique within the given model's table.
     *
     * @param  class-string<Model>  $modelClass
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

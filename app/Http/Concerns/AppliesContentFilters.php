<?php

namespace App\Http\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait AppliesContentFilters
{
    /**
     * Apply search (q), category, publish-date range, and A-Z / date sorting.
     *
     * @param  array<int, string>  $searchColumns
     */
    protected function applyContentFilters(Builder $query, Request $request, array $searchColumns): Builder
    {
        $term = trim((string) $request->get('q'));
        if ($term !== '') {
            $query->where(function (Builder $w) use ($term, $searchColumns) {
                foreach (array_values($searchColumns) as $i => $col) {
                    $i === 0
                        ? $w->where($col, 'like', "%{$term}%")
                        : $w->orWhere($col, 'like', "%{$term}%");
                }
            });
        }

        if ($category = $request->get('category')) {
            $query->whereHas('categories', fn (Builder $c) => $c->where('slug', $category));
        }

        if ($from = $request->get('from')) {
            $query->whereDate('published_at', '>=', $from);
        }

        if ($to = $request->get('to')) {
            $query->whereDate('published_at', '<=', $to);
        }

        match ((string) $request->get('sort', 'latest')) {
            'az' => $query->orderBy('title'),
            'za' => $query->orderByDesc('title'),
            'oldest' => $query->orderBy('published_at'),
            default => $query->orderByDesc('published_at'),
        };

        return $query;
    }
}

<?php

namespace App\Services;

use App\Models\Bug;

class BugService
{
    public static function resolve($keywords)
    {
        return Bug::whereHas('keywords', function ($q) use ($keywords) {
            Bug::formatKeywords($keywords)->explode(',')->each(
                fn($keyword) => $q->orWhere('keyword', 'like', $keyword)
            );
        })->get();
    }
}

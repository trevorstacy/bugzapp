<?php

namespace App\Http\Controllers;

use App\Models\Bug;
use Illuminate\Support\Str;
use App\Services\BugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;

class BugController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $referenceHash = Str::random(20);

        $bugs = BugService::resolve($request->keywords);

        $bug = Bug::create([
            'reference_hash' => $referenceHash,
            'description' => $request->description,
            'initial_code' => Crypt::encryptString($request->initialCode),
        ]);

        Bug::formatKeywords($request->keywords)->explode(',')->each(
            fn($keyword) => $bug->keywords()->create([
                'keyword' => $keyword,
            ])
        );

        return [
            'message' => 'success',
            'reference_hash' => $referenceHash,
            'bugs' => $bugs ?? [],
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $hash)
    {
        Bug::where('reference_hash', $hash)->update([
            'resolution' => $request->fixDescription
        ]);

        return ['message' => 'success'];
    }
}

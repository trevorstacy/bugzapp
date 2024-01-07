<?php

namespace App\Http\Controllers;

use App\Models\Bug;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;

class BugController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        dd(
            Crypt::decryptString(Bug::find(2)->initialCode)
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $referenceHash = Str::random(20);

        Bug::create([
            'reference_hash' => $referenceHash,
            'description' => $request->description,
            'initial_code' => Crypt::encryptString($request->initialCode),
            'keywords' => $request->keywords,
        ]);

        return [
            'message' => 'success',
            'reference_hash' => $referenceHash,
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

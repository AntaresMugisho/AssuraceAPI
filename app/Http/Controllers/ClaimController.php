<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Http\Requests\ClaimRequest;


class ClaimController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Claim::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClaimRequest $request)
    {
        $validated = $request->validated();

        $claim = Claim::create($validated);

        return $claim;
    }

    /**
     * Display the specified resource.
     */
    public function show(Claim $claim)
    {
        return $claim;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClaimRequest $request, Claim $claim)
    {
        $validated = $request->validated();

        $claim->update($validated);

        return $claim;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Claim $claim)
    {
        $claim->delete();

        return ["message" => "You deleted the claim of id {$claim->id}"];
    }
}

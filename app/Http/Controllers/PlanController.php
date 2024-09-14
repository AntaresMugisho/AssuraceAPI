<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Http\Requests\PlanRequest;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Plan::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlanRequest $request)
    {
        $fields = $request->validated();

        $plan = Plan::create($fields);

        return $plan;
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $plan)
    {
        return $plan;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlanRequest $request, Plan $plan)
    {
        $validated = $request->validated();

        $plan->update($validated);

        return $plan;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
        $plan->delete();

        return ["message" => "You deleted the plan of id {$plan->id}"];
    }
}

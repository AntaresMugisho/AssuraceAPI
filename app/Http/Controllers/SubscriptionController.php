<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Http\Requests\SubscriptionRequest;


class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Subscription::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubscriptionRequest $request)
    {
        $validated = $request->validate();

        $subscription = Subscription::create($validated);

        return $subscription;

    }

    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscription)
    {
        return $subscription;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubscriptionRequest $request, Subscription $subscription)
    {
        $validated = $request->validate();

        $subscription->update($validated);

        return $subscription;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription)
    {
        $subscription->delete();
        
        return ["message" => "You deleted the subscription of id {$subscription->id}"];
    }
}

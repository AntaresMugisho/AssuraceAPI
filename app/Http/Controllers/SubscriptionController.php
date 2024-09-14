<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Http\Request;
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


    public function upgrade(Request $request, $subscription)
    {
        $request->validated([
            "new_plan_id" => ["exists:plans,id"]
        ]);

        $oldPlan = $subscription->plan;
        $newPlan = Plan::find($request->new_plan_id);

        $remainingDays = $subscription->end_date->diffInDays(now());
        $totalDays = $subscription->start_date->diffInDays($subscription->end_date);

        $priceDifference = ($newPlan->price - $oldPlan->price) * $remainingDays / $totalDays;

        $subscription->update([
            "plan_id" => $newPlan->id,
            "status" => "upgraded",
            "upgrade_from" => $oldPlan->id
        ]);

        return [
            "message" => "Subscription upgraded successfully.",
            "price_difference" => $priceDifference,
            "subscription" => $subscription
        ];
    }


    public function renew(Request $request, $subscription){

        $request->validate([
            "number_of_years" => ["required", "number"],
        ]);
        
        $newEndDate = $subscription->end_data->addYears($request->number_of_years);
        $subscription->update([
            "end_date" => $newEndDate,
            "renewal_of" => $subscription->plan->id,
        ]);

        return [
            "message" => "Subscription renewed successfully.",
            "subscription" => $subscription
        ];

    }
}

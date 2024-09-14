<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Payment;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Payment::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentRequest $request)
    {
        $validated = $request->validate();

        $payment = Payment::create($validated);

        return $payment;
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        return $payment;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        $validated = $request->validate();

        $payment->update($validated);

        return $payment;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();

        return ["message" => "You deleted the payment of id {$payment->id}"];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "subscription_id" => ["string", "exists:subscriptions,id"],
            "amount" => ["number"],
            "transaction_id" => ["string"],
            "status" => ["string"],
            "payment_date" => ["date"],
        ];
    }
}

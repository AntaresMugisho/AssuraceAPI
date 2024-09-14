<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class StoreSubscriptionRequest extends FormRequest
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
            "user_id" => ["required", "string", "exists:users,id"],
            "plan_id" => ["required", "string", "exists:plans,id"],
            "start_date" => ["required", "date"],
            "payment_status" => ["string"],
        ];
    }

    public function prepareForValiation(){
        
        $startDate = $this->start_date;
        if ($startDate){
            $endDate = Carbon::parse($startDate)->addYear();
            $this->merge([
                "end_date" => $endDate->toDateString(),
            ]);

        }

    }
}

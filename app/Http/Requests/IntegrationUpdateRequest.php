<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\MarketplaceEnum as MarketplaceType;

class IntegrationUpdateRequest extends FormRequest
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
            'marketplace' => 'nullable|in:' . implode(',', array_map(fn($marketplace) => $marketplace->value, MarketplaceType::cases())),
            'username' => 'nullable|string',
            'password' => 'nullable|string',
        ];
    }
}

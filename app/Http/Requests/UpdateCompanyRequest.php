<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $company = $this->route("company");
        return $this->user()->can("update", $company);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'website' => ['nullable', 'url', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],
            'country' => ['nullable', 'string', 'max:100'],
            'postal_code' => ['nullable', 'string', 'max:20'],
            'industry' => ['nullable', 'string', 'max:100'],
            'notes' => ['nullable', 'string'],
            'user_id' => ['required', 'exists:users,id'],
            
        ];
    }

      public function messages(): array
    {
        return [
            'name.required' => 'Company name is required.',
            'email.email' => 'Please provide a valid email address.',
            'website.url' => 'Please provide a valid website URL.',
            'user_id.required' => 'Please assign this company to a user.',
            'user_id.exists' => 'The selected user does not exist.',
        ];
    }

     protected function prepareForValidation(): void
    {
        // If no user_id provided, assign to current user
        if (!$this->has('user_id')) {
            $this->merge([
                // 'user_id' => auth()->id()
            ]);
        }

        // Ensure website has http:// or https://
        if ($this->has('website') && $this->website) {
            if (!str_starts_with($this->website, 'http://') && !str_starts_with($this->website, 'https://')) {
                $this->merge([
                    'website' => 'https://' . $this->website
                ]);
            }
        }
    }
}

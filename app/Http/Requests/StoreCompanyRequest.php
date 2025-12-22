<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
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

            "name"        => ["required", "string", "max:255"],
            "email"       => ["required", "email", "max:255"],
            'phone'       => ['required', 'string', 'max:50'],
            'website'     => ['required', 'url', 'max:255'],
            'address'     => ['nullable', 'string', 'max:255'],
            'city'        => ['nullable', 'string', 'max:100'],
            'state'       => ['nullable', 'string', 'max:100'],
            'country'     => ['nullable', 'string', 'max:100'],
            'postal_code' => ['nullable', 'string', 'max:20'],
            'industry'    => ['nullable', 'string', 'max:100'],
            'notes'       => ['nullable', 'string'],
            'user_id'     => ['required', 'exists:users,id'],

        ];
    }

    public function messages():array{
        return [
            'name.required' => 'Company name is required',
            'email.email' => 'Please provide a valid email address',
            'website.url' => 'Please provide a valid website URL',
            'user_id.required' => 'Please assign this company to a user',
            'user_id.exists' => 'The selected user does not exixts',

        ];
    }

    protected function prepareForValidation(){
        if(!$this->has('user_id')){
            $this->merge([
                // 'user_id' => auth()->id()
            ]);
        }

        if ($this->has('website') && $this->website) {
            if (!str_starts_with($this->website, 'http://') && !str_starts_with($this->website, 'https://')) {
                $this->merge([
                    'website' => 'https://' . $this->website
                ]);
            }
        }
    }
}

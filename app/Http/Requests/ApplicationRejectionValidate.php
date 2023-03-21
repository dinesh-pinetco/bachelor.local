<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class ApplicationRejectionValidate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'bewerberId' => ['required', 'exists:users,id'],
            'unternehmenId' => ['required', 'exists:companies,sanna_id'],
            'ablehnung' => ['required', 'boolean'],
        ];
    }

    public function persist(User $user)
    {
        $user->companies()->updateOrCreate([
            'user_id' => $this->bewerberId,
            'company_id' => $this->unternehmenId,
        ], ['company_rejected_at' => now()]);
    }
}

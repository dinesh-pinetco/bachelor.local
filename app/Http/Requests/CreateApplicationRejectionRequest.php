<?php

namespace App\Http\Requests;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class CreateApplicationRejectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        /** @var User $user */
        $user = $this->route('user');

        return $user->companies()->whereNotNull('company_hired_at')->doesntExist();
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
            'unternehmenId' => ['required', 'exists:companies,sana_id'],
            'ablehnung' => ['required', 'boolean'],
        ];
    }

    public function persist(User $user)
    {
        $company = Company::findFromSannaId($this->unternehmenId);

        if ($this->ablehnung) {
            return $user->companies()->updateOrCreate([
                'user_id' => $this->bewerberId,
                'company_id' => $company->id,
            ], [
                'company_rejected_at' => now(),
                'company_hired_at' => null,
            ]);
        } else {
            return $user->companies()->updateOrCreate([
                'user_id' => $this->bewerberId,
                'company_id' => $company->id,
            ], ['company_hired_at' => now(), 'company_rejected_at' => null]);
        }

    }
}

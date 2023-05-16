<?php

namespace App\Http\Requests;

use App\Models\Company;
use App\Models\CompanyContacts;
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

        return true;
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
            'eingestellt_am' => ['nullable', 'date_format:Y-m-d H:i:s'],
            'betreuer_id' => ['nullable', 'exists:company_contacts,sana_id'],
        ];
    }

    public function persist(User $user)
    {
        $company = Company::findFromSannaId($this->unternehmenId);
        $companyContacts = CompanyContacts::findFromSannaId($this->betreuer_id);

        return $user->companies()->updateOrCreate([
            'user_id' => $this->bewerberId,
            'company_id' => $company->id,
        ], [
            'company_rejected_at' => $this->ablehnung ? now() : null,
            'company_hired_at' => ! $this->ablehnung ? now() : null,
            'company_contacted_at' => $this->eingestellt_am,
            'company_contact_id' => $companyContacts->id,
        ]);

    }
}

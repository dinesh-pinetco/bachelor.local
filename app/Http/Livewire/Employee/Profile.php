<?php

namespace App\Http\Livewire\Employee;

use App\Models\User;
use Livewire\Component;

class Profile extends Component
{
    public User $user;

    protected array $rules = [
        'user.first_name' => ['required', 'max:100'],
        'user.last_name' => ['required', 'max:100'],
        'user.phone' => ['required', 'numeric'],
        'user.old_password' => ['nullable', 'required_with:user.new_password', 'current_password'],
        'user.new_password' => ['required_with:user.old_password'],
        'user.confirm_password' => ['same:user.new_password'],
    ];

    public function render()
    {
        return view('livewire.employee.profile');
    }

    public function submit()
    {
        $this->validate();

        if ($this->user->new_password) {
            $this->user->forceFill([
                'password' => bcrypt($this->user->new_password),
            ]);
        }

        unset($this->user->old_password);
        unset($this->user->new_password);
        unset($this->user->confirm_password);

        $this->user->save();

        $this->toastNotify(__('Profile updated successfully!'), __('Success'), TOAST_SUCCESS);
    }
}

<?php

namespace App\Http\Livewire\Admin\Employee;

use App\Mail\EmployeeCreated;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;

class Manage extends Component
{
    public User $user;

    public string $formMode = 'create';

    protected array $rules = [
        'user.first_name' => ['required', 'max:100'],
        'user.last_name' => ['required', 'max:100'],
        'user.email' => ['required', 'unique:users,email', 'email:rfc,dns,spoof'],
        'user.phone' => ['nullable', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:9', 'max:20'],
    ];

    public function mount(User $user)
    {
        if ($user->exists) {
            $this->formMode = 'edit';
        }
        $this->user->only(['id', 'first_name', 'last_name', 'email', 'phone', 'created_at']);
    }

    public function render()
    {
        return view('livewire.admin.employee.manage');
    }

    public function submit()
    {
        $this->{$this->formMode}();
    }

    private function create()
    {
        $this->validate();
        $password = Str::random('10');
        $employee = User::create([
            'first_name' => data_get($this->user, 'first_name'),
            'last_name' => data_get($this->user, 'last_name'),
            'email' => data_get($this->user, 'email'),
            'phone' => data_get($this->user, 'phone'),
            'password' => Hash::make($password),
        ])->assignRole(ROLE_EMPLOYEE);

        Mail::to($employee)->send(new EmployeeCreated($employee, $password));

        $this->toastNotify(__('Employee created successfully!'), __('Success'), TOAST_SUCCESS);

        $this->redirectToIndex();
    }

    private function redirectToIndex(): void
    {
        redirect()->route('admin.employees.index');
    }

    private function edit()
    {
        $this->validate(array_merge($this->rules, [
            'user.email' => ['required', 'email:rfc,dns,spoof', 'unique:users,email,'.$this->user->id],
        ]));

        $this->user->save();

        $this->toastNotify(__('Employee updated successfully!'), __('Success'), TOAST_SUCCESS);

        $this->redirectToIndex();
    }
}

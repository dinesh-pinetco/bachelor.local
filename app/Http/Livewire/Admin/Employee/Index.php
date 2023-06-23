<?php

namespace App\Http\Livewire\Admin\Employee;

use App\Models\User;
use App\Traits\Livewire\HasModal;
use App\Traits\Livewire\WithDataTable;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithDataTable, HasModal;

    public $deletedUser;

    public $column = null;

    public array $columns = User::SEARCHABLE_FIELDS;

    public $listeners = ['refresh' => '$refresh'];

    public function openConfirmModal(User $user)
    {
        $this->open();
        $this->deletedUser = $user;
    }

    public function delete()
    {
        $this->deletedUser->delete();
        $this->toastNotify(__('User deleted successfully.'), __('Success'), TOAST_SUCCESS);
        $this->reset('show', 'deletedUser');
        $this->emitSelf('refresh');
    }

    public function render()
    {
        request()->merge($this->only(['sort_by', 'sort_type', 'search', 'status']));

        return view('livewire.admin.employee.index', [
            'users' => User::select(['id','first_name','last_name','email','phone','created_at'])->searchByKey($this->column, request('search'))->filter()->Role(ROLE_EMPLOYEE)->paginate($this->perPage),
        ]);
    }
}

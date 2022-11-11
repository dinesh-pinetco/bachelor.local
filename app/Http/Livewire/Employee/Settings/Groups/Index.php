<?php

namespace App\Http\Livewire\Employee\Settings\Groups;

use App\Models\Group;
use App\Traits\Livewire\HasModal;
use App\Traits\Livewire\WithDataTable;
use Livewire\Component;
use Livewire\WithPagination;
use function request;
use function view;

class Index extends Component
{
    use WithPagination, WithDataTable, HasModal;

    public $tab;

    public $deletedGroup;

    public function openConfirmModal(Group $group)
    {
        if ($group->child->count() == 0 && $group->fields->count() == 0) {
            $this->open();
            $this->deletedGroup = $group;
        } else {
            $this->toastNotify(__('Group could not be deleted because it is still in use.'), __('Error'), TOAST_ERROR);
        }
    }

    public function delete()
    {
        $this->deletedGroup->delete();
        $this->toastNotify(__('Group deleted successfully.'), __('Success'), TOAST_SUCCESS);
        $this->reset('show', 'deletedGroup');
        $this->render();
    }

    public function render()
    {
        request()->merge($this->only(['sort_by', 'sort_type', 'search', 'status']));

        return view('livewire.employee.settings.groups.index', [
            'groups' => $this->tab->groups()->filter()->with('parent')->orderBy('sort_order')->paginate($this->perPage),
        ]);
    }

    public function updateOrder($items)
    {
        foreach ($items as $item) {
            Group::find($item['value'])->update(['sort_order' => ((($this->page - 1) * $this->perPage) + $item['order'])]);
        }
    }
}

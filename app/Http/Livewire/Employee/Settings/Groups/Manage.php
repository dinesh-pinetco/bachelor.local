<?php

namespace App\Http\Livewire\Employee\Settings\Groups;

use App\Models\Group;
use App\Models\Tab;
use Illuminate\Support\Collection;
use Livewire\Component;

class Manage extends Component
{
    public Tab $tab;

    public Group $group;

    public Collection $groups;

    public string $formMode = 'create';

    protected array $rules = [
        'group.parent_id' => ['sometimes'],
        'group.internal_name' => ['required', 'max:100'],
        'group.title' => ['sometimes', 'max:100'],
        'group.description' => [],
        'group.can_add_more' => ['nullable'],
        'group.add_more_label' => ['sometimes', 'max:100'],
    ];

    /** @noinspection PhpArrayShapeAttributeCanBeAddedInspection */
    public function validationAttributes(): array
    {
        return [
            'field.is_active' => __('Status'),
        ];
    }

    public function mount(Group $group)
    {
        $this->group = $group;

        if ($group->exists) {
            $this->formMode = 'edit';
            $this->groups = $this->tab->groups()->whereNull('parent_id')->where('id', '<>', $this->group->id)->get();
        } else {
            $this->groups = $this->tab->groups()->whereNull('parent_id')->get();
        }
    }

    public function submit()
    {
        $this->{$this->formMode}();
    }

    public function render()
    {
        return view('livewire.employee.settings.groups.manage');
    }

    public function updateDescription($value)
    {
        $this->group->description = $value;
    }

    public function updated($name, $value)
    {
        if ($name == 'group.parent_id' && $value !== null) {
            $this->group->description = null;
        }
    }

    public function handleCanAddMore()
    {
        if (! $this->group->can_add_more) {
            $this->group->add_more_label = null;
        }
    }

    private function create()
    {
        $this->validate();

        $this->group->tab_id = $this->tab->id;
        $this->group->parent_id = empty($this->group->parent_id) ? null : $this->group->parent_id;
        $this->group->can_add_more = (bool) $this->group->can_add_more;
        $this->group->save();

        session()->flash('banner', __('Group created successfully!'));

        $this->redirectToIndex();
    }

    private function redirectToIndex(): void
    {
        redirect()->route('employee.settings.groups.index', ['tab' => $this->tab->slug]);
    }

    private function edit()
    {
        $this->validate(array_merge($this->rules, ['group.internal_name' => ['required', 'max:100', "unique:groups,internal_name,{$this->group->id}"]]));

        $this->group->parent_id = empty($this->group->parent_id) ? null : $this->group->parent_id;
        $this->group->can_add_more = (bool) $this->group->can_add_more;

        $this->group->save();

        session()->flash('banner', __('Group updated successfully!'));

        $this->redirectToIndex();
    }
}

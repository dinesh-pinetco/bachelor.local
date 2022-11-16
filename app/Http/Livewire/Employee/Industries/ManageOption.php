<?php

namespace App\Http\Livewire\Employee\Industries;

use App\Models\Field;
use App\Models\Option;
use App\Models\Tab;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ManageOption extends Component
{
    public Option $option;

    public $editMode;

    public function rules()
    {
        return [
            'option.key' => ['required', 'min:2', 'max:256', Rule::unique('options', 'key')->ignore($this->option->id)],
            'option.value' => ['required', 'min:2', 'max:256'],
        ];
    }

    public function mount()
    {
        $this->editMode = isset($this->option) && $this->option->exists;

        if (! $this->editMode && ! ($this->option->key)) {
            $this->option = new option();
        }
    }

    public function submit()
    {
        $this->validate();

        $this->option->field_id = Field::whereBelongsTo(Tab::where('slug', 'industries')->first())->first()->id;
        $this->option->is_active = true;

        $this->option->save();

        return to_route('employee.settings.fields.index', ['tab' => 'industries']);
    }

    public function render()
    {
        return view('livewire.employee.industries.manage-option');
    }
}

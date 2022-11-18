<?php

namespace App\Http\Livewire\Employee\Settings;

use App\Enums\FieldType;
use App\Models\Field;
use App\Models\Group;
use App\Models\Tab;
use Illuminate\Support\Collection;
use Livewire\Component;

class Manage extends Component
{
    public Tab $tab;

    public Field $field;

    public bool $wantToUseTable = false;

    public array $initialOption = ['key' => '', 'value' => ''];

    public array $options = [];

    public array $types = [];

    public Collection $groups;

    public array $multiInputTypes = ['checkbox', 'select', 'radio'];

    public bool $isEdit = true;

    public string $formMode = 'create';

    protected array $rules = [
        'field.group_id' => ['required'],
        'field.label' => ['nullable', 'unique:fields,label'],
        'field.placeholder' => ['nullable'],
        'field.key' => ['nullable'],
        'field.type' => ['required'],
        'wantToUseTable' => ['required_if:field.type,select'],
        'field.related_option_table' => ['required_if:wantToUseTable,true'],
        'field.is_required' => ['boolean'],
        'field.is_active' => ['required'],
        'options.*.key' => ['exclude_if:wantToUseTable,true', 'required_if:field.type,select,radio,checkbox'],
        'options.*.value' => ['exclude_if:wantToUseTable,true', 'required_if:field.type,select,radio,checkbox'],
    ];

    /** @noinspection PhpArrayShapeAttributeCanBeAddedInspection */
    public function validationAttributes(): array
    {
        return [
            'field.is_active' => __('Status'),
            'field.is_required' => __('Is Required'),
            'field.related_option_table' => __('Table name'),
            'options.*.key' => 'Key',
            'options.*.value' => 'Value',
        ];
    }

    /** @noinspection PhpArrayShapeAttributeCanBeAddedInspection */
    public function messages(): array
    {
        return [
            'field.related_option_table.required_if' => 'The table name field is required when want to use table is selected.',
        ];
    }

    public function mount(Tab $tab, Field $field)
    {
        $this->multiInputTypes = [FieldType::FIELD_CHECKBOX(), FieldType::FIELD_SELECT(), FieldType::FIELD_RADIO()];
        $this->wantToUseTable = (bool) $this->field->related_option_table;

        if ($field->exists) {
            if (request()->routeIs('employee.settings.fields.edit')) {
                $this->formMode = 'edit';
            } elseif (request()->routeIs('employee.settings.fields.clone')) {
                $this->formMode = 'clone';
            }
        }

        if ($this->formMode != 'create' && count($this->field->options->toArray()) > 0) {
            $this->options = $this->field->options->toArray();
        } else {
            $this->pushInitialOption();
        }

        $this->tab = $tab;
        $this->groups = Group::where('tab_id', $tab->id)->whereDoesntHave('child')->get();
        $this->types = FieldType::values();
    }

    private function pushInitialOption()
    {
        $this->options[] = $this->initialOption;
    }

    public function submit()
    {
        $this->{$this->formMode}();
    }

    public function add($i)
    {
        if (isNotEmptyValue($this->options)) {
            $this->pushInitialOption();
        } else {
            $this->toastNotify(__('Please fill existing key and value.'), __('Error'), TOAST_ERROR);
        }
    }

    public function remove($key)
    {
        unset($this->options[$key]);
        $this->options = array_values($this->options);
    }

    public function updated($propertyName)
    {
        if ($propertyName == 'field.type') {
            $this->resetForm();
        }

        if ($propertyName == 'wantToUseTable' && ! $this->wantToUseTable) {
            $this->field->related_option_table = null;
        }
    }

    private function resetForm()
    {
        $this->wantToUseTable = false;
        $this->field->related_option_table = null;
        $this->options = [];
        $this->pushInitialOption();
    }

    public function updateOptionValue($value, $key)
    {
        $this->options[$key]['value'] = $value;
    }

    private function create()
    {
        $this->field->is_required = $this->field->is_required ?? false;
        $this->validate();

        $this->field->tab_id = $this->tab->id;
        $this->field->save();
        $this->saveOptions();

        session()->flash('banner', __('Field created successfully!'));

        $this->redirectToIndex();
    }

    private function saveOptions()
    {
        if ((in_array($this->field->type, $this->multiInputTypes)) && ! $this->wantToUseTable) {
            $this->field->options()->sync($this->options);
        } else {
            $this->field->options()->sync([]);
        }
    }

    private function redirectToIndex(): void
    {
        redirect()->route('employee.settings.fields.index', ['tab' => $this->tab->slug]);
    }

    private function edit()
    {
        $this->field->is_required = $this->field->is_required ?? false;
        $this->validate(array_merge($this->rules, ['field.label' => ['nullable', "unique:fields,label,{$this->field->id}"]]));

        $this->field->save();
        $this->saveOptions();

        session()->flash('banner', __('Field updated successfully!'));

        $this->redirectToIndex();
    }

    private function clone()
    {
        $this->validate();

        $this->field->replicate()->push();

        session()->flash('banner', __('Field cloned successfully!'));

        $this->redirectToIndex();
    }

    public function render()
    {
        return view('livewire.employee.settings.manage');
    }
}

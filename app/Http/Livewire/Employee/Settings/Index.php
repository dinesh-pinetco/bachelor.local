<?php

namespace App\Http\Livewire\Employee\Settings;

use App\Models\Field;
use App\Models\FieldValue;
use App\Models\Option;
use App\Traits\Livewire\HasModal;
use App\Traits\Livewire\WithDataTable;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithDataTable, HasModal;

    public $tab;

    public $deletedField;

    public function openConfirmModal(Field $field)
    {
        if (FieldValue::where('field_id', $field->id)->exists()) {
            $this->toastNotify(__('Field could not be deleted because it is still in use.'), __('Error'), TOAST_ERROR);
        } else {
            $this->open();
            $this->deletedField = $field;
        }
    }

    public function openOptionConfirmModal(Option $option)
    {
        if (FieldValue::where('option_id', $option->id)->exists()) {
            $this->toastNotify(__('Option could not be deleted because it is still in use.'), __('Error'), TOAST_ERROR);
        } else {
            $this->open();
            $this->deletedField = $option;
        }
    }

    public function updateOrder($items)
    {
        foreach ($items as $item) {
            Field::find($item['value'])->update(['sort_order' => ((($this->page - 1) * $this->perPage) + $item['order'])]);
        }
    }

    public function delete()
    {
        $this->deletedField->delete();

        ($this->deletedField instanceof \App\Models\Option)
            ? $this->toastNotify(__('Option deleted successfully.'), __('Success'), TOAST_SUCCESS)
            : $this->toastNotify(__('Field deleted successfully.'), __('Success'), TOAST_SUCCESS);

        $this->reset('show', 'deletedField');
        $this->render();
    }

    public function render()
    {
        request()->merge($this->only(['sort_by', 'sort_type', 'search', 'status']));

        if ($this->tab->slug !== 'industries') {
            $fields = $this->tab->fields()->filter()->orderBy('sort_order')->paginate($this->perPage);
            $options = [];
        } else {
            $fields =  [];
            $options = $this->tab->fields->first()->options()->paginate($this->perPage);
        }

        return view('livewire.employee.settings.index', [
            'fields' => $fields,
            'options' => $options,
        ]);
    }
}

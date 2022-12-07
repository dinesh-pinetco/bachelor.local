<?php

namespace App\Http\Livewire\Application;

use App\Enums\ApplicationStatus;
use App\Models\Field;
use App\Models\FieldValue;
use App\Models\Group;
use App\Models\Result;
use App\Models\Tab;
use App\Models\Test;
use App\Models\UserConfiguration;
use App\Services\ProgressBar;
use App\Services\SelectionTests\Moodle;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Show extends Component
{
    public $tabId = null;

    public $applicant = null;

    public $tab;

    public $parentGroups;

    public $parentCustomGroups;

    public bool $isProfile = false;

    public bool $isEdit = false;

    public $competency_catch_up = false;

    public $competency_comment = null;

    public Field $field;

    public array $rules = [
        'competency_catch_up' => 'required|boolean',
        'competency_comment' => 'required|nullable',
    ];

    public function mount()
    {
        $this->applicant->load('configuration');
        $this->competency_catch_up = data_get($this->applicant->configuration, 'competency_catch_up', false);
        $this->competency_comment = $this->applicant->configuration?->competency_comment;

        $this->refreshData();
    }

    public function refreshData($groupId = null)
    {
        if (auth()->user()->hasRole([ROLE_ADMIN, ROLE_EMPLOYEE])) {
            $this->isEdit = true;
        } elseif (auth()->user()->hasRole(ROLE_APPLICANT)) {
            $this->isEdit = $this->applicant->application_status == ApplicationStatus::REGISTRATION_SUBMITTED;
        }

        $this->tab = Tab::activeFields($this->applicant->id)->find($this->tabId);
        $this->isProfile = str_contains($this->tab->slug, 'profile');
        $this->parentGroups = $this->tab->parent_groups;
        $this->prepareCustomizedGroups($groupId);
    }

    public function prepareCustomizedGroups($groupId = null)
    {
        $parentCustomGroups = new Collection();

        $this->parentGroups->each(function ($group, $groupKey) use ($parentCustomGroups) {
            // Field Code
            // check field value is available or not
            if ((count(array_filter(data_get($group->fields, '*.values.*.value')))) > 0) {
                $fieldsValueCount = count(data_get($group->fields, '0.values')) == 0 ? 1 : count(data_get($group->fields, '0.values'));
                for ($i = 0; $i < $fieldsValueCount; $i++) {
                    $emptyGroup = Group::with(['child', 'fields'])->find($group->id);
                    $group->fields->each(function ($field, $fieldKey) use ($emptyGroup, $i) {
                        $emptyGroup->fields->find($field->id)->setRelation('values', $field->values->slice($i, 1));
                    });
                    $parentCustomGroups->push($emptyGroup);
                }
            } // Child Group Code
            elseif ($fieldsValueCount = count(array_filter(data_get($group->child, '*.fields.*.values.*.value'))) > 0) {
                $fieldsValueCount = count(data_get($group->child, '0.fields.0.values'));
                $fieldsValueCount = $fieldsValueCount == 0 ? 1 : $fieldsValueCount;

                for ($i = 0; $i < $fieldsValueCount; $i++) {
                    $emptyGroup = Group::with(['child', 'fields'])->find($group->id);
                    $group->child->each(function ($child, $childKey) use ($emptyGroup, $i) {
                        // Field Code
                        // check field value is available or not
                        if ((count(array_filter(data_get($child->fields, '*.values.*.value')))) > 0) {
                            $child->fields->each(function ($field, $fieldKey) use ($emptyGroup, $i, $child) {
                                // dd($field->values);
                                $emptyGroup->child->find($child->id)->fields->find($field->id)->setRelation('values', $field->values->slice($i, 1));
                            });
                        }
                    });
                    $parentCustomGroups->push($emptyGroup);
                }
            } else {
                $parentCustomGroups->push($group);
            }
        });

        if ($groupId != null) {
            $group = Group::with(['child', 'fields'])->find($groupId);
            $parentCustomGroups->push($group);
        }

        if ($parentCustomGroups->count() == 0) {
            $parentCustomGroups = $this->parentGroups;
        }

        $this->parentCustomGroups = collect($parentCustomGroups->groupBy('sort_order'));
    }

    public function appendGroup($groupId)
    {
        $this->refreshData($groupId);
    }

    public function removeGroup($groupKey)
    {
        FieldValue::where('group_key', $groupKey)->delete();
        $this->resetGroupKey($groupKey);
        $this->refreshData();
    }

    public function resetGroupKey($groupKey)
    {
        $groupKey = $groupKey + 1;
        if (FieldValue::where('group_key', $groupKey)->count() > 0) {
            FieldValue::where('group_key', $groupKey)->update(['group_key' => ($groupKey - 1)]);
            $this->resetGroupKey($groupKey);
        }
    }

    public function updated($propertyName)
    {
        if ($propertyName == 'competency_comment') {
            $this->handleCompetencyCatchUp();
        }
    }

    public function handleCompetencyCatchUp()
    {
        UserConfiguration::updateOrCreate(['user_id' => $this->applicant->id], [
            'competency_catch_up' => $this->competency_catch_up,
            'competency_comment' => $this->competency_catch_up ? $this->competency_comment : null,
        ]);

        $this->toastNotify(__('Information saved successfully.'), __('Success'), TOAST_SUCCESS);
        $this->refreshData();

        $this->applicant->load('configuration');
        $this->competency_catch_up = data_get($this->applicant->configuration, 'competency_catch_up', false);
        $this->competency_comment = $this->applicant->configuration?->competency_comment;
    }

    public function submitProfileInformation()
    {
        $profileData = Field::query()
            ->required()
            ->whereIn('group_id', $this->parentGroups->pluck('id'))
            ->with(['value' => function ($query) {
                $query->where('user_id', $this->applicant->id);
            }])
            ->get();

        $rules = collect();
        $data = collect();
        $attributes = collect();

        foreach ($profileData as $key => $value) {
            $data->put($value->key, data_get($value, 'value.value'));
            if (!data_get($value, 'value.value')) {
                $rules->put("field." . $value->key, 'required');
            }
            $attributes->put('field.' . $value->key, __($value->label));
        }

        Validator::make($data->toArray(), $rules->toArray(), [], $attributes->toArray())->validate();

        $error = null;

        $profileTabProgress = (new ProgressBar($this->applicant->id))->calculateProgressByTab('profile');

        if ($profileTabProgress < PER_STEP_PROGRESS && $this->applicant->application_status == ApplicationStatus::REGISTRATION_SUBMITTED) {
            $error = __('Please fill the required field.');
        }

        if (is_null($error) && $this->applicant->application_status == ApplicationStatus::REGISTRATION_SUBMITTED) {
            $tests = Test::whereHas('courses', function ($query) {
                $query->whereIn('course_id', $this->applicant->courses->pluck('course_id'));
            })->get();

            foreach ($tests as $test) {
                if ($test->type == Test::TYPE_MOODLE) {
                    $error = (new Moodle($this->applicant))->createUser();
                } elseif ($test->type == Test::TYPE_CUBIA) {
                    $this->applicant->saveCubiaId();
                    $this->createInitialResult($test->id);
                } elseif ($test->type == Test::TYPE_METEOR) {
                    $this->applicant->saveMeteorId();
                    $this->createInitialResult($test->id);
                }
            }

            $this->applicant->application_status = ApplicationStatus::PROFILE_INFORMATION_COMPLETED;
            $this->applicant->save();

            return redirect()->route('selection-test.index');
        }

        if ($error) {
            $this->toastNotify($error, __('Error'), TOAST_ERROR);
            $this->refreshData();
        }
    }

    public function createInitialResult($testId)
    {
        Result::updateOrCreate(
            ['user_id' => $this->applicant->id, 'test_id' => $testId],
            ['status' => Result::STATUS_NOT_STARTED]
        );
    }

    public function render()
    {
        $this->refreshData();
        return view('livewire.application.show');
    }
}

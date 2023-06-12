<div class="bg-gray-100 text-gray-900 leading-normal">
    <div
        class="py-8 pt-4 bg-white" {{-- x-data="window.__controller.dataTableMainController()" x-init="setCallback();" --}}>

        <div
            class="flex flex-wrap justify-end md:-mx-1 xl:-mx-2 -my-1">
            <div class="w-full sm:w-1/2 xl:w-1/4 md:px-1 xl:px-2 py-1 order-3 xl:order-1">
                <div
                    class="flex items-center space-x-2 form-inline">
                    <x-jet-label class="flex-shrink-0 -mb-0.5" value="{{ __('Per Page') }} :"></x-jet-label>
                    <x-livewire-select data-cy="per-page" model="perPage" class="form-control">
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="25">25</option>
                    </x-livewire-select>
                </div>
            </div>
                @if ($columns)

                <div class="w-full sm:w-1/2 xl:w-1/4 md:px-1 xl:px-2 py-1 order-4 xl:order-2">
                    <x-livewire-select data-cy="datatable-column" class="" id="column" name="column"
                                       model="column">
                        <option value="">{{ __('Please select') }}</option>
                        @foreach ($columns as $value)
                            @if ($value == 'user')
                                <option value="{{ $value }}">{{ __('Editor') }}</option>
                            @elseif ($value == 'owner')
                                <option value="{{ $value }}">{{ __('Subject') }}</option>
                            @else
                                <option value="{{ $value }}">
                                    {{ __(ucfirst(str_replace('_', ' ', $value))) }}
                                </option>
                            @endif
                        @endforeach
                    </x-livewire-select>
                </div>
            @endif
            @if(isset($this->desiredBeginnings))
                <div class="w-full sm:w-1/2 xl:w-1/4 md:px-1 xl:px-2 py-1 order-4 xl:order-2">
                    <x-livewire-select data-cy="datatable-column" class="" id="column" name="column"
                                       model="desiredBeginning">
                        <option value="">{{ __('Select desired beginning') }}</option>
                        @foreach ($this->desiredBeginnings as $beginning)
                            <option
                                value="{{ $beginning->course_start_date }}">{{ $beginning->course_start_date->translatedFormat('F Y') }}</option>
                        @endforeach
                    </x-livewire-select>
                </div>
            @endif
            @if(isset($this->courseOptions))
                <div class="w-full sm:w-1/2 xl:w-1/4 md:px-1 xl:px-2 py-1 order-4 xl:order-2">
                    <x-multi-select
                        key="courses"
                        wire:model="courses"
                        :placeholder="__('Select courses')"
                        :options="$this->courseOptions"
                        keyBy="id"
                        labelBy="name"
                        :value="$this->courses"
                    />
                </div>
            @endif
            @isset($this->statuses)
                <div class="w-full sm:w-1/2 xl:w-1/4 md:px-1 xl:px-2 py-1 order-2 xl:order-3">
                    <x-multi-select
                        key="statusMultiSelect"
                        wire:model="selectedStatuses"
                        :placeholder="__('Select Status')"
                        :options="$this->statuses"
                        keyBy="id"
                        labelBy="label"
                        :value="$this->selectedStatuses"
                    />
                </div>
            @endisset
            @isset($this->applicantsTableFields)
                <div class="w-full sm:w-1/2 xl:w-1/4 md:px-1 xl:px-2 py-1 order-2 xl:order-3">
                    <x-multi-select
                        key="fieldMultiSelect"
                        wire:model="authPreferencesFields"
                        :placeholder="__('Field dynamic')"
                        :options="$this->applicantsTableFields"
                        keyBy="key"
                        labelBy="label"
                    />
                </div>
            @endisset

            <div
                class="w-full sm:w-1/2 xl:w-1/4 md:px-1 xl:px-2 py-1 order-5 xl:order-4 {{ Route::is('employee') || Route::is('employee.applicants*') ? 'xl:mt-0' : 'lg:mt-0' }}">
                <x-jet-input data-cy="table-search" wire:model="search" class="w-full form-control" type="text"
                             placeholder="{{ __('Search') }}..."></x-jet-input>
            </div>

            <div data-cy="table-action" class="w-auto px-2 py-1 flex flex-shrink-0 justify-start order-last !mb-0">
                {{ $tableAction }}
            </div>
        </div>

        <div class="overflow-x-auto mt-4">
            <div class="table-responsive">
                <table class="min-w-full divide-y divide-cool" id="dataTable">
                    <thead>
                    {{ $head }}
                    </thead>
                    <tbody wire:sortable="updateOrder">
                    {{ $body }}
                    </tbody>
                </table>
            </div>
        </div>

        <div id="table_pagination" class="pt-3">
            {{ $model->onEachSide(1)->links() }}
        </div>
    </div>
</div>
<style>
    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 10px;
    }

    table th {
        background-color: #fff;
        color: #003A79;
    }

    table td {
        background-color: #fff;
        flex-grow:1;
    }

    table td,
    table th {
        border-top: 1px solid #C6C7C8;
        border-bottom: 1px solid #C6C7C8;
        padding: 10px 20px;
    }

    table td:first-child,
    table th:first-child {
        border-left: 1px solid #C6C7C8;
        border-top-left-radius: 2px;
        border-bottom-left-radius: 2px;
    }

    table td:last-child,
    table th:last-child {
        border-right: 1px solid #C6C7C8;
        border-top-right-radius: 2px;
        border-bottom-right-radius: 2px;
    }

</style>

<div>
    <div>
        <x-setting-tabs />
    </div>
    @if ($tab->slug === 'industries')
        <x-data-table.table :model="$options" :columns="[]">
            <x-slot name="tableAction">
                <x-link-button href="{{ route('employee.options.create') }}"
                    class="flex items-center mb-4 xl:mb-0 -mt-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current mr-2 text-white h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg> {{ __('Create Industry Option') }}
                </x-link-button>
            </x-slot>

            <x-slot name="head">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-darkgray tracking-wider w-10"></th>
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-darkgray tracking-wider">
                        key
                    </th>

                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-darkgray tracking-wider">
                        value
                    </th>

                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-darkgray tracking-wider text-right">
                        {{ __('Action') }}
                    </th>
                </tr>
            </x-slot>
            <x-slot name="body">
                @forelse ($options as $option)
                    <tr wire:sortable.item="{{ $option->id }}" wire:key="option-{{ $option->id }}">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-primary cursor-pointer" wire:sortable.handle>
                            <svg class="stroke-current h-6 w-6 text-primary" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path
                                    d="M512 256c0 6.797-2.891 13.28-7.938 17.84l-80 72C419.6 349.9 413.8 352 408 352c-3.312 0-6.625-.6875-9.766-2.078C389.6 346.1 384 337.5 384 328v-48h-104V384l47.1 .0026c9.484 0 18.06 5.578 21.92 14.23s2.25 18.78-4.078 25.83l-72 80C269.3 509.1 262.8 512 255.1 512s-13.28-2.89-17.84-7.937l-71.1-80c-6.328-7.047-7.938-17.17-4.078-25.83s12.44-14.23 21.92-14.23L232 384V280H128v48c0 9.484-5.578 18.06-14.23 21.92C110.6 351.3 107.3 352 104 352c-5.812 0-11.56-2.109-16.06-6.156l-80-72C2.891 269.3 0 262.8 0 256s2.891-13.28 7.938-17.84l80-72C95 159.8 105.1 158.3 113.8 162.1C122.4 165.9 128 174.5 128 184v48h104V128L183.1 128c-9.484 0-18.06-5.578-21.92-14.23S159.8 94.99 166.2 87.94l71.1-80c9.125-10.09 26.56-10.09 35.69 0l72 80c6.328 7.047 7.938 17.17 4.078 25.83s-12.44 14.23-21.92 14.23L280 128v104H384v-48c0-9.484 5.578-18.06 14.23-21.92c8.656-3.812 18.77-2.266 25.83 4.078l80 72C509.1 242.7 512 249.2 512 256z" />
                            </svg>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">{{ $option->key }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">{{ $option->value }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                            <a role="button" class="text-darkgray hover:text-gray inline-block cursor-pointer"
                                href="{{ route('employee.options.edit', ['option' => $option]) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <a role="button" class="text-darkgray hover:text-primary inline-block cursor-pointer"
                                href="{{ route('employee.options.clone', ['option' => $option]) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                                </svg>
                            </a>
                            <a role="button" class="text-darkgray hover:text-lightred inline-block cursor-pointer"
                                wire:click="openOptionConfirmModal({{ $option->id }})" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr class="no-data-found">
                        <td colspan="11">
                            <div class="space-y-2">
                                <div class="text-4xl text-center text-gray">
                                    <i class="fal fa-user-slash"></i>
                                </div>
                                <div class="text-xs text-center text-gray lg:text-base">
                                    {{ __('No Data Found') }}
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </x-slot>
        </x-data-table.table>
    @else
        <x-data-table.table :model="$fields" :columns="[]">
            <x-slot name="tableAction">
                <x-link-button href="{{ route('employee.settings.fields.create', ['tab' => $tab->slug]) }}"
                    class="flex items-center mb-4 xl:mb-0 -mt-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current mr-2 text-white h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg> {{ __(':tab_name create field', ['tab_name' => $tab->name]) }}
                </x-link-button>
            </x-slot>

            <x-slot name="head">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-darkgray tracking-wider w-10"></th>
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-darkgray tracking-wider">
                        <a wire:click="sort('label')" role="button" href="#">
                            {{ __('Label') }}
                            @include('components.data-table.sort-icon', [
                                'field' => 'label',
                            ])
                        </a>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-darkgray tracking-wider">
                        <a wire:click="sort('type')" role="button" href="#">
                            {{ __('Type') }}
                            @include('components.data-table.sort-icon', [
                                'field' => 'type',
                            ])
                        </a>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-darkgray tracking-wider">
                        <a wire:click="sort('sort_order')" role="button" href="#">
                            {{ __('Sort Order') }}
                            @include('components.data-table.sort-icon', [
                                'field' => 'sort_order',
                            ])
                        </a>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-darkgray tracking-wider text-right">
                        {{ __('Action') }}
                    </th>
                </tr>
            </x-slot>
            <x-slot name="body">
                @forelse ($fields as $field)
                    <tr wire:sortable.item="{{ $field->id }}" wire:key="field-{{ $field->id }}">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-primary cursor-pointer" wire:sortable.handle>
                            <svg class="stroke-current h-6 w-6 text-primary" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path
                                    d="M512 256c0 6.797-2.891 13.28-7.938 17.84l-80 72C419.6 349.9 413.8 352 408 352c-3.312 0-6.625-.6875-9.766-2.078C389.6 346.1 384 337.5 384 328v-48h-104V384l47.1 .0026c9.484 0 18.06 5.578 21.92 14.23s2.25 18.78-4.078 25.83l-72 80C269.3 509.1 262.8 512 255.1 512s-13.28-2.89-17.84-7.937l-71.1-80c-6.328-7.047-7.938-17.17-4.078-25.83s12.44-14.23 21.92-14.23L232 384V280H128v48c0 9.484-5.578 18.06-14.23 21.92C110.6 351.3 107.3 352 104 352c-5.812 0-11.56-2.109-16.06-6.156l-80-72C2.891 269.3 0 262.8 0 256s2.891-13.28 7.938-17.84l80-72C95 159.8 105.1 158.3 113.8 162.1C122.4 165.9 128 174.5 128 184v48h104V128L183.1 128c-9.484 0-18.06-5.578-21.92-14.23S159.8 94.99 166.2 87.94l71.1-80c9.125-10.09 26.56-10.09 35.69 0l72 80c6.328 7.047 7.938 17.17 4.078 25.83s-12.44 14.23-21.92 14.23L280 128v104H384v-48c0-9.484 5.578-18.06 14.23-21.92c8.656-3.812 18.77-2.266 25.83 4.078l80 72C509.1 242.7 512 249.2 512 256z" />
                            </svg>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">{{ $field->label }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">{{ $field->type }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">{{ $field->sort_order }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                            <a role="button" class="text-darkgray hover:text-gray inline-block cursor-pointer"
                                href="{{ route('employee.settings.fields.edit', ['tab' => $tab->slug, 'field' => $field]) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <a role="button" class="text-darkgray hover:text-primary inline-block cursor-pointer"
                                href="{{ route('employee.settings.fields.clone', [$tab->slug, 'field' => $field]) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                                </svg>
                            </a>
                            <a role="button" class="text-darkgray hover:text-lightred inline-block cursor-pointer"
                                wire:click="openConfirmModal({{ $field->id }})" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr class="no-data-found">
                        <td colspan="11">
                            <div class="space-y-2">
                                <div class="text-4xl text-center text-gray">
                                    <i class="fal fa-user-slash"></i>
                                </div>
                                <div class="text-xs text-center text-gray lg:text-base">
                                    {{ __('No Data Found') }}
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </x-slot>
        </x-data-table.table>
    @endif

    <x-custom-modal wire:model="show">
        <x-slot name="title">
            @if ($deletedField instanceof App\Models\Option)
                {{ __('Delete Option') }}
            @else
                {{ __('Delete Field') }}
            @endif

        </x-slot>
        <div>
            <div class="space-y-3">
                <p class="text-center text-red flex justify-center">
                    <svg class="h-12 w-12 stroke-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 512 512">
                        <path
                            d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464zM256 304c13.25 0 24-10.75 24-24v-128C280 138.8 269.3 128 256 128S232 138.8 232 152v128C232 293.3 242.8 304 256 304zM256 337.1c-17.36 0-31.44 14.08-31.44 31.44C224.6 385.9 238.6 400 256 400s31.44-14.08 31.44-31.44C287.4 351.2 273.4 337.1 256 337.1z" />
                    </svg>
                </p>
                <h4 class="text-center text-darkgray text-sm sm:text-base">
                    @if ($deletedField instanceof App\Models\Option)
                        {{ __('Are you sure you want to remove this option') }}?
                    @else
                        {{ __('Are you sure you want to remove this field') }}?
                    @endif
                </h4>
            </div>
        </div>
        <x-jet-input-error for="client" class="mt-1" />
        <x-slot name="footer">
            <div class="flex justify-end space-x-2" x-data="{ buttonDisabled: false }">
                <x-danger-button wire:click='delete' x-on:click="buttonDisabled = true" x-bind:disabled="buttonDisabled"> {{ __('Yes, Delete it') }} </x-danger-button>
                <x-secondary-button wire:click="$set('show', false)"> {{ __('Cancel') }} </x-secondary-button>
            </div>
        </x-slot>
    </x-custom-modal>
</div>

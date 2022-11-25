<div>
    <div>
        <x-log-tabs />
    </div>
    <x-data-table.table :model="$audits" :columns="$columns">
        <x-slot name="tableAction"></x-slot>

        <x-slot name="head">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-darkgray tracking-wider">
                    <a wire:click="sort('created_at')" role="button" href="javascript:void(0)">
                        {{ __('Date') }}
                        @include('components.data-table.sort-icon', [
                            'field' => 'created_at',
                        ])
                    </a>
                </th>
                <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-darkgray tracking-wider">
                    <a wire:click="sort('user_id')" role="button" href="javascript:void(0)">
                        {{ __('Subject') }}
                        @include('components.data-table.sort-icon', [
                            'field' => 'user_id',
                        ])
                    </a>
                </th>
                <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-darkgray tracking-wider">
                    <a wire:click="sort('event')" role="button" href="javascript:void(0)">
                        {{ __('Action') }}
                        @include('components.data-table.sort-icon', [
                            'field' => 'event',
                        ])
                    </a>
                </th>
                <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-darkgray tracking-wider">
                    {{ __('Tab') }} </th>
                <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-darkgray tracking-wider">
                    <a wire:click="sort('user_id')" role="button" href="javascript:void(0)">
                        {{ __('Editor') }}
                        @include('components.data-table.sort-icon', [
                            'field' => 'user_id',
                        ])
                    </a>
                </th>
                <th scope="col"
                    class="px-6 py-3 text-left text-sm font-medium text-darkgray tracking-wider flex flex-col items-center">
                    {{ __('View') }} </th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @forelse ($audits as $audit)
                <tr wire:key="field-{{ $audit->id }}">
                    {{-- @dd($audit->old_values); --}}
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">
                        {{ $audit->created_at->format('d.m.Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">
                        {{ $audit->owner ? $audit->owner->label : '' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">{{ $audit->event }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">
                        {{ $audit->owner->tab?->name??null; }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">
                        {{ $audit->user ? $audit->user->fullName : '' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-primary flex flex-col items-center">
                        <a role="button" class="text-darkgray hover:text-primary inline-flex cursor-pointer"
                            wire:click="openConfirmModal({{ $audit->id }})" href="#">
                            <svg class="stroke-current h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
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
    <x-jet-modal wire:model="show">
        <x-slot name="title">
            {{ __('Show Log') }}
        </x-slot>
        <div class="p-4 overflow-y-auto">
            <div class="max-h-96">
                @if ($selectedAudit)
                    <div class="flex text-left text-base font-medium text-black">
                        <h4 class="w-1/2 p-2">@lang('Old')</h4>
                        <h4 class="w-1/2 p-2">@lang('new')</h4>
                    </div>
                    @foreach ($selectedAuditKey as $key)
                        @if ((isset($selectedAudit->old_values[$key]) && !is_null($selectedAudit->old_values[$key])) || (isset($selectedAudit->new_values[$key]) && !is_null($selectedAudit->new_values[$key])))
                            <div class="flex border-t border-gray text-sm">
                                <div class="w-1/2 px-2 py-3">
                                    @isset($selectedAudit->old_values[$key])
                                        <p class="text-darkgray">{!! str_replace('_', ' ', $key) !!}:</p>
                                        <p class="text-primary break-all">{{ $selectedAudit->old_values[$key] }}</p>
                                    @endisset
                                </div>
                                <div class="w-1/2 px-2 py-3">
                                    @isset($selectedAudit->new_values[$key])
                                        <p class="text-darkgray">{!! str_replace('_', ' ', $key) !!}:</p>
                                        <p class="text-primary break-all">{{ $selectedAudit->new_values[$key] }}</p>
                                    @endisset
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
        <x-jet-input-error for="client" class="mt-1" />
    </x-jet-modal>
</div>

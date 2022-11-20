<div>
    <x-primary-button type="button" wire:click="submitProfileInformation" wire:loading.attr="disabled">
        {{ __('Apply directly to selected company') }}
    </x-primary-button>

    <x-primary-button type="button" wire:click="submitProfileInformation" wire:loading.attr="disabled">
        {{ __('Show my profile directly on marketplace') }}
    </x-primary-button>
</div>

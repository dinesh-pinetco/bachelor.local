@props(['submit'])


<div>
    <form wire:submit.prevent="{{ $submit }}">
        <div class="{{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
            <div class="">
                {{ $form }}
            </div>

            <div class="">
                {{ $actions }}
            </div>
        </div>
    </form>
</div>

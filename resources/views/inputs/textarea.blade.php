<div x-data="{
        content: '',
        limit: $el.dataset.limit,
        get remaining() {
            return this.limit - this.content.length
        }
    }"
    data-limit="1000"
>
    <textarea
        wire:model.lazy="fieldValue"
        {{ $isEdit ? '' : 'disabled' }}
        class="w-full text-sm md:text-base border border-gray focus:border-primary-light ring-4 ring-transparent focus:ring-4 focus:ring-primary focus:ring-opacity-20 outline-none rounded-sm focus:shadow-sm text-gray placeholder-gray shadow-sm {{ $isEdit ? 'text-primary' : 'text-gray cursor-not-allowed' }}"
        placeholder="{{ $field->placeholder }}"
        rows="8"
        x-model="content"
        maxlength="1000"
        required="{{ $field->required() }}">
    </textarea>
    <p id="remaining">
        {{__('You have')}} <span x-text="remaining"></span> {{__('characters remaining.')}}
    </p>
</div>

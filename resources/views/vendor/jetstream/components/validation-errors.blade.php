@if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-medium text-red">{{ __('Something has gone wrong!') }}</div>

        <ul class="mt-3 list-disc list-inside text-sm text-red">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

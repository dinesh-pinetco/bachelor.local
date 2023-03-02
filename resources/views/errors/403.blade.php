@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')

@section('message', __($exception->getMessage() ?: 'Forbidden'))
@section('action')
  <div class="flex-shrink-0 flex items-center justify-center space-x-4">
        <x-link-button class="text-red-600" href="{{ route('dashboard') }}" class="!px-8"
        >
            <span>{{ __('Go to Dashboard') }}</span>
        </x-link-button>
    </div>
@endsection

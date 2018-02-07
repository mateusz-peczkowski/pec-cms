@extends('pec-cms::layouts.app')

@section('title', ' - ' . __('pec-cms::views.password_reset.title'))

@section('content')
    <div class="fullscreen--wrapper | d-flex flex-row-reverse">
        <auto-background></auto-background>

        <div class="auth-component | d-flex align-items-center text-center">
            <div class="col-sm-12 px-sm-5 py-4">
                <h1>{{ __('pec-cms::views.password_reset.form') }}</h1>

                <p>{{ __('pec-cms::views.password_reset.sended') }}</p>

                <p>{{ __('pec-cms::views.password_reset.reminder_text') }}<br /><a href="{{ route('pec-cms.login') }}">{{ __('Login') }}</a></p>
            </div>
        </div>
    </div>
@endsection

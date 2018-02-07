@extends('pec-cms::layouts.app')

@section('title', ' - ' . __('pec-cms::views.password_reset.title'))

@section('content')
    <div class="fullscreen--wrapper | d-flex flex-row-reverse">
        <auto-background></auto-background>

        <div class="auth-component | d-flex align-items-center text-center">
            <div class="col-sm-12 px-sm-5 py-4">
                <h1>{{ __('pec-cms::views.password_reset.form') }}</h1>

                <auth-form inline-template>
                    <form action="{{ route('pec-cms.password.reset') }}" v-on:submit.prevent="submit" method="POST" class="mt-4 text-left">
                        {{ csrf_field() }}

                        <div class="alert alert-danger" v-if="errorsTable">{{ __('pec-cms::common.wrong_credentials') }}</div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="email">{{ __('pec-cms::common.email') }}</label>
                                    <input id="email" v-model="email" name="email" type="email" class="form-control" required>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <div class="row | mt-3 text-center">
                            <div class="col">
                                <div class="form-group clearfix">
                                    <button type="submit" class="btn btn-primary" :disabled="bussy">
                                        <div v-if="!bussy">
                                            {{ __('pec-cms::common.button.reset_password') }}
                                        </div>
                                        <div v-else>
                                            <i class="fa fa-spinner fa-spin"></i> {{ __('pec-cms::common.please_wait') }}
                                        </div>
                                    </button>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <div class="mt-4 row">
                            <div class="col">
                                <div class="form-group text-center">
                                    <p>{{ __('pec-cms::views.password_reset.reminder_text') }}<br /><a href="{{ route('pec-cms.login') }}">{{ __('Login') }}</a></p>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->
                    </form>
                </auth-form>
            </div>
        </div>
    </div>
@endsection

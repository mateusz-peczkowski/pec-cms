<h1>{{ __('pec-cms::emails.reset_password.title') }}</h1>

<p>{{ __('pec-cms::emails.reset_password.body') }}</p>
<p><a href="{{ route('pec-cms.password.token', $token) }}">{{ __('pec-cms::emails.reset_password.link') }}</a></p>
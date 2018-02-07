<h1>{{ __('pec-cms::emails.user_created.title') }}</h1>

<p>{{ __('pec-cms::emails.user_created.body') }}</p>

<p><strong>{{ __('pec-cms::common.login') }}:</strong> {{ $login }}</p>
<p><strong>{{ __('pec-cms::common.password') }}:</strong> {{ $password }}</p>

<p><a href="{{ route('pec-cms.login') }}">{{ __('pec-cms::emails.user_created.link') }}</a></p>
<x-auth-layout>

    <x-slot name="header">
        Verify Email
    </x-slot>

    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <div class="login-brand">
                    <img src="{{ admin_asset('img/stisla-fill.svg') }}" alt="logo" width="100" class="shadow-light rounded-circle">
                </div>

                <div class="card card-primary p-4">
                    <div class="card-header"><h4>Verify Email</h4></div>

                    <div class="mb-3 text-muted text-justify">
                        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                    </div>

                    @if (session('status') == 'verification-link-sent')
                        <div class="alert alert-success" role="alert">
                            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                        </div>
                    @endif

                    <div class="mt-4 d-flex justify-content-between">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <div>
                                <button type="submit" class="btn btn-primary">{{ __('Resend Verification Email') }}</button>
                            </div>
                        </form>

                        <form method="POST" action="/logout">
                            @csrf

                            <button type="submit" class="btn btn-link">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-auth-layout>

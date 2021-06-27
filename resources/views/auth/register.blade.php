<x-auth-layout>

    <x-slot name="header">
        Register
    </x-slot>

    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <div class="login-brand">
                    <img src="{{ admin_asset('img/stisla-fill.svg') }}" alt="logo" width="100" class="shadow-light rounded-circle">
                </div>

                <div class="card card-primary">
                    <div class="card-header"><h4>Register</h4></div>
                    <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger text-sm p-2" role="alert">
                                <div class="font-weight-bold">{{ __('Whoops! Something went wrong.') }}</div>

                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('register') }}" method="post">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" class="form-control"
                                       placeholder="Full name" name="name" value="{{ old('name') }}">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="input-group mb-3">
                                <input type="email" class="form-control"
                                       placeholder="Email" name="email" value="{{ old('email') }}">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="input-group mb-3">
                                <input type="password"
                                       class="form-control"
                                       placeholder="Password" name="password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" placeholder="Retype password"
                                       name="password_confirmation">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                    <div class="col-8">
                                        <div class="icheck-primary">
                                            <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                            <label for="agreeTerms">
                                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'">'.__('Terms of Service').'</a>',
                                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'">'.__('Privacy Policy').'</a>',
                                                    ]) !!}
                                            </label>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                    Register
                                </button>
                            </div>
                        </form>
                        <div class="mt-5 text-muted text-center">
                            <a href="{{ route('login') }}">I already have a membership</a>
                        </div>
                    </div>
                    <!-- /.form-box -->
                </div><!-- /.card -->
                <div class="simple-footer">
                    Copyright &copy; {{ config('app.name', 'Laravel') }} {{ date('Y') }}
                </div>
            </div>
        </div>
    </div>

</x-auth-layout>

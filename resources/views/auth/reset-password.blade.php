<x-auth-layout>

    <x-slot name="header">
        Reset Your Password
    </x-slot>

    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <div class="login-brand">
                    <img src="{{ asset('assets/img/stisla-fill.svg') }}" alt="logo" width="100" class="shadow-light rounded-circle">
                </div>

                <div class="card card-primary">
                    <div class="card-header"><h4>Login</h4></div>

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

                        @if (session('status'))
                            <div class="alert alert-success mb-3 rounded-0" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="/reset-password" method="post">
                            @csrf
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control" name="email" tabindex="1" autofocus value="{{ old('email', $request->email) }}">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password" class="control-label">Password</label>
                                <input id="password" type="password" class="form-control" name="password" tabindex="2">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password" class="control-label">Confirm Password</label>
                                <input id="password" type="password" class="form-control" name="password_confirmation" tabindex="2">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                    Change password
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
                @if (Route::has('register'))
                    <div class="mt-5 text-muted text-center">
                        Don't have an account? <a href="{{ route('register') }}">Create One</a>
                    </div>
                @endif
                <div class="simple-footer">
                    Copyright &copy; {{ config('app.name', 'Laravel') }} {{ date('Y') }}
                </div>
            </div>
        </div>
    </div>

</x-auth-layout>

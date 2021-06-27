<x-admin-layout>

    <x-slot name="header">
        {{ auth()->user()->name }}
    </x-slot>

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ auth()->user()->name }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="section-header-button">
                        <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Geri dön</a>
                    </div>
                </div>
            </div>

            <div class="section-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div>
                    @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                        @livewire('profile.update-profile-information-form')

                        <x-jet-section-border />
                    @endif

                    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                        @livewire('profile.update-password-form')

                        <x-jet-section-border />
                    @endif

                    @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                        @livewire('profile.two-factor-authentication-form')

                        <x-jet-section-border />
                    @endif

                    @livewire('profile.logout-other-browser-sessions-form')

                    @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                        <x-jet-section-border />

                        @livewire('profile.delete-user-form')
                    @endif
                </div>
            </div>
        </section>
    </div>

</x-admin-layout>

<x-admin-layout>

    <x-slot name="header">
        Kullanıcı Listesi
    </x-slot>

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Kullanıcı Listesi</h1>
                <div class="section-header-breadcrumb">
                    @if(permission_check('users', 'create'))
                        <div class="section-header-button">
                            <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Kullanıcı Ekle</a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    @include('admin.includes.alert')
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body table-responsive p-0">
                                @livewire('admin.user-table')
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

</x-admin-layout>

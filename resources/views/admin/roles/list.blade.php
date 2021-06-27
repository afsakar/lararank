<x-admin-layout>

    <x-slot name="header">
        Roller ve Yetkiler
    </x-slot>

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Rol ve Yetki Listesi</h1>
                <div class="section-header-breadcrumb">
                    @if(permission_check('roles', 'create'))
                        <div class="section-header-button">
                            <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Rol Ekle</a>
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
                                @livewire('admin.role-table')
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

</x-admin-layout>

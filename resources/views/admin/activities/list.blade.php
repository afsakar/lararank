<x-admin-layout>

    <x-slot name="header">
        Activity Logs
    </x-slot>

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Activity Logs</h1>
                <div class="section-header-breadcrumb">
                    @if(\Spatie\Activitylog\Models\Activity::all()->count() > 0)
                        @if(permission_check('activities', 'delete'))
                            <a href="#" data-url="{{ route('activities.deleteAll') }}" class="btn btn-icon btn-danger delete-confirm text-white"><i class="fa fa-trash"></i> Tümünü Sil</a>
                        @endif
                    @endif
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                @livewire('admin.activity-table')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

</x-admin-layout>

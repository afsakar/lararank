<x-admin-layout>

    <x-slot name="header">
        Events History
    </x-slot>

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Events History</h1>
                <div class="section-header-breadcrumb">
                    <div class="btn-group">
                        @if($current_file)
                            <a class="btn btn-success" href="?dl={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
                                <span class="fa fa-download"></span> Download file
                            </a>
                            @if(permission_check('logs', 'delete'))

                                <a class="btn btn-secondary delete-confirm" href="#" id="clean-log" data-url="?clean={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
                                    <span class="fa fa-sync"></span> Clean file
                                </a>
                                <a class="btn btn-danger delete-confirm" id="delete-log" href="#" data-url="?del={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
                                    <span class="fa fa-trash"></span> Delete file
                                </a>
                                @if(count($files) > 1)
                                    <a class="btn btn-danger delete-confirm" id="delete-all-log" href="#" data-url="?delall=true{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
                                        <span class="fa fa-trash-alt"></span> Delete all files
                                    </a>
                                @endif
                            @endif
                        @endif
                    </div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    @if($folders || $files)
                    <div class="col-md-2">
                        <div class="list-group div-scroll">
                            <h5>Folder List</h5>
                            @foreach($folders as $folder)
                                <div class="list-group-item">
                                    <a href="?f={{ \Illuminate\Support\Facades\Crypt::encrypt($folder) }}">
                                        <span class="fa fa-folder"></span> {{$folder}}
                                    </a>
                                    @if ($current_folder == $folder)
                                        <div class="list-group folder">
                                            @foreach($folder_files as $file)
                                                <a href="?l={{ \Illuminate\Support\Facades\Crypt::encrypt($file) }}&f={{ \Illuminate\Support\Facades\Crypt::encrypt($folder) }}"
                                                   class="list-group-item @if($current_file == $file) active @endif">
                                                    {{$file}}
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                            @foreach($files as $file)
                                <a href="?l={{ \Illuminate\Support\Facades\Crypt::encrypt($file) }}"
                                   class="list-group-item @if ($current_file == $file) llv-active @endif">
                                    {{$file}}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="table-responsive">
                            @if ($logs === null)
                                <div>
                                    Log file >50M, please download it.
                                </div>
                            @else
                                <table id="table-log" class="table table-striped" data-ordering-index="{{ $standardFormat ? 2 : 0 }}">
                                    <thead>
                                    <tr>
                                        @if ($standardFormat)
                                            <th>Level</th>
                                            <th>Context</th>
                                            <th>Date</th>
                                        @else
                                            <th>Line number</th>
                                        @endif
                                        <th>Content</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($logs as $key => $log)
                                        <tr data-display="stack{{{$key}}}">
                                            @if ($standardFormat)
                                                <td class="nowrap text-{{{$log['level_class']}}}">
                                                    <span class="fa fa-{{{$log['level_img']}}}" aria-hidden="true"></span>&nbsp;&nbsp;{{$log['level']}}
                                                </td>
                                                <td class="text">{{$log['context']}}</td>
                                            @endif
                                            <td class="date">{{{$log['date']}}}</td>
                                            <td class="text">
                                                {{$log['text']}}
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                    @else
                        <div class="card-body">
                            <div class="empty-state" data-height="400">
                                <div class="empty-state-icon">
                                    <i class="fas fa-question"></i>
                                </div>
                                <h2>We couldn't find any data</h2>
                                <p class="lead">
                                    There is no event history here yet.
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </div>

@section('script')
    <!-- Datatables -->
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.table-container tr').on('click', function () {
                $('#' + $(this).data('display')).toggle();
            });
            $('#table-log').DataTable({
                "order": [$('#table-log').data('orderingIndex'), 'desc'],
                "stateSave": true,
                "searching": false,
                "stateSaveCallback": function (settings, data) {
                    window.localStorage.setItem("datatable", JSON.stringify(data));
                },
                "stateLoadCallback": function (settings) {
                    var data = JSON.parse(window.localStorage.getItem("datatable"));
                    if (data) data.start = 0;
                    return data;
                }
            });
        });
    </script>
@endsection

    @section('style')
        .table-responsive {
        overflow-x: hidden;
        }
    @endsection

</x-admin-layout>

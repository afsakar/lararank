<div>
    @include('admin.activities.show-modal')
        <div class="card-header">
            <h4>
                <select wire:click="changeEvent($event.target.value)" class="form-control form-control-sm">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                </select>
            </h4>
            <div class="card-header-form">
                <form class="form-inline">
                    <button class="btn btn-sm btn-danger mr-3" id="deleteSelected" style="display:none;">Seçilenleri Sil</button>
                    <input type="text" class="form-control form-control-sm" placeholder="Ara..." wire:model="search" />
                </form>
            </div>
        </div>
    @if($activities->count() != 0)

        <div class="table-responsive">
            <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th class="text-center">
                        <div class="custom-checkbox custom-control">
                            <input type="checkbox" data-checkboxes="activityTable" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                            <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                        </div>
                    </th>
                    <th class="text-center text-black">#</th>
                    <th>
                        <a wire:click.prevent="sortBy('log_name')" class="text-black" role="button" href="#">
                            Türü
                            @include('admin.includes.sort-icon', ['field' => 'log_name'])
                        </a>
                    </th>
                    <th>
                        <a wire:click.prevent="sortBy('description')" class="text-black" role="button" href="#">
                            Açıklama
                            @include('admin.includes.sort-icon', ['field' => 'description'])
                        </a>
                    </th>
                    <th>
                        <a wire:click.prevent="sortBy('causer_id')" class="text-black" role="button" href="#">
                            Kullanıcı
                            @include('admin.includes.sort-icon', ['field' => 'causer_id'])
                        </a>
                    </th>
                    <th>
                        <a wire:click.prevent="sortBy('created_at')" class="text-black" role="button" href="#">
                            Tarih
                            @include('admin.includes.sort-icon', ['field' => 'created_at'])
                        </a>
                    </th>
                    <th class="text-center text-black">İşlemler</th>
                </tr>
                </thead>
                <tbody>
                @foreach($activities as $activity)
                    <tr>
                        <td class="p-0 text-center">
                            <div class="custom-checkbox custom-control">
                                <input type="checkbox" data-checkboxes="activityTable" class="custom-control-input deleteMultiple" value="{{ $activity->id }}" id="checkbox-{{ $activity->id }}" name="delete[]">
                                <label for="checkbox-{{ $activity->id }}" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td class="text-center">{{ $activity->id }}</td>
                        <td class="text-capitalize">
                            <span class="btn @if($activity->log_name == "created") btn-success @elseif($activity->log_name == "updated") btn-warning @else btn-danger @endif">
                                @if($activity->log_name == "created")
                                    <i class="fas fa-plus-circle"></i>
                                @elseif($activity->log_name == "updated")
                                    <i class="fas fa-edit"></i>
                                @else
                                    <i class="fas fa-trash"></i>
                                @endif {{ $activity->log_name }}
                            </span>
                        </td>
                        <td>{{ $activity->description }}</td>
                        <td>
                            @if($activity->user)
                            <img src="{{ $activity->user->profile_photo_url }}" alt="{{ $activity->user->name }}" width="30" class="rounded-circle mr-1" data-placement="top" data-toggle="tooltip" title="{{ $activity->user->email }}"> {{ $activity->user->name }}
                            @else
                                @php $user = \App\Models\User::where('id', $activity->subject_id)->first() @endphp

                                <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" width="30" class="rounded-circle mr-1" data-placement="top" data-toggle="tooltip" title="{{ $user->email }}"> {{ $user->name }}

                            @endif
                        </td>
                        <td title="{{ $activity->created_at }}">{{ $activity->created_at->diffForHumans() }}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                @if($activity->log_name == "updated")
                                    <a href="#" data-toggle="modal" data-target="#showModal" wire:click="details({{ $activity->id }})"
                                       class="btn btn-primary btn-icon btn-sm">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                @endif
                                @if(permission_check('activities', 'delete'))
                                    <a href="#" data-url="{{ route('activities.destroy', $activity->id) }}" class="btn btn-icon btn-danger btn-sm delete-confirm text-white"><i class="fa fa-trash"></i></a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $activities->links() }}
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
                    There are no transactions in the system in the last 7 days.
                </p>
            </div>
        </div>
    @endif

</div>

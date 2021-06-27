<div>
    <div class="card-header">
        <h4>
            <select wire:click="changeEvent($event.target.value)" class="form-control form-control-sm">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="25">25</option>
            </select>
        </h4>
        <form class="card-header-form">
            <input type="text" class="form-control form-control-sm" placeholder="Ara..." wire:model="search" />
        </form>
    </div>
    <table class="table table-hover text-nowrap">
        <thead>
        <tr>
            <th class="text-center text-black">#</th>
            <th>
                <a wire:click.prevent="sortBy('name')" class="text-black" role="button" href="#">
                    Adı Soyadı
                    @include('admin.includes.sort-icon', ['field' => 'name'])
                </a>
            </th>
            <th>
                <a wire:click.prevent="sortBy('email')" class="text-black" role="button" href="#">
                    Email
                    @include('admin.includes.sort-icon', ['field' => 'email'])
                </a>
            </th>
            <th class="text-center">
                <a wire:click.prevent="sortBy('role_id')" class="text-black" role="button" href="#">
                    Tipi
                    @include('admin.includes.sort-icon', ['field' => 'role_id'])
                </a>
            </th>
            <th class="text-center text-black">İşlemler</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td class="text-center">{{ $user->id }}</td>
                <td>
                    <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" width="30" class="rounded-circle mr-1"> {{ $user->name }}
                </td>
                <td>{{ $user->email }}</td>
                <td class="text-center text-capitalize">
                    <span class="badge badge-primary">{{ $user->role->name }}</span>
                </td>
                <td class="text-center">
                    <div class="btn-group">
                        @if(permission_check('users', 'edit'))
                            <a href="@if($user->id == auth()->user()->id) {{ route('users.profile') }} @else {{ route('users.edit', $user->id) }} @endif" class="btn btn-primary btn-icon btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>
                        @endif
                        @if(permission_check('users', 'delete'))
                            @if($user->id != auth()->user()->id)
                                <a href="#" data-url="{{ route('users.destroy', $user->id) }}" class="btn btn-icon btn-danger btn-sm delete-confirm text-white"><i class="fa fa-trash"></i></a>
                            @endif
                        @endif
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $users->links() }}
    </div>

</div>

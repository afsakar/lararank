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
                    Rol Adı
                    @include('admin.includes.sort-icon', ['field' => 'name'])
                </a>
            </th>
            <th>
                Açıklama
            </th>
            <th class="text-center text-black">İşlemler</th>
        </tr>
        </thead>
        <tbody>
        @foreach($roles as $role)
            <tr>
                <td class="text-center">{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <td>{{ $role->description }}</td>
                <td class="text-center">
                    <div class="btn-group">
                        @if(permission_check('roles', 'edit'))
                            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary btn-icon btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>
                        @endif
                        @if(permission_check('roles', 'delete'))
                            @if(!in_array($role->id, array(1,2,3)))
                                <a href="#" data-url="{{ route('roles.destroy', $role->id) }}" class="btn btn-icon btn-danger btn-sm delete-confirm text-white"><i class="fa fa-trash"></i></a>
                            @endif
                        @endif
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $roles->links() }}
    </div>

</div>

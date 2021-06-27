<x-admin-layout>

    <x-slot name="header">
        Rol Düzenle  ({{ $role->name }})
    </x-slot>

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Rol Düzenle <small>({{ $role->name }})</small></h1>
                <div class="section-header-breadcrumb">
                    <div class="section-header-button">
                        <a href="{{ route('roles.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Geri dön</a>
                    </div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    @include('admin.includes.alert')
                    <div class="col-md-8 offset-md-2">
                        <x-error-component/>
                        <div class="card">
                            <div class="card-body table-responsive">
                                <form action="{{ route('roles.update', $role->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-md-12">
                                        <ul class="nav nav-pills" id="myTab3" role="tablist">
                                            <li class="nav-item mr-2">
                                              <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">Genel</a>
                                            </li>
                                            @if($role->id != 1)
                                                <li class="nav-item mr-2">
                                                    <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#permissions" role="tab" aria-controls="permissions" aria-selected="false">Yetkiler</a>
                                                </li>
                                            @endif
                                        </ul>
                                        <div class="tab-content" id="myTabContent2">
                                            <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general">
                                                <div class="form-group">
                                                    <label>Rol Adı</label>
                                                    <input type="text" name="name" class="form-control" value="{{ old('name', $role->name) }}">
                                                    @error('name')
                                                    <div class="text-danger"> {{ $message }} </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Açıklama</label>
                                                    <textarea name="description" class="form-control" rows="5">{{ old('description', $role->description) }}</textarea>
                                                    @error('description')
                                                    <div class="text-danger"> {{ $message }} </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            @if($role->id != 1)
                                            <div class="tab-pane fade" id="permissions" role="tabpanel" aria-labelledby="permissions">
                                                @foreach (config('menu') as $menu)
                                                    @if(isset($menu['submenus']))
                                                        <div class="form-group">
                                                            <label class="d-block">
                                                                <div class="section-title mt-0">
                                                                   {{ $menu['title'] }}
                                                                </div>
                                                                @if($menu['description'] || $menu['description'] != "")
                                                                    <div>
                                                                        <em class="text-muted">({{ $menu['description'] }})</em>
                                                                    </div>
                                                                @endif
                                                            </label>
                                                            @foreach ($menu['permissions'] as $key => $permission)
                                                                @php $menu_gate = $menu['gate']; @endphp
                                                                <div class="form-check form-check-inline">
                                                                    <input
                                                                        @if (old("permissions[{$menu_gate}][{$key}]", ($role->perms[$menu_gate][$key] ?? "") == "true"))
                                                                        checked
                                                                        @endif
                                                                        class="form-check-input" name="permissions[{{$menu_gate}}][{{$key}}]" type="checkbox" id="{{ $menu['title'].$loop->iteration }}" value="true">
                                                                    <label class="form-check-label" for="{{ $menu['title'].$loop->iteration }}">{{ $permission }}</label>
                                                                </div>
                                                            @endforeach
                                                            <div class="bg-light p-2 rounded">
                                                            @foreach ($menu['submenus'] as $submenu)
                                                                <label class="d-block @if(!$loop->first) mt-2 @endif">
                                                                    <strong>
                                                                        <i class="fas fa-minus"></i> {{ $submenu['title'] }}
                                                                    </strong>
                                                                    @if($submenu['description'] || $submenu['description'] != "")
                                                                        <div>
                                                                            <em class="text-muted">({{ $submenu['description'] }})</em>
                                                                        </div>
                                                                    @endif
                                                                </label>
                                                                @foreach ($submenu['permissions'] as $key => $permission)
                                                                @php $gate = $submenu['gate']; @endphp
                                                                    <div class="form-check form-check-inline">
                                                                        <input
                                                                        @if (old("permissions[{$gate}]{[$key]}", ($role->perms[$gate][$key] ?? "") == "true"))
                                                                            checked
                                                                        @endif
                                                                        class="form-check-input" name="permissions[{{$gate}}][{{$key}}]" type="checkbox" id="{{ $submenu['title'].$loop->iteration }}" value="true">
                                                                        <label class="form-check-label" for="{{ $submenu['title'].$loop->iteration }}">{{ $permission }}</label>
                                                                    </div>
                                                                @endforeach
                                                            @endforeach
                                                        </div>
                                                        </div>
                                                    @else
                                                        <div class="form-group">
                                                            <label class="d-block">
                                                                <div class="section-title mt-0">
                                                                   {{ $menu['title'] }}
                                                                </div>
                                                                @if($menu['description'] || $menu['description'] != "")
                                                                    <div>
                                                                        <em class="text-muted">({{ $menu['description'] }})</em>
                                                                    </div>
                                                                @endif
                                                            </label>
                                                            @foreach ($menu['permissions'] as $key => $permission)
                                                            @php $menu_gate = $menu['gate']; @endphp
                                                                <div class="form-check form-check-inline">
                                                                    <input
                                                                    @if (old("permissions[{$menu_gate}][{$key}]", ($role->perms[$menu_gate][$key] ?? "") == "true"))
                                                                        checked
                                                                    @endif
                                                                    class="form-check-input" name="permissions[{{$menu_gate}}][{{$key}}]" type="checkbox" id="{{ $menu['title'].$loop->iteration }}" value="true">
                                                                    <label class="form-check-label" for="{{ $menu['title'].$loop->iteration }}">{{ $permission }}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-icon icon-left btn-primary"><i class="fas fa-save"></i> Kaydet</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

</x-admin-layout>

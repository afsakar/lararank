<x-admin-layout>

    <x-slot name="header">
        Kullanıcı Düzenle  ({{ $user->name }})
    </x-slot>

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Kullanıcı Düzenle ({{ $user->name }})</h1>
                <div class="section-header-breadcrumb">
                    <div class="section-header-button">
                        <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Geri dön</a>
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
                                <form action="{{ route('users.update', $user->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-md-12">
                                        <ul class="nav nav-pills" id="myTab3" role="tablist">
                                            <li class="nav-item mr-2">
                                                <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">Genel</a>
                                            </li>
                                            <li class="nav-item mr-2" id="permissions_tab">
                                                <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#permissions" role="tab" aria-controls="permissions" aria-selected="false">Yetkiler</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="myTabContent2">
                                            <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general">
                                                <div class="form-group">
                                                    <label>Adı Soyadı</label>
                                                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                                                    @error('name')
                                                    <div class="text-danger"> {{ $message }} </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Email Adresi</label>
                                                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                                                    @error('email')
                                                    <div class="text-danger"> {{ $message }} </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Şifre</label>
                                                    <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                                                    @error('password')
                                                    <div class="text-danger"> {{ $message }} </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Şifre Tekrar</label>
                                                    <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}">
                                                    @error('password_confirmation')
                                                    <div class="text-danger"> {{ $message }} </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Tipi</label>
                                                    <select class="form-control selectric" id="role_id" name="role_id">
                                                        @foreach(\App\Models\Role::all() as $role)
                                                            <option @if(old('role_id', $user->role_id) == $role->id) selected @endif value="{{ $role->id }}">{{ $role->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
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
                                                                        @if (old("permissions[{$menu_gate}][{$key}]", ($user->permission[$menu_gate][$key] ?? "") == "true"))
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
                                                                                @if (old("permissions[{$gate}][{$key}]", ($user->permission[$gate][$key] ?? "") == "true"))
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
                                                                        @if (old("permissions[{$menu_gate}][{$key}]", ($user->permission[$menu_gate][$key] ?? "") == "true"))
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
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-icon icon-left btn-primary"><i class="fa fa-save"></i> Kaydet</button>
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

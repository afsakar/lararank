<x-admin-layout>

    <x-slot name="header">
        Kullanıcı Ekle
    </x-slot>

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Kullanıcı Ekle</h1>
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
                                <form action="{{ route('users.store') }}" method="post">
                                    @csrf
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Adı Soyadı</label>
                                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                            @error('name')
                                            <div class="text-danger"> {{ $message }} </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Email Adresi</label>
                                            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
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
                                            <select class="form-control selectric" name="role_id">
                                                @foreach(\App\Models\Role::all() as $role)
                                                    <option @if(old('role_id') == $role->id) selected @endif value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
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

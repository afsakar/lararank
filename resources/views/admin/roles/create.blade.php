<x-admin-layout>

    <x-slot name="header">
        Rol Ekle
    </x-slot>

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Rol Ekle</h1>
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
                                <form action="{{ route('roles.store') }}" method="post">
                                    @csrf
                                    <div class="col-md-12">
                                        <ul class="nav nav-pills" id="myTab3" role="tablist">
                                            <li class="nav-item mr-2">
                                                <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">Genel</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="myTabContent2">
                                            <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general">
                                                <div class="form-group">
                                                    <label>Rol Adı</label>
                                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                                    @error('name')
                                                    <div class="text-danger"> {{ $message }} </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Açıklama</label>
                                                    <textarea name="description" class="form-control" rows="5">{{ old('description') }}</textarea>
                                                    @error('description')
                                                    <div class="text-danger"> {{ $message }} </div>
                                                    @enderror
                                                </div>
                                            </div>
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

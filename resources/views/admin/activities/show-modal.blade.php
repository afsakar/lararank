<div wire:ignore.self class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Aktivite Detayı</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    @if(isset($properties['old']))
                        <div class="col-md-4">
                            <h6>Kolon Adı</h6>
                        </div>
                        <div class="col-md-4">
                            <h6>Eski Değer</h6>
                        </div>
                        <div class="col-md-4">
                            <h6>Yeni Değer</h6>
                        </div>
                        @foreach($properties['old'] as $attribute => $old)
                            <div class="col-md-4">
                                {{ $attribute }}
                            </div>
                            <div class="col-md-4">
                                {{ $old }}
                            </div>
                            <div class="col-md-4">
                                {{ $properties['attributes'][$attribute] }}
                            </div>
                            <hr>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div>

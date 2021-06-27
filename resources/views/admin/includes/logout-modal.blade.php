<div class="modal fade" id="logoutModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Çıkış yapıyorsunuz</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Çıkış yapmak istediğinizden emin misiniz?</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Vazgeç</button>
                <form action="{{ route('logout') }}" class="form-inline" method="post">
                    @csrf
                    <button type="submit" class="btn btn-danger">Çıkış yap</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

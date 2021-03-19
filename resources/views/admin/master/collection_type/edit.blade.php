<div class="modal fade" id="modal-default-edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Jenis Koleksi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frm_edit_collection_type">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Kode</label>
                        <input type="text" class="form-control codec" maxlength="2" name="code" autofocus required>
                    </div>
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" class="form-control namec" name="name" autofocus required>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <input type="text" class="id_collection_type" name="id" hidden readonly>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary btn_update_collection_type">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-default-edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Permission</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frm_edit_permission">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Permission</label>
                        <input type="text" class="form-control namec" minlength="3" name="name" autofocus required>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <input type="text" class="id_permission" name="id" hidden readonly>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary btn_update_permission">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

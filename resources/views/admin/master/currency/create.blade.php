<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Mata Uang</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frm_add_currency">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama<i style="color:red;">*</i></label>
                        <input type="text" class="form-control" name="name" placeholder="Indonesian Rupiah" autofocus required>
                    </div>
                    <div class="form-group">
                        <label for="">Simbol<i style="color:red;">*</i></label>
                        <input type="text" class="form-control" name="symbol" placeholder="IDR" autofocus required>
                    </div>
                    <div class="form-group">
                        <label for="">Status<i style="color:red;">*</i></label>
                        <select name="status" class="form-control select2bs4" required>
                            <option value=""></option>
                            <option value="active">Aktif</option>
                            <option value="not_active">Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary btn_simpan_currency">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

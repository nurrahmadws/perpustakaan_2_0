<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Role</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frm_add_role">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Role</label>
                        <input type="text" class="form-control" minlength="3" name="name" autofocus required>
                    </div>
                    <div class="form-group">
                        <label for="">Permission</label>
                        <select name="permission[]" class="form-control select2bs4" required multiple>
                            @foreach ($permissions as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary btn_simpan_role">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

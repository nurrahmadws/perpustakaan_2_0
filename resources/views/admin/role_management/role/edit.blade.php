<div class="modal fade" id="modal-default-edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Role</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frm_edit_role">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Role</label>
                        <input type="text" class="form-control namec" minlength="3" name="name" autofocus required>
                    </div>
                    <div class="form-group">
                        <label for="">Permission</label>
                        <select name="permission[]" class="form-control select2bs4 permi_c" required multiple>
                            @foreach ($permissions as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <input type="text" class="id_role" name="id" hidden readonly>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary btn_update_role">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

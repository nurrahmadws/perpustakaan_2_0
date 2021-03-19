<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Kategori Buku</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frm_add_category">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Jenis Koleksi</label>
                        <select name="collection_type_id" class="form-control select2bs4" required>
                            @foreach ($collection_types as $item)
                                <option value="{{$item->id}}">{{$item->code}} | {{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Kode Kategori</label>
                        <input type="text" class="form-control" maxlength="4" name="code" autofocus required>
                    </div>
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" name="name" autofocus required>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary btn_simpan_category">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

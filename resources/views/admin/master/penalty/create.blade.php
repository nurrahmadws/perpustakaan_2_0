<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Denda</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frm_add_penalty">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Kategori Buku<i style="color:red;">*</i></label>
                        <select data-placeholder="Pilih Kategori Buku" name="category_id[]" multiple class="form-control select2bs4" required>
                            <option value=""></option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Mata Uang<i style="color:red;">*</i></label>
                        <select data-placeholder="Pilih Mata Uang" name="currency_id" class="form-control select2bs4" required>
                            <option value=""></option>
                            @foreach ($currencies as $currency)
                                <option value="{{$currency->id}}">{{$currency->symbol}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Nilai Denda<i style="color:red;">*</i></label>
                        <div class="input-group">
                            <input type="text" class="form-control curr" name="amount" placeholder="10.000,00" autofocus required>&nbsp;/&nbsp;
                            <div class="input-grop-prepend">
                                <select data-placeholder="Pilih Format" name="format" class="form-control select2bs4" required>
                                    <option value=""></option>
                                    <option value="Jam">Jam</option>
                                    <option value="Hari">Hari</option>
                                    <option value="Buku">Buku</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Status<i style="color:red;">*</i></label>
                        <select data-placeholder="Pilih Status" name="status" class="form-control select2bs4" required>
                            <option value=""></option>
                            <option value="active">Aktif</option>
                            <option value="not_active">Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary btn_simpan_penalty">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

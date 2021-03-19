<div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Buku</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frm_add_book" enctype="multipart/form-data">
                {{-- @csrf  method="POST" action="{{url('admin/master/books/store')}}" --}}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Sampul/Cover Buku</label>
                        <input type="file" class="form-control" name="image">
                    </div>
                    <div class="form-group">
                        <label for="">Jenis Pengadaan Buku</label>
                        <select data-placeholder="Pilih Jenis Pengadaan Buku" name="type_of_procurement_id" class="form-control select2bs4" required>
                            <option value=""></option>
                            @foreach ($procurements as $procurement)
                                <option value="{{$procurement->id}}">{{$procurement->code}} | {{$procurement->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Jenis Koleksi</label>
                        <select data-placeholder="Pilih Jenis Koleksi" name="collection_type_id" class="form-control coti select2bs4" required>
                            <option value=""></option>
                            @foreach ($collections as $collections)
                                <option value="{{$collections->id}}">{{$collections->code}} | {{$collections->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Kategori</label>
                        <select name="category_id" class="form-control select2bs4 cate" required>
                            <option value="">Pilih Jenis Koleksi Dahulu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Judul Buku</label>
                        <input type="text" class="form-control" name="title" autofocus required>
                    </div>
                    <div class="form-group">
                        <label for="">Pengarang/Penulis</label>
                        <select data-placeholder="Pilih Author" name="author_id[]" class="form-control select2bs4" multiple required>
                            <option value=""></option>
                            @foreach ($authors as $authors)
                                <option value="{{$authors->id}}">{{$authors->code}} | {{$authors->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="">Penerbit</label>
                            <input type="text" class="form-control" name="publisher" autofocus required>
                        </div>
                        <div class="col-sm-6">
                            <label for="">Tahun Penerbit</label>
                            <input type="number" class="form-control" name="publication_year" autofocus required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="">Total Halaman</label>
                            <input type="number" class="form-control" name="pages" autofocus required>
                        </div>
                        <div class="col-sm-6">
                            <label for="">Stok Ketersediaan</label>
                            <input type="number" class="form-control" name="stock" autofocus required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Abstrak</label>
                        <textarea name="abstract" cols="30" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">ISBN</label>
                        <div class="multi_row">
                            <div class="input-group" id="ke1">
                                <input type="text" class="form-control" name="isbn[]" required>
                                <div class="input-group-prepend">
                                    <span class="input-group-btn">
                                        <a class="btn btn-primary add_row_isbn" style="color: whitesmoke;"><i class="fa fa-plus"></i></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Buku Diterima</label>
                        <input type="date" class="form-control" name="date_received">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary btn_simpan_book">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

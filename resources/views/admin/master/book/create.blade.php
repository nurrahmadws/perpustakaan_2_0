<div class="create_part" style="display: none;">
    <form id="frm_add_book" enctype="multipart/form-data">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table no_border table-striped">
                        <tbody>
                            <tr>
                                <td>Sampul/Cover Buku</td>
                                <td>:</td>
                                <td>
                                    <input type="file" class="form-control" name="image">
                                </td>
                            </tr>
                            <tr>
                                <td>Jenis Pengadaan Buku<i style="color:red;">*</i></td>
                                <td>:</td>
                                <td>
                                    <select data-placeholder="Pilih Jenis Pengadaan Buku" name="type_of_procurement_id" class="form-control select2bs4" required>
                                        <option value=""></option>
                                        @foreach ($procurements as $procurement)
                                            <option value="{{$procurement->id}}">{{$procurement->code}} | {{$procurement->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Jenis Koleksi<i style="color:red;">*</i></td>
                                <td>:</td>
                                <td>
                                    <select data-placeholder="Pilih Jenis Koleksi" name="collection_type_id" class="form-control coti select2bs4" required>
                                        <option value=""></option>
                                        @foreach ($collections as $collections)
                                            <option value="{{$collections->id}}">{{$collections->code}} | {{$collections->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Kategori<i style="color:red;">*</i></td>
                                <td>:</td>
                                <td>
                                    <select name="category_id" class="form-control select2bs4 cate" required>
                                        <option value="">Pilih Jenis Koleksi Dahulu</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Judul Buku<i style="color:red;">*</i></td>
                                <td>:</td>
                                <td>
                                    <input type="text" class="form-control" name="title" autofocus required>
                                </td>
                            </tr>
                            <tr>
                                <td>Pengarang/Penulis<i style="color:red;">*</i></td>
                                <td>:</td>
                                <td>
                                    <div class="input-group">
                                        <select data-placeholder="Pilih Author" name="author_id[]" class="form-control select2bs4 author_class" multiple required>
                                            <option value=""></option>
                                            @foreach ($authors as $authors)
                                                <option value="{{$authors->id}}">{{$authors->code}} | {{$authors->name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-prepend">
                                            <span class="input-group-btn">
                                                <a data-toggle="modal" data-target="#modal-default" class="btn btn-primary" style="color: whitesmoke;"><i class="fa fa-plus color-white"></i></a>
                                            </span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Penerbit<i style="color:red;">*</i></td>
                                <td>:</td>
                                <td>
                                    <input type="text" class="form-control" name="publisher" autofocus required>
                                </td>
                            </tr>
                            <tr>
                                <td>Tahun Terbit<i style="color:red;">*</i></td>
                                <td>:</td>
                                <td>
                                    <input type="number" class="form-control" name="publication_year" autofocus required>
                                </td>
                            </tr>
                            <tr>
                                <td>Kota Penerbit<i style="color:red;">*</i></td>
                                <td>:</td>
                                <td>
                                    <input type="text" class="form-control" name="place_of_publication" autofocus required>
                                </td>
                            </tr>
                            <tr>
                                <td>Edisi</td>
                                <td>:</td>
                                <td>
                                    <input type="text" class="form-control" name="edition" autofocus>
                                </td>
                            </tr>
                            <tr>
                                <td>Cetakan</td>
                                <td>:</td>
                                <td>
                                    <input type="text" class="form-control" name="cetakan" autofocus>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table no_border table-striped">
                        <tbody>
                            <tr>
                                <td>Bahasa<i style="color:red;">*</i></td>
                                <td>:</td>
                                <td>
                                    <input type="text" class="form-control" name="language" autofocus required>
                                </td>
                            </tr>
                            <tr>
                                <td>Penerjemah</td>
                                <td>:</td>
                                <td>
                                    <input type="text" class="form-control" name="translator" autofocus>
                                </td>
                            </tr>
                            <tr>
                                <td>ISBN<i style="color:red;">*</i></td>
                                <td>:</td>
                                <td>
                                    <table class="table">
                                        <tbody class="multi_row">
                                            <tr class="text-center">
                                                <td>
                                                    <input type="number" class="form-control" name="isbn[]" required>
                                                </td>
                                                <td>
                                                    <a class="btn btn-primary add_row_isbn" style="color: whitesmoke;"><i class="fa fa-plus"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>Total Halaman</td>
                                <td>:</td>
                                <td>
                                    <input type="number" class="form-control" name="pages" autofocus>
                                </td>
                            </tr>
                            <tr>
                                <td>Stok Ketersediaan<i style="color:red;">*</i></td>
                                <td>:</td>
                                <td>
                                    <input type="number" class="form-control" name="stock" autofocus required>
                                </td>
                            </tr>
                            <tr>
                                <td>Panjang Buku <i>(CM)</i></td>
                                <td>:</td>
                                <td>
                                    <input type="number" class="form-control" name="length" autofocus>
                                </td>
                            </tr>
                            <tr>
                                <td>Lebar Buku <i>(CM)</i></td>
                                <td>:</td>
                                <td>
                                    <input type="number" class="form-control" name="width" autofocus>
                                </td>
                            </tr>
                            <tr>
                                <td>Deskripsi Singkat</td>
                                <td>:</td>
                                <td>
                                    <textarea name="abstract" cols="30" rows="3" class="form-control"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Tanggal Buku Diterima<i style="color:red;">*</i></td>
                                <td>:</td>
                                <td>
                                    <input type="date" class="form-control" name="date_received" required>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary btn_simpan_book">Simpan</button>
        </div>
    </form>
</div>

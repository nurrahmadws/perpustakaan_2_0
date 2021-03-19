@extends('admin.template.app')
@section('title')
Edit Buku
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('assets/form_wizard/css/style.css')}}"> --}}
    {{-- <style>
        .modal-open .select2-dropdown {
            z-index: 10060;
        }

        .modal-open .select2-close-mask {
            z-index: 10055;
        }
    </style> --}}
@endsection
@section('content')
    @section('breadcrumb')
        <li class="breadcrumb-item" aria-current="page"><a href="{{url('admin/master/books')}}">Buku</a></li>
        <li class="breadcrumb-item" aria-current="page"><a href="{{url('admin/master/books/'.$book->id.'/detail')}}">{{$book->title}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Buku</li>
    @endsection

    <div class="row">
        <div class="col-md-12">
            <br>
            <div class="card card-yellow card-outline">
                <div class="card-header">
                    <h3 class="card-title">Edit Buku</h3>
                    <div class="card-tools">
                        <a href="{{url('admin/master/books/'.$book->id.'/detail')}}" class="btn btn-sm btn-secondary"><i class="fas fa-chevron-circle-left" style="color: whitesmoke"></i> Kembali</a>
                    </div>
                </div>
                <form id="frm_edit_book" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table no_border table-striped">
                                    <tbody>
                                        <tr>
                                            <td>Sampul/Cover Buku Saat Ini</td>
                                            <td>:</td>
                                            <td>
                                                <img src="{{$book->getCover()}}" class="img-thumbnail rounded img-fluid" style="height: 150px; width:100px;">
                                            </td>
                                        </tr>
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
                                                        <option value="{{$procurement->id}}"
                                                            {{$book->type_of_procurement_id == $procurement->id ? 'selected' : ''}}>{{$procurement->code}} | {{$procurement->name}}</option>
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
                                                        <option value="{{$collections->id}}"
                                                            {{$book->collection_type_id == $collections->id ? 'selected' : ''}}>{{$collections->code}} | {{$collections->name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kategori<i style="color:red;">*</i></td>
                                            <td>:</td>
                                            <td>
                                                <select name="category_id" class="form-control select2bs4 cate" required>
                                                    {{-- <option value="">Pilih Jenis Koleksi Dahulu</option> --}}
                                                    <option value="{{$book->category_id}}">{{$book->category->name}}</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Judul Buku<i style="color:red;">*</i></td>
                                            <td>:</td>
                                            <td>
                                                <input type="text" class="form-control" name="title" value="{{$book->title}}" required>
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
                                                            <option value="{{$authors->id}}"
                                                                @foreach ($book->author as $ba)
                                                                    {{$ba->id == $authors->id ? 'selected' : ''}}
                                                                @endforeach>{{$authors->code}} | {{$authors->name}}</option>
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
                                                <input type="text" class="form-control" name="publisher" value="{{$book->publisher}}" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tahun Terbit<i style="color:red;">*</i></td>
                                            <td>:</td>
                                            <td>
                                                <input type="number" class="form-control" name="publication_year" value="{{$book->publication_year}}" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kota Penerbit<i style="color:red;">*</i></td>
                                            <td>:</td>
                                            <td>
                                                <input type="text" class="form-control" name="place_of_publication" value="{{$book->place_of_publication}}" required>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table no_border table-striped">
                                    <tbody>
                                        <tr>
                                            <td>Edisi</td>
                                            <td>:</td>
                                            <td>
                                                <input type="text" class="form-control" name="edition" value="{{$book->edition}}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Cetakan</td>
                                            <td>:</td>
                                            <td>
                                                <input type="text" class="form-control" name="cetakan" value="{{$book->cetakan}}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Bahasa<i style="color:red;">*</i></td>
                                            <td>:</td>
                                            <td>
                                                <input type="text" class="form-control" name="language" value="{{$book->language}}" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Penerjemah</td>
                                            <td>:</td>
                                            <td>
                                                <input type="text" class="form-control" name="translator" value="{{$book->translator}}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>ISBN<i style="color:red;">*</i></td>
                                            <td>:</td>
                                            <td>
                                                <table class="table">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <th>ISBN</th>
                                                            <th>
                                                                @if (isset($book->isbns) && $book->isbns->count() != 0)
                                                                    <a class="btn btn-primary add_row_isbn" style="color: whitesmoke;"><i class="fa fa-plus"></i></a>
                                                                @else
                                                                    Aksi
                                                                @endif
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="multi_row">
                                                        @if (isset($book->isbns) && $book->isbns->count() != 0)
                                                            @foreach ($book->isbns as $isbn)
                                                                <tr class="text-center">
                                                                    <td>
                                                                        <input type="number" class="form-control" name="isbn[]" value="{{$isbn->number}}" required>
                                                                    </td>
                                                                    <td>
                                                                        <a class="btn btn-danger del_row_isbn_edt{{$loop->iteration}}" style="color: whitesmoke;"><i class="fa fa-minus"></i></a>
                                                                    </td>
                                                                </tr>
                                                                @if ($loop->last)
                                                                    <input type="hidden" class="iterations" value="{{$loop->count}}">
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            <tr class="text-center">
                                                                <td>
                                                                    <input type="number" class="form-control" name="isbn[]" required>
                                                                </td>
                                                                <td>
                                                                    <a class="btn btn-primary add_row_isbn" style="color: whitesmoke;"><i class="fa fa-plus"></i></a>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Total Halaman</td>
                                            <td>:</td>
                                            <td>
                                                <input type="number" class="form-control" name="pages" value="{{$book->pages}}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Stok Ketersediaan<i style="color:red;">*</i></td>
                                            <td>:</td>
                                            <td>
                                                <input type="number" class="form-control" name="stock" value="{{$book->stock}}" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Panjang Buku <i>(CM)</i></td>
                                            <td>:</td>
                                            <td>
                                                <input type="number" class="form-control" name="length" value="{{$book->length}}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Lebar Buku <i>(CM)</i></td>
                                            <td>:</td>
                                            <td>
                                                <input type="number" class="form-control" name="width" value="{{$book->width}}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Deskripsi Singkat</td>
                                            <td>:</td>
                                            <td>
                                                <textarea name="abstract" cols="30" rows="3" class="form-control">{!!$book->abstract!!}</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Buku Diterima<i style="color:red;">*</i></td>
                                            <td>:</td>
                                            <td>
                                                <input type="date" class="form-control" name="date_received" value="{{date('Y-m-d', strtotime($book->date_received))}}" required>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="hidden" class="book_id" value="{{$book->id}}" readonly>
                        <button type="submit" class="btn btn-primary btn_update_book">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('admin.master.author.create')
@endsection
@push('js')
    <script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('management/master/book.js')}}"></script>
@endpush

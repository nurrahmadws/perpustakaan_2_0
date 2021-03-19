@extends('admin.template.app')
@section('title')
Book Detail
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection
@section('content')
    @section('breadcrumb')
        <li class="breadcrumb-item" aria-current="page"><a href="{{url('admin/master/books')}}">Buku</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail Buku</li>
    @endsection

    <div class="row">
        <div class="col-md-12">
            <br>
            <div class="card card-red card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{$book->title}}</h3>
                    <div class="card-tools">
                        @if (auth()->user()->hasAnyRole('admin|staff_teknis|staff_pengadaan_buku') && $book->status != 'Published')
                            <a href="{{url('admin/master/books/'.$book->id.'/edit')}}" class="btn btn-sm btn-warning"><i class="fas fa-edit" style="color: whitesmoke"></i> Edit</a>
                            <a onclick="delete_book('{{$book->id}}')" class="btn btn-sm btn-danger btn_delete_book{{$book->id}}" title="Hapus Buku" style="color: whitesmoke"><i class="fas fa-trash" style="color: whitesmoke"></i> Hapus</a>
                        @endif
                        <a href="{{url('admin/master/books/')}}" class="btn btn-sm btn-secondary"><i class="fas fa-chevron-circle-left" style="color: whitesmoke"></i> Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table no_border table-striped">
                                <tbody>
                                    <tr>
                                        <th>Sampul/Cover Buku</th>
                                        <th>:</th>
                                        <td>
                                            <img src="{{$book->getCover()}}" class="img-thumbnail rounded img-fluid" style="height: 150px; width:100px;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Judul Buku</th>
                                        <th>:</th>
                                        <td>
                                            {{$book->title}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Barcode/Book Number</th>
                                        <th>:</th>
                                        <td>
                                            {!! DNS1D::getBarcodeHTML("$book->book_number", "C128",1.4,22) !!}
                                            <br>
                                            {{$book->book_number}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Pengadaan</th>
                                        <th>:</th>
                                        <td>
                                            ({{$book->jenis_pengadaan->code}}) {{$book->jenis_pengadaan->name}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Koleksi</th>
                                        <th>:</th>
                                        <td>
                                            ({{$book->collection_type->code}}) {{$book->collection_type->name}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Kategori</th>
                                        <th>:</th>
                                        <td>
                                            ({{$book->category->code}}) {{$book->category->name}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>ISBN</th>
                                        <th>:</th>
                                        <td>
                                            @foreach ($book->isbns as $isbn)
                                                {{$isbn->number}}{{($loop->last) ? '':';'}}
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Bahasa</th>
                                        <th>:</th>
                                        <td>
                                            {{$book->language}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Penerjemah</th>
                                        <th>:</th>
                                        <td>
                                            {{$book->translator}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table no_border table-striped">
                                <tbody>
                                    <tr>
                                        <th>Penulis</th>
                                        <th>:</th>
                                        <td>
                                            @foreach ($book->author as $item)
                                                {{$item->name}}{{($loop->last) ? '':';'}}
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Edisi - Cetakan</th>
                                        <th>:</th>
                                        <td>
                                            {{$book->edition}} - {{$book->cetakan}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Penerbit</th>
                                        <th>:</th>
                                        <td>
                                            {{$book->publisher}} - {{$book->place_of_publication}} - {{$book->publication_year}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Deskripsi Fisik</th>
                                        <th>:</th>
                                        <td>
                                            {{$book->pages}} halaman | panjang: {{$book->length}}cm | lebar: {{$book->width}}cm
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Buku Diterima</th>
                                        <th>:</th>
                                        <td>
                                            {{date('F d, Y', strtotime($book->date_received))}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Data Buku di Input</th>
                                        <th>:</th>
                                        <td>
                                            {{date('F d, Y', strtotime($book->created_at))}} oleh {{$book->user_created->name}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Data Buku di Perbaharui</th>
                                        <th>:</th>
                                        <td>
                                            {{date('F d, Y', strtotime($book->updated_at))}} oleh {{$book->user_updated->name}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Stok Ketersediaan</th>
                                        <th>:</th>
                                        <td>
                                            {{$book->stock}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <th>:</th>
                                        <td>
                                            @if (auth()->user()->hasAnyRole('admin|staff_approval_publisher|staff_teknis'))
                                                @if ($book->status == 'Draft')
                                                    <button type="button" class="btn btn-warning dropdown-toggle dropdown-icon btn_update_status" data-toggle="dropdown">{{$book->status}}</button>
                                                    <div class="dropdown-menu" role="menu">
                                                        <a class="dropdown-item approve_c" href="#">Approve</a>
                                                    </div>
                                                @elseif($book->status == 'Approved')
                                                    <button type="button" class="btn btn-info dropdown-toggle dropdown-icon btn_update_status" data-toggle="dropdown">{{$book->status}} by {{$book->user_approved->name}} at {{date('F d, Y', strtotime($book->approval_date))}}</button>
                                                    <div class="dropdown-menu" role="menu">
                                                        <a class="dropdown-item publish_c" href="#">Publish</a>
                                                    </div>
                                                @elseif($book->status == 'Published')
                                                    <span class="badge badge-success">{{$book->status}} by {{$book->user_published->name}} at {{date('F d, Y', strtotime($book->publish_date))}}</span>
                                                @endif
                                            @else
                                                @if ($book->status == 'Draft')
                                                    <span class="badge badge-warning">{{$book->status}}</span>
                                                @elseif($book->status == 'Approved')
                                                    <span class="badge badge-info">{{$book->status}} by {{$book->user_approved->name}} at {{date('F d, Y', strtotime($book->approval_date))}}</span>
                                                @elseif($book->status == 'Published')
                                                    <span class="badge badge-success">{{$book->status}} by {{$book->user_published->name}} at {{date('F d, Y', strtotime($book->publish_date))}}</span>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" class="id_buku" value="{{$book->id}}" readonly>
    @include('admin.master.book.delete')
@endsection
@push('js')
<script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('management/master/book.js')}}"></script>
@endpush

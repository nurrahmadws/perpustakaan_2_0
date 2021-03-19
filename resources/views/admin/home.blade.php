@extends('admin.template.app')
@section('title')
    Dashboard
@endsection
@section('content')
    <h1>INI HALAMAN ADMIN</h1>

    {{-- <div>{!! DNS1D::getBarcodeHTML('4445645656', 'C39') !!}</div><br/>
    <div>{!! DNS1D::getBarcodeHTML('4445645656', 'POSTNET') !!}</div><br/>
    <div>{!! DNS1D::getBarcodeHTML('4445645656', 'PHARMA') !!}</div><br/>
    <div>{!! DNS2D::getBarcodeHTML('4445645656', 'QRCODE') !!}</div><br/> --}}
    {{-- <div class="barcode">
        <p class="name">{{$category->name}}</p>
        <p class="price">Price: {{$category->id}}</p>
        {!! DNS1D::getBarcodeHTML("ggg", "C128",1.4,22) !!}
        <p class="pid">{{$category->id}}</p>
        <input type="text">
    </div> --}}
    {{-- <img src="data:image/png;base64,{{DNS1D::getBarcodePNG('11', 'C39')}}" alt="barcode" />
	<img src="data:image/png;base64,{{DNS1D::getBarcodePNG('12', 'C39+')}}" alt="barcode" />
	<img src="data:image/png;base64,{{DNS1D::getBarcodePNG('13', 'C39E')}}" alt="barcode" />
	<img src="data:image/png;base64,{{DNS1D::getBarcodePNG('14', 'C39E+')}}" alt="barcode" />
	<img src="data:image/png;base64,{{DNS1D::getBarcodePNG('15', 'C93')}}" alt="barcode" />
	<br/>
	<br/>
	<img src="data:image/png;base64,{{DNS1D::getBarcodePNG('19', 'S25')}}" alt="barcode" />
	<img src="data:image/png;base64,{{DNS1D::getBarcodePNG('20', 'S25+')}}" alt="barcode" />
	<img src="data:image/png;base64,{{DNS1D::getBarcodePNG('21', 'I25')}}" alt="barcode" />
	<img src="data:image/png;base64,{{DNS1D::getBarcodePNG('22', 'MSI+')}}" alt="barcode" />
	<img src="data:image/png;base64,{{DNS1D::getBarcodePNG('23', 'POSTNET')}}" alt="barcode" />
	<br/>
	<br/>
	<img src="data:image/png;base64,{{DNS2D::getBarcodePNG('16', 'QRCODE')}}" alt="barcode" />
	<img src="data:image/png;base64,{{DNS2D::getBarcodePNG('17', 'PDF417')}}" alt="barcode" />
	<img src="data:image/png;base64,{{DNS2D::getBarcodePNG('18', 'DATAMATRIX')}}" alt="barcode" /> --}}
@endsection

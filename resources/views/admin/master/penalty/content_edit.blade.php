<div class="form-group">
    <label for="">Kategori Buku<i style="color:red;">*</i></label>
    <select data-placeholder="Pilih Kategori Buku" name="category_id[]" multiple class="form-control select2bs4" required>
        <option value=""></option>
        @foreach ($categories as $category)
            <option value="{{$category->id}}"
                @foreach ($penalty->categories as $item)
                    {{$item->id == $category->id ? 'selected' : ''}}
                @endforeach>{{$category->name}}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="">Mata Uang<i style="color:red;">*</i></label>
    <select data-placeholder="Pilih Mata Uang" name="currency_id" class="form-control select2bs4" required>
        <option value=""></option>
        @foreach ($currencies as $currency)
            <option value="{{$currency->id}}"
                {{$penalty->currency_id == $currency->id ? 'selected' : ''}}>{{$currency->symbol}}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="">Nilai Denda<i style="color:red;">*</i></label>
    <div class="input-group">
        <input type="text" class="form-control curr" name="amount" placeholder="10.000,00" value="{{Mata_uang::rupiah($penalty->amount)}}" required>&nbsp;/&nbsp;
        <div class="input-grop-prepend">
            <select data-placeholder="Pilih Format" name="format" class="form-control select2bs4" required>
                <option value=""></option>
                <option value="Jam" {{$penalty->format == 'Jam' ? 'selected' : ''}}>Jam</option>
                <option value="Hari" {{$penalty->format == 'Hari' ? 'selected' : ''}}>Hari</option>
                <option value="Buku" {{$penalty->format == 'Buku' ? 'selected' : ''}}>Buku</option>
            </select>
        </div>
    </div>
</div>
<div class="form-group">
    <label for="">Status<i style="color:red;">*</i></label>
    <select data-placeholder="Pilih Status" name="status" class="form-control select2bs4" required>
        <option value=""></option>
        <option value="active" {{$penalty->status == 'active' ? 'selected' : ''}}>Aktif</option>
        <option value="not_active" {{$penalty->status == 'not_active' ? 'selected' : ''}}>Tidak Aktif</option>
    </select>
</div>
<input type="hidden" class="penalty_id" value="{{$penalty->id}}" readonly>

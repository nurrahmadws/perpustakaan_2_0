<div class="form-group">
    <label for="">Jenis Koleksi</label>
    <select data-placeholder="Pilih Jenis Koleksi" name="collection_type_id" class="form-control select2bs4" required>
        <option value=""></option>
        @foreach ($collection_types as $item)
            <option value="{{$item->id}}"
                {{($category->collection_type_id == $item->id) ? 'selected' : ''}}>{{$item->code}} | {{$item->name}}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="">Kode Kategori</label>
    <input type="text" class="form-control" maxlength="4" name="code" value="{{$category->code}}" autofocus required>
</div>
<div class="form-group">
    <label for="">Nama</label>
    <input type="text" class="form-control" name="name" value="{{$category->name}}" autofocus required>
</div>

<input type="text" class="id_category" name="id" value="{{$category->id}}" hidden readonly>

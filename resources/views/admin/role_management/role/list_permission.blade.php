@foreach ($model->permissions as $item)
    <span class="badge badge-success">{{$item->name}}</span>
@endforeach

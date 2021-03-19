@foreach ($model->categories as $category)
    {{$category->name}}{{($loop->last) ? '' : ','}}
@endforeach

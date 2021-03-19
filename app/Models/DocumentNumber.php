<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentNumber extends Model
{
    use HasFactory;

    protected $table = 'document_numbers';

    protected $guarded = ['id'];

    public function jenis_pengadaan()
    {
        return $this->belongsTo(Procurement::class, 'type_of_procurement_id', 'id');
    }

    public function jenis_koleksi()
    {
        return $this->belongsTo(CollectionType::class, 'collection_type_id', 'id');
    }

    public function kategori_buku()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function buku()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }
}

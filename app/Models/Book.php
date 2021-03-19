<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';
    protected $guarded = ['id'];

    public function getCover()
    {
        if ($this->image) {
            return asset('covers/'.$this->image);
        }
        return 'https://via.placeholder.com/150x150.png?text=Tidak+Ada+Cover';
    }

    public function isbns()
    {
        return $this->hasMany(Isbn::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsToMany(Author::class, 'books_author');
    }

    public function collection_type()
    {
        return $this->belongsTo(CollectionType::class, 'collection_type_id', 'id');
    }

    public function jenis_pengadaan()
    {
        return $this->belongsTo(Procurement::class, 'type_of_procurement_id', 'id');
    }

    public function user_created()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function user_updated()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function user_published()
    {
        return $this->belongsTo(User::class, 'published_by', 'id');
    }

    public function user_approved()
    {
        return $this->belongsTo(User::class, 'approved_by', 'id');
    }
}

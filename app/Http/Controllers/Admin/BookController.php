<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

use App\Models\Book;
use App\Models\Author;
use App\Models\Procurement;
use App\Models\Category;
use App\Models\Isbn;
use App\Models\CollectionType;
use App\Models\DocumentNumber;

use File, Validator, DNS1D;

class BookController extends Controller
{
    public function index()
    {
        $data['authors'] = Author::all();
        $data['procurements'] = Procurement::all();
        $data['categories'] = Category::all();
        $data['collections'] = CollectionType::all();
        return view('admin.master.book.index', $data);
    }

    public function list_category($id)
    {
        $data = Category::where('collection_type_id', $id)->get();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $rules = array(
            'image' => 'sometimes|image|max:5024',
        );

        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $cek_jenis_pengadaan = Procurement::where('id', $request->type_of_procurement_id)->first();
        $cek_jenis_koleksi = CollectionType::where('id', $request->collection_type_id)->first();
        $cek_kategori = Category::where('id', $request->category_id)->first();
        // $cek_buku = Book::latest('id')->first();
        $cek_doc_numb = DocumentNumber::latest('id')->first();

        if(isset($cek_doc_numb)){
            $another_cek_doc_numb = DocumentNumber::where('type_of_procurement_id', $cek_jenis_pengadaan->id)->where('collection_type_id', $cek_jenis_koleksi->id)->where('category_id', $cek_kategori->id)->latest('id')->first();
            if(isset($another_cek_doc_numb)){
                $number = $another_cek_doc_numb->number + 1;
            }else{
                $number = 1;
            }
        }else{
            $number = 1;
        }
        $real_book_number = $cek_jenis_pengadaan->code.'/'.$cek_jenis_koleksi->code.'/'.$cek_kategori->code.'/'.$request->publication_year.'/'.sprintf('%05d', $number);

        $book = new Book;
        $book->collection_type_id = $request->collection_type_id;
        $book->category_id = $request->category_id;
        $book->type_of_procurement_id = $request->type_of_procurement_id;
        $book->book_number = $real_book_number;
        $book->title = $request->title;
        $book->abstract = $request->abstract;
        $book->publisher = $request->publisher;
        $book->publication_year = $request->publication_year;
        $book->pages = $request->pages;
        $book->status = 'Draft';
        $book->stock = $request->stock;
        $book->date_received = $request->date_received;
        $book->place_of_publication = $request->place_of_publication;
        $book->edition = $request->edition;
        $book->cetakan = $request->cetakan;
        $book->language = $request->language;
        $book->translator = $request->translator;
        $book->length = $request->length;
        $book->width = $request->width;
        $book->created_by = auth()->user()->id;
        $book->updated_by = auth()->user()->id;

        if ($request->hasFile('image')) {
            $cover = $request->file('image');
            $filename = Str::slug($request->title, '_').'.'.$cover->getClientOriginalExtension();
            $location = public_path('covers');
            $cover->move($location, $filename);
            $final_cover = $filename;
            $book->image = $final_cover;
        }
        $book->save();
        $book->author()->sync($request->author_id, false);

        foreach($request->isbn as $key_isbn => $value_isbn){
            Isbn::create([
                'book_id' => $book->id,
                'number'  => $value_isbn
            ]);
        }

        $book_doc_number = new DocumentNumber;
        $book_doc_number->type_of_procurement_id = $cek_jenis_pengadaan->id;
        $book_doc_number->collection_type_id = $cek_jenis_koleksi->id;
        $book_doc_number->category_id = $cek_kategori->id;
        $book_doc_number->book_id = $book->id;
        $book_doc_number->number = $number;
        $book_doc_number->routing = 'master/books/';
        $book_doc_number->save();

        return response()->json([
            'success' => 'Buku Berhasil Di Tambahkan',
        ]);
    }

    public function detail($id)
    {
        $data['book'] = Book::where('id', $id)->with(['isbns', 'category', 'author', 'collection_type', 'jenis_pengadaan', 'user_created', 'user_updated', 'user_published'])->first();

        return view('admin.master.book.detail', $data);
    }

    public function show($id)
    {
        $book = Book::where('id', $id)->first();

        return response()->json($book);
    }

    public function edit($id)
    {
        $data['book'] = Book::where('id', $id)->with(['isbns', 'category', 'author', 'collection_type', 'jenis_pengadaan', 'user_created', 'user_updated', 'user_published'])->first();
        $data['authors'] = Author::all();
        $data['procurements'] = Procurement::all();
        $data['categories'] = Category::all();
        $data['collections'] = CollectionType::all();

        return view('admin.master.book.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $rules = array(
            'image' => 'sometimes|image|max:5024',
        );

        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $book = Book::findOrFail($id);
        if(isset($book->book_number)){
            $cek_jenis_pengadaan = Procurement::where('id', $request->type_of_procurement_id)->first();
            $cek_jenis_koleksi = CollectionType::where('id', $request->collection_type_id)->first();
            $cek_kategori = Category::where('id', $request->category_id)->first();

            $cek_doc_numb = DocumentNumber::where('book_id', $id)->first();

            if($cek_doc_numb->type_of_procurement_id == $cek_jenis_pengadaan->id && $cek_doc_numb->collection_type_id == $cek_jenis_koleksi->id && $cek_doc_numb->category_id == $cek_kategori->id){
                $number = $cek_doc_numb->number;
            }else{
                $another_cek_doc_numb = DocumentNumber::where('type_of_procurement_id', $cek_jenis_pengadaan->id)->where('collection_type_id', $cek_jenis_koleksi->id)->where('category_id', $cek_kategori->id)->latest('updated_at')->first();

                if(isset($another_cek_doc_numb)){
                    $number = $another_cek_doc_numb->number + 1;
                }else{
                    $number = 1;
                }
            }

            $real_book_number = $cek_jenis_pengadaan->code.'/'.$cek_jenis_koleksi->code.'/'.$cek_kategori->code.'/'.$request->publication_year.'/'.sprintf('%05d', $number);

            $book_doc_number = $cek_doc_numb;
            $book_doc_number->type_of_procurement_id = $cek_jenis_pengadaan->id;
            $book_doc_number->collection_type_id = $cek_jenis_koleksi->id;
            $book_doc_number->category_id = $cek_kategori->id;
            $book_doc_number->book_id = $id;
            $book_doc_number->number = $number;
            $book_doc_number->routing = 'master/books/';
            $book_doc_number->save();
        }else{
            $cek_jenis_pengadaan = Procurement::where('id', $request->type_of_procurement_id)->first();
            $cek_jenis_koleksi = CollectionType::where('id', $request->collection_type_id)->first();
            $cek_kategori = Category::where('id', $request->category_id)->first();
            $cek_doc_numb = DocumentNumber::latest('id')->first();

            if(isset($cek_doc_numb)){
                $another_cek_doc_numb = DocumentNumber::where('type_of_procurement_id', $cek_jenis_pengadaan->id)->where('collection_type_id', $cek_jenis_koleksi->id)->where('category_id', $cek_kategori->id)->latest('id')->first();
                if(isset($another_cek_doc_numb)){
                    $number = $another_cek_doc_numb->number + 1;
                }else{
                    $number = 1;
                }
            }else{
                $number = 1;
            }
            $real_book_number = $cek_jenis_pengadaan->code.'/'.$cek_jenis_koleksi->code.'/'.$cek_kategori->code.'/'.$request->publication_year.'/'.sprintf('%05d', $number);

            $book_doc_number = new DocumentNumber;
            $book_doc_number->type_of_procurement_id = $cek_jenis_pengadaan->id;
            $book_doc_number->collection_type_id = $cek_jenis_koleksi->id;
            $book_doc_number->category_id = $cek_kategori->id;
            $book_doc_number->book_id = $id;
            $book_doc_number->number = $number;
            $book_doc_number->routing = 'master/books/';
            $book_doc_number->save();
        }

        $book->collection_type_id = $request->collection_type_id;
        $book->category_id = $request->category_id;
        $book->type_of_procurement_id = $request->type_of_procurement_id;
        $book->book_number = $real_book_number;
        $book->title = $request->title;
        $book->abstract = $request->abstract;
        $book->publisher = $request->publisher;
        $book->publication_year = $request->publication_year;
        $book->pages = $request->pages;
        $book->stock = $request->stock;
        $book->date_received = $request->date_received;
        $book->place_of_publication = $request->place_of_publication;
        $book->edition = $request->edition;
        $book->cetakan = $request->cetakan;
        $book->language = $request->language;
        $book->translator = $request->translator;
        $book->length = $request->length;
        $book->width = $request->width;
        $book->updated_by = auth()->user()->id;

        if ($request->hasFile('image')) {
            if (isset($book->image) && file_exists(public_path('covers/'.$book->image))) {
                unlink(public_path('covers/'.$book->image));
            }

            $cover = $request->file('image');
            $filename = Str::slug($request->title, '_').'.'.$cover->getClientOriginalExtension();
            $location = public_path('covers');
            $cover->move($location, $filename);
            $final_cover = $filename;
            $book->image = $final_cover;
        }
        $book->save();
        if (isset($request->author_id)) {
            $book->author()->sync($request->author_id);
        } else {
            $book->author()->sync(array());
        }

        $book->isbns()->delete();
        foreach($request->isbn as $key_isbn => $value_isbn){
            Isbn::create([
                'book_id' => $book->id,
                'number'  => $value_isbn
            ]);
        }

        return response()->json([
            'success' => 'Data Buku Berhasil Di Perbaharui',
        ]);
    }

    public function delete($id)
    {
        $book = Book::findOrFail($id);
        if (isset($book->image) && file_exists(public_path('covers/'.$book->image))) {
            unlink(public_path('covers/'.$book->image));
        }
        $book->isbns()->delete();
        $book->delete();
        return response()->json([
            'success' => 'Data Buku Berhasil Di Hapus',
        ]);
    }

    public function approve($id)
    {
        Book::where('id', $id)->update([
            'status' => 'Approved',
            'updated_by' => auth()->user()->id,
            'approved_by' => auth()->user()->id,
            'approval_date' => now()
        ]);
        return response()->json([
            'success' => 'Status Buku Berhasil Di Perbaharui',
        ]);
    }

    public function publish($id)
    {
        Book::where('id', $id)->update([
            'status' => 'Published',
            'updated_by' => auth()->user()->id,
            'published_by' => auth()->user()->id,
            'publish_date' => now()
        ]);
        return response()->json([
            'success' => 'Status Buku Berhasil Di Perbaharui',
        ]);
    }
}

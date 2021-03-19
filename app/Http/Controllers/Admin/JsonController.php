<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Procurement;
use App\Models\CollectionType;
use App\Models\Category;
use App\Models\Author;
use App\Models\Book;
use App\Models\Currency;
use App\Models\Penalty;
use DB, DNS1D, DNS2D, Mata_uang;

class JsonController extends Controller
{
    public function permissions()
    {
        return datatables()
                    ->of(Permission::orderBy('name', 'ASC')->get())
                    ->addColumn('name', function($get){
                        return $get->name;
                    })
                    ->addColumn('action', function($get){
                        return '<a onclick="edit_permission('.$get->id.')" class="btn btn-sm btn-warning btn_edit_permission'.$get->id.'" title="Edit Permission" style="color: whitesmoke"><i class="fas fa-edit" style="color: whitesmoke"></i> Edit</a> <a onclick="delete_permission('.$get->id.')" class="btn btn-sm btn-danger btn_delete_permission'.$get->id.'" title="Hapus Permission" style="color: whitesmoke"><i class="fas fa-trash" style="color: whitesmoke"></i> Hapus</a>';
                    })
                    ->addIndexColumn()
                    ->rawColumns(['name', 'action'])
                    ->toJson();
    }

    public function roles()
    {
        return datatables()
                    ->of(Role::orderBy('name', 'ASC')->with(['permissions:id,name'])->get())
                    ->addColumn('name', function($get){
                        return $get->name;
                    })
                    ->addColumn('permission', 'admin.role_management.role.list_permission')
                    ->addColumn('action', function($get){
                        if ($get->name == 'Admin' || $get->name == 'admin' || $get->name == 'Administrator' || $get->name == 'administrator') {
                            return '<a onclick="edit_role('.$get->id.')" class="btn btn-sm btn-warning btn_edit_role'.$get->id.' disabledcontent" title="Edit role" style="color: whitesmoke"><i class="fas fa-edit" style="color: whitesmoke"></i> Edit</a> <a onclick="delete_role('.$get->id.')" class="btn btn-sm btn-danger btn_delete_role'.$get->id.' disabledcontent" title="Hapus role" style="color: whitesmoke"><i class="fas fa-trash" style="color: whitesmoke"></i> Hapus</a>';
                        }else{
                            return '<a onclick="edit_role('.$get->id.')" class="btn btn-sm btn-warning btn_edit_role'.$get->id.'" title="Edit role" style="color: whitesmoke"><i class="fas fa-edit" style="color: whitesmoke"></i> Edit</a> <a onclick="delete_role('.$get->id.')" class="btn btn-sm btn-danger btn_delete_role'.$get->id.'" title="Hapus role" style="color: whitesmoke"><i class="fas fa-trash" style="color: whitesmoke"></i> Hapus</a>';
                        }
                    })
                    ->addIndexColumn()
                    ->rawColumns(['name', 'permission', 'action'])
                    ->toJson();
    }

    public function users()
    {
        return datatables()
                    ->of(User::orderBy('name', 'ASC')->with(['roles:id,name'])->get())
                    ->addColumn('name', function($get){
                        return $get->name;
                    })
                    ->addColumn('email', function($get){
                        return $get->email;
                    })
                    ->addColumn('role', 'admin.role_management.user.list_role')
                    ->addColumn('action', function($get){
                        if ($get->name == 'Administrator') {
                            return '<a onclick="edit_user('.$get->id.')" class="btn btn-sm btn-warning btn_edit_user'.$get->id.' disabledcontent" title="Edit user" style="color: whitesmoke"><i class="fas fa-edit" style="color: whitesmoke"></i> Edit</a> <a onclick="edit_password('.$get->id.')" class="btn btn-sm btn-secondary btn_edit_password'.$get->id.' disabledcontent" title="Ganti password" style="color: whitesmoke"><i class="fas fa-key" style="color: whitesmoke"></i> Edit Password</a> <a onclick="delete_user('.$get->id.')" class="btn btn-sm btn-danger btn_delete_user'.$get->id.' disabledcontent" title="Hapus user" style="color: whitesmoke"><i class="fas fa-trash" style="color: whitesmoke"></i> Hapus</a>';
                        } else {
                            return '<a onclick="edit_user('.$get->id.')" class="btn btn-sm btn-warning btn_edit_user'.$get->id.'" title="Edit user" style="color: whitesmoke"><i class="fas fa-edit" style="color: whitesmoke"></i> Edit</a> <a onclick="edit_password('.$get->id.')" class="btn btn-sm btn-secondary btn_edit_password'.$get->id.'" title="Ganti password" style="color: whitesmoke"><i class="fas fa-key" style="color: whitesmoke"></i> Edit Password</a> <a onclick="delete_user('.$get->id.')" class="btn btn-sm btn-danger btn_delete_user'.$get->id.'" title="Hapus user" style="color: whitesmoke"><i class="fas fa-trash" style="color: whitesmoke"></i> Hapus</a>';
                        }
                    })
                    ->addIndexColumn()
                    ->rawColumns(['name', 'email', 'role', 'action'])
                    ->toJson();
    }

    public function procurements()
    {
        return datatables()
                    ->of(Procurement::with(['user_created'])->orderBy('name', 'ASC')->get())
                    ->addColumn('code', function($get){
                        return $get->code;
                    })
                    ->addColumn('name', function($get){
                        return $get->name;
                    })
                    ->addColumn('created_by', function($get){
                        return $get->user_created->name;
                    })
                    ->addColumn('action', function($get){
                        return '<a onclick="edit_procurement('.$get->id.')" class="btn btn-sm btn-warning btn_edit_procurement'.$get->id.'" title="Edit Jenis Pengadaan" style="color: whitesmoke"><i class="fas fa-edit" style="color: whitesmoke"></i> Edit</a> <a onclick="delete_procurement('.$get->id.')" class="btn btn-sm btn-danger btn_delete_procurement'.$get->id.'" title="Hapus Jenis Pengadaan" style="color: whitesmoke"><i class="fas fa-trash" style="color: whitesmoke"></i> Hapus</a>';
                    })
                    ->addIndexColumn()
                    ->rawColumns(['code', 'name', 'created_by', 'action'])
                    ->toJson();
    }

    public function collection_types()
    {
        return datatables()
                    ->of(CollectionType::with(['user_created'])->orderBy('name', 'ASC')->get())
                    ->addColumn('code', function($get){
                        return $get->code;
                    })
                    ->addColumn('name', function($get){
                        return $get->name;
                    })
                    ->addColumn('created_by', function($get){
                        return $get->user_created->name;
                    })
                    ->addColumn('action', function($get){
                        return '<a onclick="edit_collection_type('.$get->id.')" class="btn btn-sm btn-warning btn_edit_collection_type'.$get->id.'" title="Edit Jenis Koleksi" style="color: whitesmoke"><i class="fas fa-edit" style="color: whitesmoke"></i> Edit</a> <a onclick="delete_collection_type('.$get->id.')" class="btn btn-sm btn-danger btn_delete_collection_type'.$get->id.'" title="Hapus Jenis Koleksi" style="color: whitesmoke"><i class="fas fa-trash" style="color: whitesmoke"></i> Hapus</a>';
                    })
                    ->addIndexColumn()
                    ->rawColumns(['code', 'name', 'created_by', 'action'])
                    ->toJson();
    }

    public function categories()
    {
        return datatables()
                    ->of(Category::with(['user_created', 'collection_type'])->orderBy('name', 'ASC')->get())
                    ->addColumn('collection_type', function($get){
                        return (isset($get->collection_type->name) ? $get->collection_type->name : '');
                    })
                    ->addColumn('code', function($get){
                        return $get->code;
                    })
                    ->addColumn('name', function($get){
                        return $get->name;
                    })
                    ->addColumn('created_by', function($get){
                        return $get->user_created->name;
                    })
                    ->addColumn('action', function($get){
                        return '<a onclick="edit_category('.$get->id.')" class="btn btn-sm btn-warning btn_edit_category'.$get->id.'" title="Edit Kategori Buku" style="color: whitesmoke"><i class="fas fa-edit" style="color: whitesmoke"></i> Edit</a> <a onclick="delete_category('.$get->id.')" class="btn btn-sm btn-danger btn_delete_category'.$get->id.'" title="Hapus Kategori Buku" style="color: whitesmoke"><i class="fas fa-trash" style="color: whitesmoke"></i> Hapus</a>';
                    })
                    ->addIndexColumn()
                    ->rawColumns(['collection_type', 'code', 'name', 'created_by', 'action'])
                    ->toJson();
    }

    public function authors()
    {
        return datatables()
                    ->of(Author::with(['user_created'])->orderBy('name', 'ASC')->get())
                    ->addColumn('code', function($get){
                        return $get->code;
                    })
                    ->addColumn('name', function($get){
                        return $get->name;
                    })
                    ->addColumn('created_by', function($get){
                        return $get->user_created->name;
                    })
                    ->addColumn('action', function($get){
                        return '<a onclick="edit_author('.$get->id.')" class="btn btn-sm btn-warning btn_edit_author'.$get->id.'" title="Edit Author" style="color: whitesmoke"><i class="fas fa-edit" style="color: whitesmoke"></i> Edit</a> <a onclick="delete_author('.$get->id.')" class="btn btn-sm btn-danger btn_delete_author'.$get->id.'" title="Hapus Author" style="color: whitesmoke"><i class="fas fa-trash" style="color: whitesmoke"></i> Hapus</a>';
                    })
                    ->addIndexColumn()
                    ->rawColumns(['code', 'name', 'created_by', 'action'])
                    ->toJson();
    }

    public function books()
    {
        return datatables()
                    ->of(Book::orderBy('created_at', 'DESC')->get())
                    ->addColumn('cover', function($get){
                        return '<img src="'.$get->getCover().'" class="img-thumbnail rounded img-fluid" style="height: 150px; width:100px;">';
                    })
                    ->addColumn('title', function($get){
                        return $get->title;
                    })
                    // ->addColumn('publisher', function($get){
                    //     return $get->publisher;
                    // })
                    // ->addColumn('publication_year', function($get){
                    //     return $get->publication_year;
                    // })
                    ->addColumn('stock', function($get){
                        return $get->stock;
                    })
                    ->addColumn('status', function($get){
                        return $get->status;
                    })
                    ->addColumn('barcode', 'admin.master.book.barcode')
                    ->addColumn('action', function($get){
                        if (auth()->user()->hasAnyRole('admin|staff_teknis|staff_pengadaan_buku') && $get->status != 'Published'){
                            return '<a href="/admin/master/books/'.$get->id.'/detail" class="btn btn-xs btn-info" title="Detail Buku" style="color: whitesmoke"><i class="fas fa-eye" style="color: whitesmoke"></i></a> <a href="/admin/master/books/'.$get->id.'/edit" class="btn btn-xs btn-warning" title="Edit Buku" style="color: whitesmoke"><i class="fas fa-edit" style="color: whitesmoke"></i></a> <a onclick="delete_book('.$get->id.')" class="btn btn-xs btn-danger btn_delete_book'.$get->id.'" title="Hapus Buku" style="color: whitesmoke"><i class="fas fa-trash" style="color: whitesmoke"></i></a>';
                        }else{
                            return '<a href="/admin/master/books/'.$get->id.'/detail" class="btn btn-xs btn-info" title="Detail Buku" style="color: whitesmoke"><i class="fas fa-eye" style="color: whitesmoke"></i></a>';
                        }
                    })
                    ->addIndexColumn()
                    ->rawColumns(['cover', 'title', 'stock', 'status', 'barcode', 'action'])
                    ->toJson();
    }

    public function currencies()
    {
        return datatables()
                    ->of(Currency::with(['user_created', 'user_updated'])->orderBy('name', 'ASC')->get())
                    ->addColumn('name', function($get){
                        return $get->name;
                    })
                    ->addColumn('symbol', function($get){
                        return $get->symbol;
                    })
                    ->addColumn('status', function($get){
                        if($get->status == 'active'){
                            return '<span class="badge badge-info">Aktif</span>';
                        }elseif($get->status == 'not_active'){
                            return '<span class="badge badge-danger">Tidak Aktif</span>';
                        }
                    })
                    ->addColumn('created_by', function($get){
                        return $get->user_created->name;
                    })
                    ->addColumn('updated_by', function($get){
                        return $get->user_updated->name;
                    })
                    ->addColumn('action', function($get){
                        return '<a onclick="edit_currency('.$get->id.')" class="btn btn-sm btn-warning btn_edit_currency'.$get->id.'" title="Edit Mata Uang" style="color: whitesmoke"><i class="fas fa-edit" style="color: whitesmoke"></i></a> <a onclick="delete_currency('.$get->id.')" class="btn btn-sm btn-danger btn_delete_currency'.$get->id.'" title="Hapus Mata Uang" style="color: whitesmoke"><i class="fas fa-trash" style="color: whitesmoke"></i></a>';
                    })
                    ->addIndexColumn()
                    ->rawColumns(['name', 'symbol', 'status', 'created_by', 'updated_by', 'action'])
                    ->toJson();
    }

    public function penalties()
    {
        return datatables()
                    ->of(Penalty::with(['user_created', 'user_updated', 'categories', 'currency'])->orderBy('created_at', 'DESC')->get())
                    ->addColumn('category', 'admin.master.penalty.list_category')
                    ->addColumn('symbol', function($get){
                        return $get->currency->symbol;
                    })
                    ->addColumn('nilai', function($get){
                        return Mata_uang::rupiah($get->amount).' per '.$get->format;
                    })
                    ->addColumn('status', function($get){
                        if($get->status == 'active'){
                            return '<span class="badge badge-info">Aktif</span>';
                        }elseif($get->status == 'not_active'){
                            return '<span class="badge badge-danger">Tidak Aktif</span>';
                        }
                    })
                    ->addColumn('created_by', function($get){
                        return $get->user_created->name;
                    })
                    ->addColumn('updated_by', function($get){
                        return $get->user_updated->name;
                    })
                    ->addColumn('action', function($get){
                        return '<a onclick="edit_penalty('.$get->id.')" class="btn btn-sm btn-warning btn_edit_penalty'.$get->id.'" title="Edit Denda" style="color: whitesmoke"><i class="fas fa-edit" style="color: whitesmoke"></i></a> <a onclick="delete_penalty('.$get->id.')" class="btn btn-sm btn-danger btn_delete_penalty'.$get->id.'" title="Hapus Denda" style="color: whitesmoke"><i class="fas fa-trash" style="color: whitesmoke"></i></a>';
                    })
                    ->addIndexColumn()
                    ->rawColumns(['category', 'symbol', 'nilai', 'status', 'created_by', 'updated_by', 'action'])
                    ->toJson();
    }
}

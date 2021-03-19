<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();
        User::truncate();

        $userAdmin = User::create([
        	'name' => 'Administrator',
        	'email' => 'admin@perpus.id',
        	'password' => bcrypt('password')
        ]);

        $userTeknis = User::create([
            'name' => 'Teknisi 1',
            'email' => 'teknis1@perpus.id',
        	'password' => bcrypt('password')
        ]);

        $userPengadaanBuku = User::create([
            'name' => 'Pengadaan Buku 1',
            'email' => 'staff_pb1@perpus.id',
        	'password' => bcrypt('password')
        ]);

        $userApproval = User::create([
            'name' => 'Approval & Publisher 1',
            'email' => 'staff_approval_publisher1@perpus.id',
        	'password' => bcrypt('password')
        ]);

        $userPengembalianBuku = User::create([
            'name' => 'Pengembalian Buku 1',
            'email' => 'staff_borrow1@perpus.id',
        	'password' => bcrypt('password')
        ]);

        $userCheckerPengembalianBuku = User::create([
            'name' => 'Checker Pengembalian 1',
            'email' => 'staff_kembali1@perpus.id',
        	'password' => bcrypt('password')
        ]);

        // PEMBAGIAN ROLE
        $roleAdmin = Role::create(['name' => 'Admin']);
        $permissionAdmin = Permission::pluck('id', 'id')->all();
        $roleAdmin->syncPermissions($permissionAdmin);
        $userAdmin->assignRole([$roleAdmin->id]);

        $roleTeknisi = Role::create(['name' => 'Staff Teknis']);
        $permissionDirektur = Permission::whereNotIn('name', ['checked_book', 'published_book', 'approved_book', 'borrow_book'])->get();
        $roleTeknisi->syncPermissions($permissionDirektur);
        $userTeknis->assignRole([$roleTeknisi->id]);

        $rolePengadaanBuku = Role::create(['name' => 'Staff Pengadaan Buku']);
        $permissionPengadaanBuku = Permission::whereIn('name', ['book_create', 'book_edit', 'book_delete'])
                                        ->orWhere('name', 'LIKE', '%category%')
                                        ->orWhere('name', 'LIKE', '%author%')
                                        ->orWhere('name', 'LIKE', '%collection%')
                                        ->orWhere('name', 'LIKE', '%procurements%')
                                        ->get();
        $rolePengadaanBuku->syncPermissions($permissionPengadaanBuku);
        $userPengadaanBuku->assignRole([$rolePengadaanBuku->id]);

        $roleApprovalPublisher = Role::create(['name' => 'Staff Approval_Publisher']);
        $permissionApprovalPublisher = Permission::where('name', 'LIKE', '%published_book%')
                                        ->orWhere('name', 'LIKE', '%approved_book%')
                                        ->get();
        $roleApprovalPublisher->syncPermissions($permissionApprovalPublisher);
        $userApproval->assignRole([$roleApprovalPublisher->id]);

        $rolePengembalian = Role::create(['name' => 'Staff Pengembalian Buku']);
        $permissionPengembalian = Permission::where('name', 'LIKE', '%return_book%')
                                        ->get();
        $rolePengembalian->syncPermissions($permissionPengembalian);
        $userPengembalianBuku->assignRole([$rolePengembalian->id]);

        $roleCheckPengembalian = Role::create(['name' => 'Staff Verifikasi Pengembalian']);
        $permissionCheckPengembalian = Permission::where('name', 'LIKE', '%checked_book%')
                                        ->get();
        $roleCheckPengembalian->syncPermissions($permissionCheckPengembalian);
        $userCheckerPengembalianBuku->assignRole([$roleCheckPengembalian->id]);
    }
}

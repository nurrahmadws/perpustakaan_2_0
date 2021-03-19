<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'collection_type_create',
            'collection_type_edit',
            'collection_type_delete',
            'category_create',
            'category_edit',
            'category_delete',
            'author_create',
            'author_edit',
            'author_delete',
            'membership_create',
            'membership_edit',
            'membership_delete',
            'book_create',
            'book_edit',
            'book_delete',
            'user_create',
            'user_edit',
            'user_delete',
            'checked_book',
            'published_book',
            'approved_book',
            'borrow_book',
            'procurements_create',
            'procurements_edit',
            'procurements_delete',
            'permission_create',
            'permission_edit',
            'permission_delete',
            'role_create',
            'role_edit',
            'role_delete',
            'return_book'
         ];

         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
    }
}

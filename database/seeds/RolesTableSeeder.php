<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use App\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $admin = new Role();
      $admin->name  = "admin";
      $admin->display_name = "Administrator";
      $admin->description = "User is allowed to manage and edit side-wide content";
      $admin->save();

      $user = User::where('name', '=', 'Administrator')->first();
      $user->attachRole($admin);

      $registered = new Role();
      $registered->name = "registered";
      $registered->display_name = "Registered User";
      $registered->description = "User is registered with the website";
      $registered->save();

      $banned = new Role();
      $banned->name = 'banned';
      $banned->display_name = "Banned User";
      $banned->description = "User is banned from the website";
      $banned->save();

      $types = ['articles', 'events', 'hubs', 'forum-categories', 'forum-forums', 'forum-topics', 'forum-posts'];
      foreach($types as $type){
        $perm = new Permission();
        $perm->name = 'create-'.$type;
        $perm->display_name = 'Create '.ucfirst($type);
        $perm->description = 'create '.$type;
        $perm->save();
        $admin->attachPermission($perm);

        $perm = new Permission();
        $perm->name = 'edit-'.$type;
        $perm->display_name = 'Edit '.ucfirst($type);
        $perm->description = 'edit '.$type;
        $perm->save();
        $admin->attachPermission($perm);

        $perm = new Permission();
        $perm->name = 'delete-'.$type;
        $perm->display_name = 'Delete '.ucfirst($type);
        $perm->description = 'delete '.$type;
        $perm->save();
        $admin->attachPermission($perm);
      }
    }
}

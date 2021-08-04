<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends \Spatie\Permission\Models\Permission
{
    public $timestamps = true;
    
    public function roles()
    : BelongsToMany {
        return parent::roles()->withTimestamps();
    }
}
<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends \Spatie\Permission\Models\Role
{
    public $timestamps = true;
    
    public function permissions()
    : BelongsToMany {
        return parent::permissions()->withTimestamps(); // TODO: Change the autogenerated stub
    }
}
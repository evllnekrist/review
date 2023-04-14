<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminModel extends Model
{
    use SoftDeletes;
    protected $connection = 'pgsql';
    protected $table = 'ms_admin';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function creator(){
        return $this->belongsTo(AdminModel::class, 'created_by');
    }
    public function updater(){
        return $this->belongsTo(AdminModel::class, 'updated_by');
    }
    public function site(){
        return $this->hasMany(AdminStoreSiteModel::class, 'admin_id', 'id');
    }
}

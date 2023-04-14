<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestAssistanceModel extends Model
{
    use SoftDeletes;
    protected $connection = 'pgsql';
    protected $table = 'tr_request_assistance';
    protected $primaryKey = 'request_assistance_id';
    protected $fillable = [
        'created_by',
        'updated_by',
        'deleted_by'];
    protected $guarded = ['request_assistance_id'];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function creator(){
        return $this->belongsTo(AdminModel::class, 'created_by');
    }
    public function updater(){
        return $this->belongsTo(AdminModel::class, 'updated_by');
    }
    public function site(){
        return $this->hasOne(SiteModel::class,'site_code','site_code');
    }
    public function assistant(){
        return $this->hasOne(AdminModel::class,'id','admin_id');
    }
}

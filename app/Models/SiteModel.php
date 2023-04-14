<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteModel extends Model
{
    protected $connection = 'pgsql';
    protected $table = 'ms_site_code';
    protected $primaryKey = 'id';
    protected $guarded = ['id','region_id','district_id'];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}

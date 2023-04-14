<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RatingModel extends Model
{
    protected $connection = 'pgsql';
    protected $table = 'tr_rating';
    protected $primaryKey = 'rating_id';
    protected $guarded = ['rating_id','request_assistance_id'];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'website_key',
        'rating_id',
        'request_assistance_id',
        'score',
        'note',
        'site_code',
        'created_by',
        'updated_by'
    ];

    public function site(){
        return $this->belongsTo(SiteModel::class,'site_code','site_code');
    }
    public function request_assistance(){
        return $this->belongsTo(RequestAssistanceModel::class,'request_assistance_id','request_assistance_id');
    }

}

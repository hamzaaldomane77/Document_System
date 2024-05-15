<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'document',
        'doctype_id',
    ];

    public function document_type(){
        return $this->belongsTo(Doctype::class);
    }


}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $guarded = ['files'];
    protected $hidden = ['hash', 'updated_at'];

    public function getSignatures()
    {
        return Signature::where('document_id', $this->getKey())->get();
    }
}

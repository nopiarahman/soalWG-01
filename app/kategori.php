<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    protected $table = "kategori";
    protected $guarded = ['id','created_at','updated_at'];

    /**
     * Get the berita associated with the kategori
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function berita() 
    {
        return $this->hasOne(berita::class);
    }
}

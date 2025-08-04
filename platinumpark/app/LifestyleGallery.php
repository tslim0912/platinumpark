<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LifestyleGallery extends Model {

    protected $table = "lifestyle_gallery";

    public function lifestyle()
    {
        return $this->belongsTo('App\Lifestyle', 'lifestyle_id', 'id');
    }

}



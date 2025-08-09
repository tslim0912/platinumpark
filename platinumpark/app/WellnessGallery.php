<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WellnessGallery extends Model {

    protected $table = "wellness_gallery";

    public function Wellness()
    {
        return $this->belongsTo('App\Wellness', 'wellness_id', 'id');
    }

}



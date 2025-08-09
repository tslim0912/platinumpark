<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wellness extends Model {

    protected $table = "wellness";

    public function wellness_image() {
        return $this->hasMany(WellnessGallery::class, "wellness_id", "id");
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lifestyle extends Model {

    protected $table = "lifestyle";

    public function lifestyle_image() {
        return $this->hasMany(LifestyleGallery::class, "lifestyle_id", "id");
    }

}

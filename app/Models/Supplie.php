<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;


use Cviebrock\EloquentSluggable\Sluggable;

use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Supplie extends Model {

    use SluggableScopeHelpers;

    use Sluggable;

    protected $table = "supplies";

    public function sluggable()

    {

        return [

            'slug' => [

                'source' => 'title'           

            ]

        ];

    }
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    protected $fillable = [
        'title','slug','image',
    ];

    public function equipment_supplie(){
        return $this->belongsToMany('App\Models\Equipment');
    }



}

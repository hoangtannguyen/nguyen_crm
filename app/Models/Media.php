<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Media extends Model {
    use SluggableScopeHelpers;
    use Sluggable;
    protected $table = "media";
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'           
            ]
        ];
    }

    protected $fillable = [
        'title','slug','alt','type','path','content','user_id'
    ];


    /**
     * Get cates of media
     */
    public function cates() {
        return $this->belongsToMany('App\Models\MediaCate', 'media_media_cate', 'media_id', 'cate_id');
    }

}

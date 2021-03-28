<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Equipment extends Model {

    use SluggableScopeHelpers;

    use Sluggable;

    protected $table = "equipments";

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
        'title','slug','code','serial','type','status','maintenance_id','provider_id','repair_id','user_id','cate_id','unit_id','department_id','image'
    ];

    public function scopeDevice($query) {
        return $query->where('type', 'devices');
    }

    public function scopeSupplie($query) {
        return $query->where('type', 'supplies');
    }

    public function equipment_provider(){
        return $this->belongsTo('App\Models\Provider','provider_id','id');
    }

    public function equipment_maintenance(){
        return $this->belongsTo('App\Models\Provider','maintenance_id','id');
    }

    public function equipment_repair(){
        return $this->belongsTo('App\Models\Provider','repair_id','id');
    }

    public function equipment_user(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }

    public function equipment_unit(){
        return $this->belongsTo('App\Models\Unit','unit_id','id');
    }

    public function equipment_department(){
        return $this->belongsTo('App\Models\Department','department_id','id');
    }

    public function equipment_cates(){
        return $this->belongsTo('App\Models\Cates','cate_id','id');
    }

    public function equipment_supplie(){
        return $this->belongsToMany('App\Models\Supplie','equipment_supplie','equipment_id','supplies_id');
    }

    public function equipment_device(){
        return $this->belongsToMany('App\Models\Device','equipment_device','equipment_id','device_id');
    }

    public function equipment_action(){
        return $this->hasMany('App\Models\Action','equi_id','id');
    }

    public function action_repair(){
        return $this->hasMany('App\Models\Action','equi_id','id')->where('type','equipment_repair')->latest();
    }

    public function action_periodic(){
        return $this->hasMany('App\Models\Action','equi_id','id')->where('type','periodic_maintenance')->latest();
    }

    public function action_accredita(){
        return $this->hasMany('App\Models\Action','equi_id','id')->where('type','accreditation')->latest();
    }


}

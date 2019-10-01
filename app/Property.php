<?php

namespace App;

use App\Helper\DataViewer;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use DataViewer;

    public static $columns = ['id', 'title', 'description', 'bedroom', 'bathroom', 'property', 'status', 'region', 'project'];

    //  protected $fillable = ['id', 'title', 'description', 'bedroom', 'bathroom', 'property_type_id', 'status_id', 'region_id', 'project_name_id'];

    public function property()
    {
        return $this->hasOne(PropertyType::class, 'id', 'property_type_id');
    }

    public function status()
    {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }

    public function region()
    {
        return $this->hasOne(Region::class, 'id', 'region_id');
    }

    public function project()
    {
        return $this->hasOne(ProjectName::class, 'id', 'project_name_id');
    }

    public static function getDropdowns()
    {
        return [
            'status' => Status::all()->pluck('name', 'id'),
            'property' => PropertyType::all()->pluck('name', 'id'),
            'region' => Region::all()->pluck('name', 'id')
        ];
    }


}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $table = 'table_template';
    protected $primaryKey = 'id';
    
    protected $hidden = [
    'id', 'created_at', 'updated_at'
    ];
    
    
    public function items()
    {
        return $this->hasMany('App\TemplateItem', 'template_id', 'id');
    }
    
    public function checklist()
    {
        return $this->hasOne('App\TemplateChecklist', 'template_id', 'id');
    }
}
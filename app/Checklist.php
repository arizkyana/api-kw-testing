<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    protected $table = 'table_checklist';
    protected $primaryKey = 'id';
    
    protected $hidden = [
    'id'
    ];
    
    public function getLinksAttribute($link){
        return [
        'self' => "/checklists/{$this->id}"
        ];
    }
    
    public function items()
    {
        return $this->hasMany('App\Item', 'checklist_id', 'id');
    }
}
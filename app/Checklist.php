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
    
    public function getRelationshipsAttribute(){
        $items = [];
        foreach($this->items as $item){
            array_push($items, [
            'type' => "items",
            'id' => $item->id
            ]);
        }
        return [
        'items' => [
        'links' => [
        'self' => "/checklists/{$this->id}/relationships/items",
        'related' => "/checklists/{$this->id}/items"
        ],
        'data' => $items
        ]
        
        ];
    }
}
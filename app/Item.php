<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'table_item';
    protected $primaryKey = 'id';
    
    protected $hidden = [
    'id', 'checklist_id'
    ];
    
    public function itemId(){
        return $this->id;
    }
    
    public function getCompletedAttribute(){
        return [
        'id' => $this->id,
        'item_id' => $this->id,
        'is_completed' => $this->is_completed,
        'checklist_id' => $this->checklist_id
        ];
    }
    
    public function getInCompletedAttribute(){
        return [
        'id' => $this->id,
        'item_id' => $this->id,
        'is_completed' => $this->is_completed,
        'checklist_id' => $this->checklist_id
        ];
    }
}
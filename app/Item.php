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
}
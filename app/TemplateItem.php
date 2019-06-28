<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplateItem extends Model
{
    protected $table = 'table_template_item';
    protected $primaryKey = 'id';
    
    protected $hidden = [
    'id', 'created_at', 'updated_at', 'template_id'
    ];
}
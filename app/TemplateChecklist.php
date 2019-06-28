<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplateChecklist extends Model
{
    protected $table = 'table_template_checklist';
    protected $primaryKey = 'id';
    
    protected $hidden = [
    'id', 'created_at', 'updated_at', 'template_id'
    ];
}
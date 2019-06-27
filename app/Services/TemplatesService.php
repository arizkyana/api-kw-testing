<?php

namespace App\Services;

use Illuminate\Http\Request;

class TemplatesService
{
    
    public function listAllChecklistTemplate($filter, $sort){
        return "SELECT * FROM template WHERE " . $filter['attr'] . $filter['str'] . $sort;
    }
}
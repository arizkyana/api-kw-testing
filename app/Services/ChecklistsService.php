<?php

namespace App\Services;

use Illuminate\Http\Request;

class ChecklistsService
{
    public function __construct(){}
    
    public function index($queries){
        $filter = $queries->filter;
        $sort = $queries->sort;
        $fields = $queries->field;
        $pageLimit = $queries->page_limit;
        $pageOffset = $queries->page_offset;
        
        // TODO: Query to database here
        return ["message" => "ok"];
        
    }
    public function show(){}
    public function update(){}
    public function delete(){}
    public function create(){}
}
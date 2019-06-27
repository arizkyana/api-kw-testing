<?php

namespace App\Services;

use Illuminate\Http\Request;

class ChecklistsService extends Controller
{
    public function __construct(){}
    
    public function index($queries){
        $filter = $queries->filter;
        $sort = $queries->sort;
        $fields = $queries->field;
        $pageLimit = $queries->page_limit;
        $pageOffset = $queries->page_offset;
        
        // TODO: Query to database here
        $checklists = [
        'meta' => [
        'count' => $pageLimit,
        'total' => 100,
        ],
        'links' => [
        "first" => "https://kong.command-api.kw.com/api/v1/checklists/templates?page[limit]=10&page[offset]=0",
        "last" => "https://kong.command-api.kw.com/api/v1/checklists/templates?page[limit]=10&page[offset]=10",
        "next" => "https://kong.command-api.kw.com/api/v1/checklists/templates?page[limit]=10&page[offset]=10",
        "prev" => "null"
        ],
        'data' => [
        'name' => 'foo template',
        'checklist' => [
        'description' => 'my checklist',
        'due_interval' => 3,
        ]
        ]
        ];
    }
    public function show(){}
    public function update(){}
    public function delete(){}
    public function create(){}
}
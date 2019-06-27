<?php

namespace App\Http\Controllers;

use App\Utils\RequestParser;
use Illuminate\Http\Request;
use App\Services\TemplatesService;

class TemplatesController extends Controller
{
    
    use RequestParser;
    
    protected $service;
    
    public function __construct(TemplatesService $service) {
        $this->service = $service;
    }
    
    public function index(Request $request){
        $filter = $this->filtering($request->query('filter'));
        $sort = $this->sorting($request->query('sort'));
        
        $template = $this->service->listAllChecklistTemplate($filter, $sort);
        
        return ["message" => "template", $template];
    }
    public function create(){}
    public function show(){}
    public function update(){}
    public function delete(){}
}
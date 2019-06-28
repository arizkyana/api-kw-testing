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
        $this->middleware('auth');
        $this->service = $service;
    }
    
    public function index(Request $request){
        $limit = $this->limit($request->query('page'));
        $filter = $this->filtering($request->query('filter'));
        $sort = $this->sorting($request->query('sort'));
        
        
        $template = $this->service->listAllChecklistTemplate($filter, $sort, $limit);
        
        return $template;
    }
    public function create(Request $request){
        $create = $this->service->createTemplateChecklist($request->input());
        return $create;
    }
    public function show(Request $request, $templateId){
        $template = $this->service->getChecklistTemplateByTemplateId($templateId);
        return $template;
    }
    public function update(Request $request, $templateId){
        $update = $this->service->updateTemplateChecklist($request->input(), $templateId);
        return $update;
    }
    public function delete(Request $request, $templateId){
        $delete = $this->service->deleteTemplateChecklist($templateId);
        return $delete;
    }
    public function assigns(Request $request, $templateId){
        $assigns = $this->service->assignsBulkChecklist($request->input(), $templateId, $request->user());
        return $assigns;
    }
}
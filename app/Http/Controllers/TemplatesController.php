<?php

namespace App\Http\Controllers;

use App\Utils\RequestParser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        
        return response()->json($template, Response::HTTP_OK);
    }
    public function create(Request $request){
        $create = $this->service->createTemplateChecklist($request->input());
        return response()->json($create, Response::HTTP_CREATED);
    }
    public function show(Request $request, $templateId){
        $template = $this->service->getChecklistTemplateByTemplateId($templateId);
        return response()->json($template, Response::HTTP_FOUND);
    }
    public function update(Request $request, $templateId){
        $update = $this->service->updateTemplateChecklist($request->input(), $templateId);
        return response()->json($update, Response::HTTP_ACCEPTED);
    }
    public function delete(Request $request, $templateId){
        $this->service->deleteTemplateChecklist($templateId);
        return response('', Response::HTTP_NO_CONTENT);
    }
    public function assigns(Request $request, $templateId){
        $assigns = $this->service->assignsBulkChecklist($request->input(), $templateId, $request->user());
        return response()->json($assigns, Response::HTTP_CREATED);
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ChecklistsService;

class ChecklistsController extends Controller
{
    protected $service;
    public function __construct(ChecklistsService $service){
        $this->service = $service;
    }
    
    public function index(Request $request){
        return $this->service->index($request->query());
    }
    public function show(Request $request, $checklistId){
        return $this->service->show($checklistId);
    }
    public function update(Request $request, $checklistId){
        
        return $this->service->update($request->input(), $checklistId);
    }
    public function delete(Request $request, $checklistId){
        return $this->service->delete($request->input(), $checklistId);
    }
    public function create(Request $request){
        
        return $this->service($request->input());
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\ItemsService;

class ItemsController extends Controller
{
    protected $service;
    public function __construct(ItemsService $service){
        $this->middleware('auth');
        $this->service = $service;
    }
    
    public function complete(Request $request){
        $complete = $this->service->complete($request->input(), $request->user());
        return response()->json($complete, Response::HTTP_CREATED);
    }
    public function incomplete(Request $request){
        $complete = $this->service->incomplete($request->input(), $request->user());
        return response()->json($complete, Response::HTTP_CREATED);
    }
    public function byChecklistId(){}
    public function create(){}
    public function byChecklistIdAndItemId(){}
    public function updateByChecklistIdAndItemId(){}
    public function deleteByChecklistIdAndItemId(){}
    public function updateBulkByChecklistId(){}
    public function summaries(){}
    
}
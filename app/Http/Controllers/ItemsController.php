<?php

namespace App\Http\Controllers;

use App\Services\ItemsService;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    protected $service;
    public function __construct(ItemsService $service){
        $this->service = $service;
    }
    
    public function complete(){}
    public function incomplete(){}
    public function byChecklistId(){}
    public function create(){}
    public function byChecklistIdAndItemId(){}
    public function updateByChecklistIdAndItemId(){}
    public function deleteByChecklistIdAndItemId(){}
    public function updateBulkByChecklistId(){}
    public function summaries(){}
    
}
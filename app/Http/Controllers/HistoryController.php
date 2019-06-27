<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HistoryService;

class HistoryController extends Controller
{
    protected $service;
    public function __construct(HistoryService $service){
        $this->service = $service;
    }
    
    public function index(){}
    public function show(){}
}
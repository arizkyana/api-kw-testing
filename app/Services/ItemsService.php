<?php

namespace App\Services;

use App\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ItemsService
{
    public function complete($body, $user){
        $items = $body['data'];
        $completed = [];
        
        // validate items length
        if (count($items) <= 0) { abort(400, 'Bad request'); }
        
        foreach($items as $item) {
            $_item = Item::where('id', $item['item_id'])->first();
            $_item->is_completed = true;
            $_item->completed_at = Carbon::now();
            $_item->updated_by = $user->id;
            $_item->save();
            
            array_push($completed, $_item->completed);
        }
        
        return $completed;
    }
    
    public function incomplete($body, $user){
        $items = $body['data'];
        $incompleted = [];
        // validate items length
        if (count($items) <= 0) { abort(400, 'Bad request'); }
        
        foreach($items as $item) {
            $_item = Item::where('id', $item['item_id'])->first();
            $_item->is_completed = false;
            $_item->updated_by = $user->id;
            $_item->save();
            
            array_push($incompleted, $_item->in_completed);
        }
        
        return $incompleted;
    }
}
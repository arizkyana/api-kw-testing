<?php

namespace App\Services;

use App\Item;
use App\Template;
use App\Checklist;
use Carbon\Carbon;
use App\TemplateItem;
use App\TemplateChecklist;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class TemplatesService
{
    
    
    public function listAllChecklistTemplate($filter, $sort, $limit){
        
        $template = Template::with('items')->with('checklist');
        
        if (!empty($filter)) {
            if(!empty($filter['str'])){
                $template->whereRaw($filter['attr'] . $filter['str']);
            }
        }
        
        if (!empty($sort)){
            $template->orderBy($sort['field'], $sort['order']);
        }
        
        if (isset($limit['error'])){
            abort(Response::HTTP_BAD_REQUEST, $limit['error']);
        }
        
        $total = $template->count();
        $data = $template->offset($limit['offset'])->limit($limit['limit'])->get();
        return [
        'meta' => [
        'total' => $total,
        'count' => count($data)
        ],
        
        "links" => [
        "first" => "/templates?page[limit]=10&page[offset]=0",
        "last" => "/templates?page[limit]=10&page[offset]=10",
        "next" => "/templates?page[limit]=10&page[offset]=10",
        "prev" => "null"
        ],
        
        'data' => $data
        ];
        
    }
    
    public function createTemplateChecklist($body){
        // TODO: validate data.attributes
        if (isset($body['data'])){
            $input = $body['data']['attributes'];
            $template = new Template();
            $template->name = (isset($input['name']) && !empty(isset($input['name']))) ? $input['name'] : '-';
            $template->save();
            
            $checklist = new TemplateChecklist();
            $checklist->template_id = $template->id;
            $checklist->description = $input['checklist']['description'];
            $checklist->due_interval = $input['checklist']['due_interval'];
            $checklist->due_unit = $input['checklist']['due_unit'];
            $checklist->save();
            
            // TODO: validate items
            if (!isset($input['items']) || !is_array($input['items']) || (count($input['items']) <= 0)) { abort(Response::HTTP_BAD_REQUEST, 'Bad request'); }
            
            
            foreach($input['items'] as $item) {
                $_item = new TemplateItem();
                $_item->description = $item['description'];
                $_item->urgency = $item['urgency'];
                $_item->due_interval = $item['due_interval'];
                $_item->due_unit = $item['due_unit'];
                $_item->template_id = $template->id;
                $_item->save();
            }
            
            return [
            'data' => [
            'id' => $template->id,
            'attributes' => $template->attr
            ]
            ];
        } else {
            abort(400, 'Bad request');
        }
        
    }
    
    public function getChecklistTemplateByTemplateId($templateId){
        $template = Template::find($templateId);
        
        if (empty($template)) { abort(Response::HTTP_NOT_FOUND, 'not found'); }
        
        return [
        'data' => [
        'id' => $template->id,
        'type' => 'template',
        'attributes' => [
        'name' => $template->name,
        'checklist' => $template->checklist,
        'items' => $template->items
        ],
        'links' => [
        'self' => "/checklists/templates/{$template->id}"
        ]
        ]
        ];
    }
    
    public function updateTemplateChecklist($body, $templateId){
        // TODO: validate data.attributes
        $input = $body['data']['attributes'];
        
        $template = Template::find($templateId);
        $template->name = (isset($input['name']) && !empty($input['name'])) ? $input['name'] : '-';
        $template->save();
        
        $checklist = TemplateChecklist::where('template_id', $templateId)->first();
        $checklist->template_id = $template->id;
        $checklist->description = $input['checklist']['description'];
        $checklist->due_interval = $input['checklist']['due_interval'];
        $checklist->due_unit = $input['checklist']['due_unit'];
        $checklist->save();
        
        if (!isset($input['items']) || !is_array($input['items']) || (count($input['items']) <= 0)) { abort(Response::HTTP_BAD_REQUEST, 'Bad request'); }
        
        foreach($input['items'] as $item) {
            $_item = TemplateItem::where('template_id', $templateId)->first();
            $_item->description = $item['description'];
            $_item->urgency = $item['urgency'];
            $_item->due_interval = $item['due_interval'];
            $_item->due_unit = $item['due_unit'];
            $_item->template_id = $template->id;
            $_item->save();
        }
        
        
        return [
        'data' => [
        'id' => $template->id,
        'attributes' => [
        'name' => $template->name,
        'checklist' => $template->checklist,
        'items' => $template->items
        ]
        ]
        ];
    }
    
    public function deleteTemplateChecklist($templateId){
        $template = Template::find($templateId);
        
        if (empty($template)) { abort(Response::HTTP_NOT_FOUND, 'not found'); }
        
        $checklist = TemplateChecklist::where('template_id', $templateId)->first();
        $items = TemplateItem::where('template_id', $templateId)->get();
        
        $template->delete();
        $checklist->delete();
        
        foreach($items as $item) {
            $_item = TemplateItem::find($item->id);
            $_item->delete();
        }
        
        return $template;
        
    }
    
    public function assignsBulkChecklist($body, $templateId, $user){
        
        $assigns = $body['data'];
        
        if (!is_array($assigns)) { abort(Response::HTTP_BAD_REQUEST, 'bad request'); }
        if (empty($assigns)) { abort(Response::HTTP_BAD_REQUEST, 'bad request'); }
        
        $checklists = [];
        $included = [];
        
        $template = Template::find($templateId);
        
        if (empty($template)) { abort(Response::HTTP_NOT_FOUND, 'not found'); }
        
        // validate attributes
        foreach($assigns as $assign) {
            if (!isset($assign['attributes']) || empty($assign['attributes'])) { abort(Response::HTTP_BAD_REQUEST, 'bad request'); }
            if (!isset($assign['attributes']['object_id']) || empty($assign['attributes']['object_id'])) { abort(Response::HTTP_BAD_REQUEST, 'bad request'); }
            if (!isset($assign['attributes']['object_domain']) || empty($assign['attributes']['object_domain'])) { abort(Response::HTTP_BAD_REQUEST, 'bad request'); }
        }
        
        foreach($assigns as $assign) {
            
            $checklist = new Checklist();
            $checklist->object_domain = $assign['attributes']['object_domain'];
            $checklist->object_id = $assign['attributes']['object_id'];
            
            $checklist->description = $template->checklist->description;
            $checklist->due = Carbon::now()->add($template->checklist->due_interval, $template->checklist->due_unit);
            $checklist->created_by = $user->id; // TODO: from auth user
            $checklist->save();
            
            
            
            // compose items
            foreach($template->items as $item) {
                $_item = new Item();
                $_item->checklist_id = $checklist->id;
                $_item->description = $item['description'];
                $_item->due = Carbon::now()->add($item['due_interval'], $item['due_unit']);
                $_item->urgency = $item['urgency'];
                $_item->assignee_id = $user->id;
                $_item->save();
                
                array_push($included, [
                'type' => "items",
                'id' => $_item->id,
                'attributes' => $_item,
                'links' =>[
                'self' => "/items/{$_item->id}"
                ]
                ]);
            }
            
            // $checklist->items = $checklist->items;
            
            array_push($checklists, [
            'type' => 'checklists',
            'id' => $checklist->id,
            'attributes' => $checklist,
            'links' => $checklist->links,
            'relationships' => $checklist->relationships
            ]);
            
        }
        
        return [
        'meta' => [
        'count' => count($assigns),
        'total' => count($assigns),
        ],
        'data' => $checklists,
        'included' => $included
        ];
    }
}
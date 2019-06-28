<?php

namespace App\Services;

use App\Item;
use App\Template;
use App\Checklist;
use Carbon\Carbon;
use App\TemplateItem;
use App\TemplateChecklist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TemplatesService
{
    protected $TABLE_TEMPLATE = 'table_template';
    protected $TABLE_TEMPLATE_ITEM = 'table_template_item';
    
    public function listAllChecklistTemplate($filter, $sort){
        $template = Template::with('items')->with('checklist')->get();
        $template_count = Template::count();
        return [
        'meta' => [
        'total' => $template_count,
        'count' => $template_count
        ],
        
        "links" => [
        "first" => "https://kong.command-api.kw.com/api/v1/checklists/templates?page[limit]=10&page[offset]=0",
        "last" => "https://kong.command-api.kw.com/api/v1/checklists/templates?page[limit]=10&page[offset]=10",
        "next" => "https://kong.command-api.kw.com/api/v1/checklists/templates?page[limit]=10&page[offset]=10",
        "prev" => "null"
        ],
        
        'data' => $template
        ];
        // return "SELECT * FROM {$this->TABLE_TEMPLATE} WHERE " . $filter['attr'] . $filter['str'] . $sort;
    }
    
    public function createTemplateChecklist($body){
        // TODO: validate data.attributes
        $input = $body['data']['attributes'];
        $template = new Template();
        $template->name = $input['name'];
        $template->save();
        
        $checklist = new TemplateChecklist();
        $checklist->template_id = $template->id;
        $checklist->description = $input['checklist']['description'];
        $checklist->due_interval = $input['checklist']['due_interval'];
        $checklist->due_unit = $input['checklist']['due_unit'];
        $checklist->save();
        
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
        'attributes' => [
        'name' => $template->name,
        'checklist' => $template->checklist,
        'items' => $template->items
        ]
        ]
        ];
    }
    
    public function getChecklistTemplateByTemplateId($templateId){
        $template = Template::find($templateId);
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
        $template->name = $input['name'];
        $template->save();
        
        $checklist = TemplateChecklist::where('template_id', $templateId)->first();
        $checklist->template_id = $template->id;
        $checklist->description = $input['checklist']['description'];
        $checklist->due_interval = $input['checklist']['due_interval'];
        $checklist->due_unit = $input['checklist']['due_unit'];
        $checklist->save();
        
        
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
    
    public function assignsBulkChecklist($body, $templateId){
        
        $assigns = $body['data'];
        
        $checklists = [];
        
        $template = Template::find($templateId);
        
        foreach($assigns as $assign) {
            $checklist = new Checklist();
            $checklist->object_domain = $assign['attributes']['object_domain'];
            $checklist->object_id = $assign['attributes']['object_id'];
            
            $checklist->description = $template->checklist->description;
            $checklist->due = Carbon::now()->add($template->checklist->due_interval, $template->checklist->due_unit);
            $checklist->created_by = 10; // TODO: from auth user
            $checklist->save();
            
            $checklist->links = $checklist->links;
            
            
            // compose items
            foreach($template->items as $item) {
                $_item = new Item();
                $_item->checklist_id = $checklist->id;
                $_item->description = $item['description'];
                $_item->due = Carbon::now()->add($item['due_interval'], $item['due_unit']);
                $_item->urgency = $item['urgency'];
                $_item->save();
            }
            
            $checklist->items = $checklist->items;
            
            array_push($checklists, [
            'type' => 'checklists',
            'id' => $checklist->id,
            'attributes' => $checklist
            ]);
            
        }
        
        return [
        'meta' => [
        'count' => count($assigns),
        'total' => count($assigns),
        ],
        'data' => $checklists
        ];
    }
}
<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class UpdateChecklistsTemplateTest extends TestCase
{
    /**
    * Update
    */
    // match json request and response
    public function testUpdateChecklistsTemplate(){
        $user = factory(App\User::class)->create();
        $this->actingAs($user);
        
        $this->call('PATCH', '/api/v1/checklists/templates/1', array (
        'data' =>
        array (
        'attributes' =>
        array (
        'name' => 'xfoo template',
        'checklist' =>
        array (
        'description' => 'my checklist',
        'due_interval' => 3,
        'due_unit' => 'hour',
        ),
        'items' =>
        array (
        0 =>
        array (
        'description' => 'my foo item',
        'urgency' => 2,
        'due_interval' => 40,
        'due_unit' => 'minute',
        ),
        1 =>
        array (
        'description' => 'my bar item',
        'urgency' => 3,
        'due_interval' => 30,
        'due_unit' => 'minute',
        ),
        ),
        ),
        ),
        ));
        $this->seeStatusCode(202);
    }
    public function testUpdateChecklistsTemplateWithoutTemplateId(){
        $user = factory(App\User::class)->create();
        $this->actingAs($user);
        
        $this->call('PATCH', '/api/v1/checklists/templates', array (
        'data' =>
        array (
        'attributes' =>
        array (
        'name' => 'xfoo template',
        'checklist' =>
        array (
        'description' => 'my checklist',
        'due_interval' => 3,
        'due_unit' => 'hour',
        ),
        'items' =>
        array (
        0 =>
        array (
        'description' => 'my foo item',
        'urgency' => 2,
        'due_interval' => 40,
        'due_unit' => 'minute',
        ),
        1 =>
        array (
        'description' => 'my bar item',
        'urgency' => 3,
        'due_interval' => 30,
        'due_unit' => 'minute',
        ),
        ),
        ),
        ),
        ));
        $this->seeStatusCode(405);
    }
    public function testUpdateChecklistsMissingNameInRequestBody(){
        $user = factory(App\User::class)->create();
        $this->actingAs($user);
        
        $this->call('PATCH', '/api/v1/checklists/templates/1', array (
        'data' =>
        array (
        'attributes' =>
        array (
        'checklist' =>
        array (
        'description' => 'my checklist',
        'due_interval' => 3,
        'due_unit' => 'hour',
        ),
        'items' =>
        array (
        0 =>
        array (
        'description' => 'my foo item',
        'urgency' => 2,
        'due_interval' => 40,
        'due_unit' => 'minute',
        ),
        1 =>
        array (
        'description' => 'my bar item',
        'urgency' => 3,
        'due_interval' => 30,
        'due_unit' => 'minute',
        ),
        ),
        ),
        ),
        ));
        $this->seeStatusCode(202);
    }
    public function testUpdateChecklistsMissingChecklistItemsInRequestBody(){
        $user = factory(App\User::class)->create();
        $this->actingAs($user);
        
        $this->call('PATCH', '/api/v1/checklists/templates/1', array (
        'data' =>
        array (
        'attributes' =>
        array (
        'name' => 'xfoo template',
        'checklist' =>
        array (
        'description' => 'my checklist',
        'due_interval' => 3,
        'due_unit' => 'hour',
        ),
        
        ),
        ),
        ));
        $this->seeStatusCode(400);
    }
    public function testUpdateChecklistsTemplateTemplateIdAsQueryUrl(){
        $user = factory(App\User::class)->create();
        $this->actingAs($user);
        
        $this->call('PATCH', '/api/v1/checklists/templates?templateId=1', array (
        'data' =>
        array (
        'attributes' =>
        array (
        'name' => 'xfoo template',
        'checklist' =>
        array (
        'description' => 'my checklist',
        'due_interval' => 3,
        'due_unit' => 'hour',
        ),
        
        ),
        ),
        ));
        $this->seeStatusCode(405);
    }
    
    public function testUpdateChecklistsTemplateResponse(){
        $user = factory(App\User::class)->create();
        $this->actingAs($user);
        
        $this->call('PATCH', '/api/v1/checklists/templates/1', array (
        'data' =>
        array (
        'attributes' =>
        array (
        'name' => 'xfoo template',
        'checklist' =>
        array (
        'description' => 'my checklist',
        'due_interval' => 3,
        'due_unit' => 'hour',
        ),
        'items' =>
        array (
        0 =>
        array (
        'description' => 'my foo item',
        'urgency' => 2,
        'due_interval' => 40,
        'due_unit' => 'minute',
        ),
        1 =>
        array (
        'description' => 'my bar item',
        'urgency' => 3,
        'due_interval' => 30,
        'due_unit' => 'minute',
        ),
        ),
        ),
        ),
        ));
        $this->seeJson(['name' => 'xfoo template']);
    }
    
}
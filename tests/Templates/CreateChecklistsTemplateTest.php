<?php

use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CreateChecklistsTemplateTest extends TestCase
{
    /**
    * Create
    */
    public function testCreateChecklistsTemplates(){
        $user = factory(App\User::class)->create();
        $this->actingAs($user);
        
        $this->post('/api/v1/checklists/templates', array (
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
        $this->seeStatusCode(Response::HTTP_CREATED);
        
    }
    
    public function testCreateChecklistsTemplatesBadRequest(){
        $user = factory(App\User::class)->create();
        $this->actingAs($user);
        
        $this->post('/api/v1/checklists/templates', []);
        $this->seeStatusCode(Response::HTTP_BAD_REQUEST);
    }
    public function testCreateChecklistsTemplatesUnauthorized(){
        $this->post('/api/v1/checklists/templates', []);
        $this->seeStatusCode(Response::HTTP_UNAUTHORIZED);
        
    }
    public function testCreateChecklistsTemplatesMissingItemsInRequestBody(){
        $user = factory(App\User::class)->create();
        $this->actingAs($user);
        
        $this->post('/api/v1/checklists/templates', array (
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
        
        ),
        ),
        ),
        ));
        $this->seeStatusCode(Response::HTTP_BAD_REQUEST);
        
    }
    public function testCreateChecklistsTemplatesMissingNameInRequestBody(){
        $user = factory(App\User::class)->create();
        $this->actingAs($user);
        
        $this->post('/api/v1/checklists/templates', array (
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
        $this->seeStatusCode(Response::HTTP_CREATED);
        
    }
    public function testCreateChecklistsTemplatesItemsNotArray(){
        $user = factory(App\User::class)->create();
        $this->actingAs($user);
        
        $this->post('/api/v1/checklists/templates', array (
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
        'ok!'
        ),
        ),
        ));
        $this->seeStatusCode(Response::HTTP_BAD_REQUEST);
    }
    public function testCreateChecklistsTemplatesResponse(){
        $user = factory(App\User::class)->create();
        $this->actingAs($user);
        
        $response = $this->post('/api/v1/checklists/templates', array (
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
<?php

use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AssignBulkChecklistsTemplateTest extends TestCase
{
    public function testAssignBulkChecklistTemplate(){
        $user = factory(App\User::class)->create();
        $this->actingAs($user);
        
        $this->post('/api/v1/checklists/templates/10/assigns', array (
        'data' =>
        array (
        0 =>
        array (
        'attributes' =>
        array (
        'object_id' => 1,
        'object_domain' => 'deals',
        ),
        ),
        1 =>
        array (
        'attributes' =>
        array (
        'object_id' => 2,
        'object_domain' => 'deals',
        ),
        ),
        2 =>
        array (
        'attributes' =>
        array (
        'object_id' => 3,
        'object_domain' => 'deals',
        ),
        ),
        ),
        ));
        
        $this->seeStatusCode(Response::HTTP_CREATED);
    }
    public function testAssignBulkChecklistTemplateResponse(){
        $user = factory(App\User::class)->create();
        $this->actingAs($user);
        
        $this->post('/api/v1/checklists/templates/10/assigns', array (
        'data' =>
        array (
        0 =>
        array (
        'attributes' =>
        array (
        'object_id' => 1,
        'object_domain' => 'deals',
        ),
        ),
        1 =>
        array (
        'attributes' =>
        array (
        'object_id' => 2,
        'object_domain' => 'deals',
        ),
        ),
        2 =>
        array (
        'attributes' =>
        array (
        'object_id' => 3,
        'object_domain' => 'deals',
        ),
        ),
        ),
        ));
        
        $this->seeJson(['type' => 'checklists']);
    }
    public function testAssignBulkChecklistTemplateEmptyData(){
        $user = factory(App\User::class)->create();
        $this->actingAs($user);
        
        $this->post('/api/v1/checklists/templates/10/assigns', array (
        'data' =>
        array (
        
        )));
        
        $this->seeStatusCode(Response::HTTP_BAD_REQUEST);
    }
    public function testAssignBulkChecklistTemplateEmptyAttributes(){
        $user = factory(App\User::class)->create();
        $this->actingAs($user);
        
        $this->post('/api/v1/checklists/templates/10/assigns', array (
        'data' =>
        array (
        0 =>
        array (
        'attributes' =>
        array (
        'object_id' => 1,
        'object_domain' => 'deals',
        ),
        ),
        1 =>
        array (
        'attributes' =>
        array (
        'object_id' => 2,
        'object_domain' => 'deals',
        ),
        ),
        2 =>
        array (
        'attributes' =>
        array (
        
        ),
        ),
        ),
        ));
        
        $this->seeStatusCode(Response::HTTP_BAD_REQUEST);
    }
    public function testAssignBulkChecklistTemplateMissingObjectId(){
        $user = factory(App\User::class)->create();
        $this->actingAs($user);
        
        $this->post('/api/v1/checklists/templates/10/assigns', array (
        'data' =>
        array (
        0 =>
        array (
        'attributes' =>
        array (
        
        'object_domain' => 'deals',
        ),
        ),
        1 =>
        array (
        'attributes' =>
        array (
        
        'object_domain' => 'deals',
        ),
        ),
        2 =>
        array (
        'attributes' =>
        array (
        
        'object_domain' => 'deals',
        ),
        ),
        ),
        ));
        
        $this->seeStatusCode(Response::HTTP_BAD_REQUEST);
    }
    public function testAssignBulkChecklistTemplateMissingObjectDomain(){
        $user = factory(App\User::class)->create();
        $this->actingAs($user);
        
        $this->post('/api/v1/checklists/templates/10/assigns', array (
        'data' =>
        array (
        0 =>
        array (
        'attributes' =>
        array (
        'object_id' => 1,
        
        ),
        ),
        1 =>
        array (
        'attributes' =>
        array (
        'object_id' => 2,
        
        ),
        ),
        2 =>
        array (
        'attributes' =>
        array (
        'object_id' => 3,
        
        ),
        ),
        ),
        ));
        
        $this->seeStatusCode(Response::HTTP_BAD_REQUEST);
    }
    public function testAssignBulkChecklistTemplateDataNotArray(){
        $user = factory(App\User::class)->create();
        $this->actingAs($user);
        
        $this->post('/api/v1/checklists/templates/10/assigns', array (
        'data' => ''));
        
        $this->seeStatusCode(Response::HTTP_BAD_REQUEST);
    }
    
    public function testAssignBulkChecklistTemplateTemplateIdIsQueryUrl(){
        $user = factory(App\User::class)->create();
        $this->actingAs($user);
        
        $this->post('/api/v1/checklists/templates/assigns?templateId=10', array (
        'data' =>
        array (
        0 =>
        array (
        'attributes' =>
        array (
        'object_id' => 1,
        'object_domain' => 'deals',
        ),
        ),
        1 =>
        array (
        'attributes' =>
        array (
        'object_id' => 2,
        'object_domain' => 'deals',
        ),
        ),
        2 =>
        array (
        'attributes' =>
        array (
        'object_id' => 3,
        'object_domain' => 'deals',
        ),
        ),
        ),
        ));
        
        $this->seeStatusCode(Response::HTTP_NOT_FOUND);
    }
    
}
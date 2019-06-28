<?php

use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class GetChecklistsTemplateTest extends TestCase
{
    // match json response
    // with templateID
    public function testGetChecklistsTemplate() {
        $user = factory(App\User::class)->create();
        $this->actingAs($user);
        
        $this->get('/api/v1/checklists/templates/1');
        $this->seeStatusCode(Response::HTTP_FOUND);
    }
    public function testGetChecklistsTemplateWithoutTemplateId(){
        $user = factory(App\User::class)->create();
        $this->actingAs($user);
        
        $this->get('/api/v1/checklists/templates');
        $this->seeStatusCode(Response::HTTP_BAD_REQUEST);
    }
    public function testGetChecklistsTemplateTemplateIdAsQueryUrl(){
        $user = factory(App\User::class)->create();
        $this->actingAs($user);
        
        $this->get('/api/v1/checklists/templates?templateId=1');
        $this->seeStatusCode(Response::HTTP_BAD_REQUEST);
    }
    public function testGetChecklistsTemplateResponse() {
        $user = factory(App\User::class)->create();
        $this->actingAs($user);
        
        $this->get('/api/v1/checklists/templates/5');
        $this->seeJson(['self' => '/checklists/templates/5']);
    }
    public function testGetChecklistsTemplateNotFound() {
        $user = factory(App\User::class)->create();
        $this->actingAs($user);
        
        $this->get('/api/v1/checklists/templates/1');
        $this->seeStatusCode(Response::HTTP_NOT_FOUND);
    }
}
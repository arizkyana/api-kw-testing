<?php

use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class DeleteChecklistTemplateTest extends TestCase
{
    public function testDeleteTemplate(){
        $user = factory(App\User::class)->create();
        $this->actingAs($user);
        
        $this->call("DELETE", '/api/v1/checklists/templates/4');
        $this->seeStatusCode(Response::HTTP_NO_CONTENT || Response::HTTP_NOT_FOUND);
    }
    public function testDeleteWithoutTemplateId(){
        $user = factory(App\User::class)->create();
        $this->actingAs($user);
        
        $this->call("DELETE", '/api/v1/checklists/templates');
        $this->seeStatusCode(Response::HTTP_METHOD_NOT_ALLOWED);
    }
    public function testDeleteTemplateIdAsQueryUrl(){
        $user = factory(App\User::class)->create();
        $this->actingAs($user);
        
        $this->call("DELETE", '/api/v1/checklists/templates?templateId=5');
        $this->seeStatusCode(Response::HTTP_METHOD_NOT_ALLOWED);
    }
    public function testDeleteTemplateResponse(){
        $user = factory(App\User::class)->create();
        $this->actingAs($user);
        
        $response = $this->call("DELETE", '/api/v1/checklists/templates/11');
        $this->seeStatusCode(Response::HTTP_NO_CONTENT);
    }
    public function testDeleteTemplateUnauthorized(){
        $this->call("DELETE", '/api/v1/checklists/templates/8');
        $this->seeStatusCode(Response::HTTP_UNAUTHORIZED);
    }
    public function testDeleteTemplateHasBeenDeleted(){
        $user = factory(App\User::class)->create();
        $this->actingAs($user);
        
        $this->call("DELETE", '/api/v1/checklists/templates/7');
        $this->seeStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR || Response::HTTP_NOT_FOUND);
    }
}
<?php

use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
    * A basic test example.
    *
    * @return void
    */
    public function testAccessApi()
    {
        $this->get('/');
        $this->assertEquals(
        $this->app->version(), $this->response->getContent()
        );
    }
    
    public function testNotFound(){
        $this->get('/x');
        $this->seeStatusCode(Response::HTTP_NOT_FOUND);
    }
    public function testServerError(){
        $user = factory(App\User::class)->create();
        $this->actingAs($user);
        
        $this->post('/e');
        $this->seeStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
    }
    public function testUnauthorized(){
        
        $this->post('/api/v1/checklists/templates');
        $this->seeStatusCode(Response::HTTP_UNAUTHORIZED);
    }
    
}
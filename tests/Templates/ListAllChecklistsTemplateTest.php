<?php

use App\Utils\RequestParser;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ListAllChecklistsTemplateTest extends TestCase
{
    use RequestParser;
    // match json response
    // assertEqual
    public function testListAllChecklistsTemplates(){
        $user = factory(App\User::class)->create();
        $this->actingAs($user);
        
        $this->get('/api/v1/checklists/templates?filter[name][like]=foo*&sort=-name&page[limit]=20&page[offset]=0');
        $this->seeStatusCode(200);
    }
    
    public function testListAllChecklistsTemplatesBadRequest(){
        $user = factory(App\User::class)->create();
        $this->actingAs($user);
        
        $this->get('/api/v1/checklists/templates?filter[name][like]=foo*&sort=-name&page[]=20&page[offset]=0');
        $this->seeStatusCode(404);
    }
    
    public function testListAllChecklistsTemplatesUnauthorized(){
        
        $this->get('/api/v1/checklists/templates?filter[name][like]=foo*&sort=-name&page[limit]=20&page[offset]=0');
        $this->seeStatusCode(401);
    }
    
    public function testListAllChecklistsTemplatesMissingOrEmptyFilter(){
        $filter = $this->filtering([]);
        $this->assertNull($filter);
    }
    public function testListAllChecklistsTemplatesMissingOrEmptySort(){
        $sort = $this->sorting("");
        $this->assertNull($sort);
    }
    public function testListAllChecklistsTemplatesMissingOrEmptyFields(){
        $filter = $this->filtering(["filter" => ["name"=>["agung"]]]);
        $this->assertNull($filter['str']);
    }
    public function testListAllChecklistsTemplatesMissingOrEmptyPageLimitOffset(){
        $page_limit = $this->limit([]);
        $this->assertArrayHasKey('error', $page_limit);
    }
    
    public function testListAllChecklistsTemplatesPageLimitLowerThanZero(){
        $page_limit = $this->limit(['limit' => -10, 'offset' => 1]);
        $this->assertArrayHasKey('error', $page_limit);
    }
    public function testListAllChecklistsTemplatesPageOffsetLowerThanZero(){
        $page_limit = $this->limit(['limit' => 10, 'offset' => -1]);
        $this->assertArrayHasKey('error', $page_limit);
    }
    
    
    
}
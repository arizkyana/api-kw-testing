<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ListAllChecklistsTemplateTest extends TestCase
{
    // match json response
    // assertEqual
    public function testListAllChecklist(){
        $this->get('/checklists/template?filter=object_domain&sort=name&');
        $this->seeStatusCode(200);
        $this->seeJson(["message" => "template"]);
    }
    
    public function testListAllChecklistMissingOrEmptyFilter(){
        $this->get("/checklists/template?sort={sort}");
        $this->seeStatusCode(400);
        $this->seeJson(["message" => "sort query is required"]);
    }
    public function testListAllChecklistMissingOrEmptySort(){}
    public function testListAllChecklistMissingOrEmptyFields(){}
    public function testListAllChecklistMissingOrEmptyPageLimit(){}
    public function testListAllChecklistMissingOrEmptyPageOffset(){}
    
    public function testListAllChecklistPageLimitLowerThanZero(){}
    public function testListAllChecklistPageOffsetLowerThanZero(){}
    
    
    
}
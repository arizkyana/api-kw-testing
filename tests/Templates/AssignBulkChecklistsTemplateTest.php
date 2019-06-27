<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AssignBulkChecklistsTemplateTest extends TestCase
{
    /**
    * A basic test example.
    *
    * @return void
    */
    public function testQueryParamaterCompleted()
    {
        $this->get('/x');
        
        $this->assertEquals(
        $this->app->version(), $this->response->getContent()
        );
    }
    
    public function testQueryParameterMissingFilter(){
        
    }
    
    public function testQueryParameterMissingSort(){
        
    }
    
    public function testQueryParameterMissingFields(){
        
    }
    
    public function testQueryParameterMissingPageLimit(){
        
    }
    
    public function testQueryParameterMissingPageOffset(){
        
    }
    
    public function testQueryParameterPageLimitLowerThanZero(){
        
    }
    
    public function testQueryParameterPageOffsetLowerThanZero(){
        
    }
    
    // match json response
    public function testListAllChecklist(){ // assertEqual
        
    }
    
    public function testCreateChecklist(){
        
    }
    
    public function testCreateChecklistMissingItemsInRequestBody(){
        
    }
    
    public function testCreateChecklistMissingNameInRequestBody(){
        
    }
    
    public function testCreateChecklistItemsNotArray(){
        
    }
    
    public function testCreateChecklistMissingChecklistItemsInRequestBody() {
        
    }
    
    // match json response
    public function testGetChecklistsTemplate() { // with templateID
    }
    
    public function testGetChecklistsTemplateWithoutTemplateId(){
        
    }
    
    
    
    
    
    
    
    
}
<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ListAllChecklistsTemplateTest extends TestCase
{
    
    // match json response
    // assertEqual
    public function testListAllChecklist(){
        
    }
    
    public function testListAllChecklistMissingOrEmptyFilter(){}
    public function testListAllChecklistMissingOrEmptySort(){}
    public function testListAllChecklistMissingOrEmptyFields(){}
    public function testListAllChecklistMissingOrEmptyPageLimit(){}
    public function testListAllChecklistMissingOrEmptyPageOffset(){}
    
    public function testListAllChecklistPageLimitLowerThanZero(){}
    public function testListAllChecklistPageOffsetLowerThanZero(){}
    
    
    
}
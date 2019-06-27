<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CreateChecklistsTemplateTest extends TestCase
{
    /**
    * Create
    */
    public function testCreateChecklist(){}
    public function testCreateChecklistMissingItemsInRequestBody(){}
    public function testCreateChecklistMissingNameInRequestBody(){}
    public function testCreateChecklistItemsNotArray(){}
    public function testCreateChecklistMissingChecklistItemsInRequestBody() {}
}
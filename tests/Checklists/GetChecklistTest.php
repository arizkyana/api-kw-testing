<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class GetChecklistTest extends TestCase
{
    public function testGetChecklist(){}
    public function testGetChecklistWithoutChecklistId(){}
    public function testGetChecklistWithChecklistIdAsQueryUrl(){}
    public function testGetChecklistMissingInclude(){}
    public function testGetChecklistMissingFilter(){}
    public function testGetChecklistMissingSort(){}
    public function testGetChecklistMissingFields(){}
    public function testGetChecklistMissingPageLimit(){}
    public function testGetChecklistMissingPageOffset(){}
    public function testGetChecklistWithPageLimitLowerThanZero(){}
    public function testGetChecklistWithPageOffsetLowerThanZero(){}
}
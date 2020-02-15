<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\FeedCategory;

class FeedCategoryTest extends TestCase
{
    use RefreshDatabase;

    public function testGetCategoryIdByName() {
        // Insert 1 new.
        $id = FeedCategory::getCategoryIdByName('Example name');
        $this->assertGreaterThan(1, $id);

        // If same name then get the Id.
        $id1 = FeedCategory::getCategoryIdByName('Example name');
        $this->assertEquals($id, $id1);
    }
}

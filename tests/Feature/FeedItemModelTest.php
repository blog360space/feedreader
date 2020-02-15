<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\FeedItem;
use Illuminate\Support\Facades\DB;

class FeedItemModelTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

    }

    public function testSearch() {
        // Prepare data.
        DB::table('feed_items')->insert([
            'title' => 'Title example',
            'category_id' => 1,
            'description' => 'Description example',
            'link' => 'http://example.com',
            'comment' => 'Comment example',
            'pub_date' => time()
        ]);

        $result = FeedItem::search([
            'category_id' => 1
        ]);
        $this->assertEquals(1, $result->count());

        $result = FeedItem::search();
        $this->assertEquals(1, $result->count());
    }
}

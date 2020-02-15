<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Libraries\FeedHelper;

class FeedHelperTest extends TestCase
{
    use RefreshDatabase;

    public function testGrabFeeds() {
        $feedUrls = [
            'https://tuoitre.vn/rss/tin-moi-nhat.rss'
        ];
        $this->assertEmpty(FeedHelper::grabFeeds($feedUrls));
    }
}

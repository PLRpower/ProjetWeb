<?php

use App\Models\Wishlist;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../database/database.php';

function createRandomWishlist(): Wishlist
{
    $student = createRandomStudent();
    $offer = createRandomOffer();

    return Wishlist::create([
        'student_id' => $student->id,
        'offer_id' => $offer->id
    ]);
}

class WishlistsTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        for ($i = 0; $i < 10; $i++) {
            createRandomWishlist();
        }
    }

    public function testGetWishlist()
    {
        $wishlist = Wishlist::first();

        $this->assertNotNull($wishlist);
    }
}

<?php

use App\Models\Offer;
use App\Models\Student;
use App\Models\Wishlist;
use PHPUnit\Framework\Attributes\DependsExternal;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../database/database.php';
require_once __DIR__ . '/OffersTest.php';
require_once __DIR__ . '/StudentsTest.php';

function createRandomWishlist(): ?Wishlist
{
    $offer = Offer::inRandomOrder()->first();
    $student = Student::inRandomOrder()->first();
    $wishilist = Wishlist::where('student_id', $student->id)
        ->where('offer_id', $offer->id)
        ->first();

    if ($wishilist or !$offer or !$student) {
        return null;
    }

    return Wishlist::create([
        'student_id' => $student->id,
        'offer_id' => $offer->id
    ]);
}

class WishlistsTest extends TestCase
{
    #[DependsExternal(OffersTest::class, 'testGetOffer')]
    #[DependsExternal(StudentsTest::class, 'testGetStudent')]
    public static function setUpBeforeClass(): void
    {
        for ($i = 0; $i < 30; $i++) {
            createRandomWishlist();
        }
    }

    #[DependsExternal(OffersTest::class, 'testGetOffer')]
    #[DependsExternal(StudentsTest::class, 'testGetStudent')]
    public function testGetWishlist()
    {
        $wishlist = Wishlist::first();

        $this->assertNotNull($wishlist);
    }
}

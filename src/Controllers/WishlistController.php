<?php

namespace App\Controllers;

use App\Models\Offer;
use App\Models\Wishlist;
use App\Utils\Auth;

class WishlistController extends Controller
{
    public function __construct($twig)
    {
        $this->twig = $twig;
    }

    public function wishlist(): void
    {
        if (Auth::checkRole(['student', 'admin'])) {
            $user = Auth::getUser();
            $wishlist = Wishlist::where('student_id', $user->id)->get();
            $paginatedWishlist = paginate($wishlist);
            echo $this->twig->render('wishlist.twig', $paginatedWishlist);
        } else {
            header('Location: /connexion');
        }
    }

    public function ajouterWishlist(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (Auth::checkRole(['student'])) {
                $user = Auth::getUser();
                $offerId = validate_input($_POST['offer_id'], 'int');
                $offer = Offer::findOrFail($offerId);
                if ($offer) {
                    $existingWishlist = Wishlist::where('student_id', $user->id)
                        ->where('offer_id', $offerId)
                        ->exists();
                    if ($existingWishlist) {
                        Wishlist::where('student_id', $user->id)
                            ->where('offer_id', $offerId)
                            ->delete();
                    } else {
                        Wishlist::create([
                            'student_id' => $user->id,
                            'offer_id' => $offerId,
                        ]);
                    }
                    header('Location: /wishlist');
                } else {
                    die('Offre non trouvée.');
                }
            } else {
                die('Vous devez être connecté pour ajouter une offre à votre wishlist.');
            }
        }
    }
}

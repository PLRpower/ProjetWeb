<?php

namespace App\Controllers;

use App\Models\Evaluation;
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
        if (Auth::checkRole(['student'])) {
            $user = Auth::getUser();
            $wishlist = Wishlist::where('student_id', $user->id)->get();
            $paginatedWishlist = paginate($wishlist);
            echo $this->twig->render('crud.twig', $paginatedWishlist);
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
                    Wishlist::create([
                        'student_id' => $user->id,
                        'offer_id' => $offerId,
                    ]);
                    die('Offre ajoutée à la wishlist.');
                } else {
                    die('Offre non trouvée.');
                }
            } else {
                die('Vous devez être connecté pour ajouter une offre à votre wishlist.');
            }
        }
    }
}

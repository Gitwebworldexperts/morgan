<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index(){

            $user = Auth::user();
            $wishList = Wishlist::where('user_id', $user->id)->get();
           
           return view('wishList', compact('wishList'));
    }
    public function store(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Check if the product is already in the wishlist
            $existingWishlistItem = Wishlist::where('user_id', $user->id)
                                            ->where('product_slug', $request->product_slug)
                                            ->first();


            if (!$existingWishlistItem) {
                // Add the product to the wishlist
                Wishlist::create([
                    'user_id' => $user->id,
                    'product_slug' => $request->product_slug,
                    'product_type' => $request->product_type,
                    'product_id' => $request->product_id,
                ]);
                return response()->json(['message' => 'Product added to wishlist!']);
            }else{
                $existingWishlistItem->delete();
                return response()->json(['message' => 'Product removed from wishlist!']);
            }

           
        }

        return response()->json(['message' => 'You must be logged in to add to wishlist!'], 403);
    }
}

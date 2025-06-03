<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carts;
use App\Models\Cartitems;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Tampilkan isi cart user
    public function index()
    {
        $cart = Carts::where('user_id', Auth::user()->user_id)->with('items.product')->first();
        return view('cart.index', compact('cart'));
    }

    // Tambah produk ke cart
    public function add(Request $request, $productid)
    {
        $user = Auth::user();
        $cart = Carts::firstOrCreate(['user_id' => $user->user_id]);
        $item = Cartitems::where('cart_id', $cart->id)->where('productid', $productid)->first();

        if ($item) {
            $item->quantity += $request->input('quantity', 1);
            $item->save();
        } else {
            Cartitems::create([
                'cart_id' => $cart->id,
                'productid' => $productid,
                'quantity' => $request->input('quantity', 1),
            ]);
        }

        return redirect('/productcart');
    }

    // Hapus item dari cart
    public function remove($itemid)
    {
        $item = Cartitems::findOrFail($itemid);
        $item->delete();
        return redirect()->back()->with('success', 'Item removed from cart!');
    }

    public function productcart()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        $cart = Carts::where('user_id', Auth::user()->user_id)->with(['items.product'])->first();
        return view('user.product.productcart', compact('cart'));
    }

    public function updateQuantity(Request $request)
    {
        $request->validate([
            'item_id' => 'required|integer|exists:cartitems,id',
            'quantity' => 'required|integer|min:1',
        ]);
        $item = Cartitems::findOrFail($request->item_id);
        $item->quantity = $request->quantity;
        $item->save();
        return response()->json(['success' => true]);
    }
    public function deleteItems(Request $request)
    {
        $request->validate([
            'item_ids' => 'required|array',
            'item_ids.*' => 'integer|exists:cartitems,id',
        ]);
        \App\Models\CartItems::whereIn('id', $request->item_ids)->delete();
        return response()->json(['success' => true]);
    }
}
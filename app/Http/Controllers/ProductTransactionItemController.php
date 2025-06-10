<?php

namespace App\Http\Controllers;

use App\Models\ProductTransactionItem;
use Illuminate\Http\Request;

class ProductTransactionItemController extends Controller
{
    // Tampilkan semua item detail transaksi untuk 1 transaksi
    public function index($transaction_id)
    {
        $items = ProductTransactionItem::where('transaction_id', $transaction_id)->get();
        return view('user.product.transaction_items', compact('items'));
    }

    // Tampilkan detail satu item
    public function show($id)
    {
        $item = ProductTransactionItem::findOrFail($id);
        return view('user.product.transaction_item_detail', compact('item'));
    }

    // (Opsional) Tambah, edit, hapus bisa ditambahkan sesuai kebutuhan
}
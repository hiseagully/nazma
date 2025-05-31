<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    rel="stylesheet"
  />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap"
    rel="stylesheet"
  />
  <link rel="stylesheet" href="{{ asset('css/product/productcart.css') }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<x-header></x-header>
<x-productsearchbox></x-productsearchbox>
<body class="body-bg flex flex-col min-h-[calc(100vh-144px)] px-6 md:px-0">
<main class="cart-container">
    <div class="flex justify-between items-center mb-1">
      <h2 class="font-semibold text-lg text-black">
      Cart
      </h2>
      <label class="flex items-center text-black text-sm cursor-pointer select-none" for="selectAll">
      <input class="w-5 h-5 border border-gray-300 rounded-full checked:bg-white checked:border-gray-300 checked:ring-0 focus:ring-0" id="selectAll" type="checkbox"/>
      <span class="ml-2">
        Select All
      </span>
      </label>
    </div>
    <div class="cart-items-grid"> 
      @if($cart && $cart->items->count())
        @php $total = 0; @endphp
        @foreach($cart->items as $item)
          @php
            $product = $item->product;
            $subtotal = $product ? $product->productpricedollar * $item->quantity : 0;
            $total += $subtotal;
            $image = $product && $product->images->where('is_thumbnail', true)->first() ? asset('storage/' . $product->images->where('is_thumbnail', true)->first()->image_path) : asset('images/noimage.png');
          @endphp
          <div class="cart-item">
            <label class="w-6 h-6 border border-gray-300 rounded flex-shrink-0 cursor-pointer" for="product{{ $item->id }}">
              <input class="w-6 h-6 rounded border border-gray-300 checked:bg-white checked:border-gray-300 checked:ring-0 focus:ring-0 cursor-pointer" id="product{{ $item->id }}" name="productSelect[]" type="checkbox" value="{{ $item->id }}"/>
            </label>
            <img
              src="{{ $image }}"
              alt="{{ $product->productname ?? '-' }}"
              class="cart-item-image"
              width="96"
              height="96"
            />
            <div class="cart-item-text">
              <p class="cart-item-category">{{ $product->catalog->productcatalogname ?? '-' }}</p>
              <p class="cart-item-name">{{ $product->productname ?? '-' }}</p>
              <p class="text-sm font-semibold text-black">
              Qty:
              <button aria-label="Decrease quantity" class="inline-block px-1 font-normal text-black qty-decrease" data-id="{{ $item->id }}">
                -
              </button>
              <span class="inline-block px-1 font-normal" id="qty-{{ $item->id }}">
                {{ $item->quantity ?? '-' }}
              </span>
              <button aria-label="Increase quantity" class="inline-block px-1 font-normal text-black qty-increase" data-id="{{ $item->id }}">
                +
              </button>
              </p>
              <p class="cart-item-qty">$ {{ $product->productpricedollar ?? '-' }}</p>
            </div>
          </div>
        @endforeach
      @else
        <div class="text-gray-500">Cart is empty.</div>
      @endif
    </div>

    <div class="flex justify-between items-center">
      <div>
      <p id="selectedCount" class="font-semibold text-black text-sm mb-1">
        0 Product
      </p>
      <p class="text-black text-sm flex items-center gap-3">
        Total
        <span class="text-orange-500 font-semibold" id="totalPrice">
        $0.00
        </span>
        <span id="deleteSelected" class="hidden text-black-300 font-medium cursor-pointer hover:underline select-none" style="margin-left:1rem;">
          <i class="fas fa-trash-alt mr-1 text-black-300" style="font-size: 1em;"></i>Delete
        </span>
      </p>
      </div>
    <button class="bg-gradient-to-r from-orange-400 to-orange-500 text-white font-semibold rounded-full px-8 py-3 hover:brightness-110 transition">
     Checkout
    </button>
   </div>
  </main>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const selectAll = document.getElementById('selectAll');
    const productCheckboxes = document.querySelectorAll('input[name="productSelect[]"]');
    const selectedCount = document.getElementById('selectedCount');
    const totalPrice = document.getElementById('totalPrice');
    const deleteBtn = document.getElementById('deleteSelected');
    // Ambil mapping id item ke harga dan qty dari blade
    const itemData = {
      @foreach($cart->items as $item)
        {{ $item->id }}: {
          price: {{ $item->product ? $item->product->productpricedollar : 0 }},
          qty: {{ $item->quantity }}
        },
      @endforeach
    };
    function updateSelectedCount() {
      const checked = Array.from(productCheckboxes).filter(cb => cb.checked).length;
      selectedCount.textContent = checked + ' Product' + (checked > 1 ? 's' : '');
    }
    function updateTotal() {
      let total = 0;
      productCheckboxes.forEach(cb => {
        if (cb.checked) {
          const id = cb.value;
          if (itemData[id]) {
            total += itemData[id].price * itemData[id].qty;
          }
        }
      });
      totalPrice.textContent = '$' + total.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
    }
    function updateDeleteBtn() {
      const checked = Array.from(productCheckboxes).filter(cb => cb.checked).length;
      deleteBtn.style.display = checked > 0 ? 'inline' : 'none';
    }
    function updateAllUI() {
      updateSelectedCount();
      updateTotal();
      updateDeleteBtn();
    }
    selectAll.addEventListener('change', function() {
      productCheckboxes.forEach(cb => {
        cb.checked = selectAll.checked;
      });
      updateAllUI();
    });
    productCheckboxes.forEach(cb => {
      cb.addEventListener('change', function() {
        if (!cb.checked) {
          selectAll.checked = false;
        } else if (Array.from(productCheckboxes).every(c => c.checked)) {
          selectAll.checked = true;
        }
        updateAllUI();
      });
    });
    // Quantity update logic
    function updateQuantity(itemId, newQty) {
      fetch('/cart/update-quantity', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ item_id: itemId, quantity: newQty })
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          document.getElementById('qty-' + itemId).textContent = newQty;
          itemData[itemId].qty = newQty;
          updateTotal();
        } else {
          alert('Failed to update quantity');
        }
      });
    }
    document.querySelectorAll('.qty-increase').forEach(btn => {
      btn.addEventListener('click', function(e) {
        e.preventDefault();
        const id = this.getAttribute('data-id');
        const qtySpan = document.getElementById('qty-' + id);
        let qty = parseInt(qtySpan.textContent);
        qty++;
        updateQuantity(id, qty);
      });
    });
    document.querySelectorAll('.qty-decrease').forEach(btn => {
      btn.addEventListener('click', function(e) {
        e.preventDefault();
        const id = this.getAttribute('data-id');
        const qtySpan = document.getElementById('qty-' + id);
        let qty = parseInt(qtySpan.textContent);
        if (qty > 1) {
          qty--;
          updateQuantity(id, qty);
        }
      });
    });
    // Delete selected items
    deleteBtn.addEventListener('click', function() {
      const selectedIds = Array.from(productCheckboxes).filter(cb => cb.checked).map(cb => cb.value);
      if (selectedIds.length === 0) return;
      if (!confirm('Delete selected product(s) from cart?')) return;
      fetch('/cart/delete-items', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ item_ids: selectedIds })
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          selectedIds.forEach(id => {
            const cb = document.getElementById('product'+id);
            if (cb) {
              const cartItem = cb.closest('.cart-item');
              if (cartItem) cartItem.remove();
            }
            delete itemData[id];
          });
          updateAllUI();
        } else {
          alert('Failed to delete item(s)');
        }
      });
    });
    updateAllUI();
  });
</script>
</body>
<x-footer></x-footer>
</html>
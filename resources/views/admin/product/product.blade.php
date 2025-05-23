@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="text-xl font-semibold mb-4">Product Collection</h2>
    <button class="btn btn-primary mb-3" onclick="openAddModal()">+ Add Product</button>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Catalog</th>
                <th>Region</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price (Rp)</th>
                <th>Price ($)</th>
                <th>Image</th>
                <th>Weight (kg)</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $product->catalog->productcatalogname ?? '-' }}</td>
                <td>{{ $product->region->productregionsname ?? '-' }}</td>
                <td>{{ $product->productname }}</td>
                <td>{{ $product->productdescription }}</td>
                <td>{{ number_format($product->productpricerupiah, 0, ',', '.') }}</td>
                <td>{{ $product->productpricedollar }}</td>
                <td>
                    @if($product->productimage)
                        <img src="{{ asset('storage/' . $product->productimage) }}" alt="Image" width="60">
                    @else
                        <span class="text-gray-400">No image</span>
                    @endif
                </td>
                <td>{{ $product->productweight }}</td>
                <td>{{ $product->productstock }}</td>
                <td>
                    <button class="btn btn-sm btn-warning edit-btn"
                        data-id="{{ $product->productid }}"
                        data-catalog="{{ $product->productcatalogid }}"
                        data-region="{{ $product->productregionid }}"
                        data-name="{{ addslashes($product->productname) }}"
                        data-description="{{ addslashes($product->productdescription) }}"
                        data-pricerupiah="{{ $product->productpricerupiah }}"
                        data-pricedollar="{{ $product->productpricedollar }}"
                        data-image="{{ $product->productimage }}"
                        data-weight="{{ $product->productweight }}"
                        data-stock="{{ $product->productstock }}"
                        onclick="openEditModal(this)">Edit</button>
                    <form action="{{ route('product.destroy', $product->productid) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="11" class="text-center text-gray-500">No products found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Catalog</label>
            <select name="productcatalogid" class="form-control" required>
              <option value="">-- Select Catalog --</option>
              @foreach(App\Models\ProductCatalog::all() as $cat)
                <option value="{{ $cat->productcatalogid }}">{{ $cat->productcatalogname }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Region</label>
            <select name="productregionid" class="form-control" required>
              <option value="">-- Select Region --</option>
              @foreach(App\Models\ProductRegionsMap::all() as $reg)
                <option value="{{ $reg->productregionsid }}">{{ $reg->productregionsname }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="productname" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="productdescription" class="form-control"></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Price (Rp)</label>
            <input type="number" name="productpricerupiah" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Price ($)</label>
            <input type="number" step="0.01" name="productpricedollar" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" name="productimage" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Weight (kg)</label>
            <input type="number" step="0.01" name="productweight" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Stock</label>
            <input type="number" name="productstock" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="editProductForm" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="productid" id="edit_productid">
          <div class="mb-3">
            <label class="form-label">Catalog</label>
            <select name="productcatalogid" id="edit_productcatalogid" class="form-control" required>
              <option value="">-- Select Catalog --</option>
              @foreach(App\Models\ProductCatalog::all() as $cat)
                <option value="{{ $cat->productcatalogid }}">{{ $cat->productcatalogname }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Region</label>
            <select name="productregionid" id="edit_productregionid" class="form-control" required>
              <option value="">-- Select Region --</option>
              @foreach(App\Models\ProductRegionsMap::all() as $reg)
                <option value="{{ $reg->productregionsid }}">{{ $reg->productregionsname }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="productname" id="edit_productname" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="productdescription" id="edit_productdescription" class="form-control"></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Price (Rp)</label>
            <input type="number" name="productpricerupiah" id="edit_productpricerupiah" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Price ($)</label>
            <input type="number" step="0.01" name="productpricedollar" id="edit_productpricedollar" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Current Image</label>
            <div id="editImagePreview" class="mb-2"></div>
            <label class="form-label">Change Image</label>
            <input type="file" name="productimage" id="edit_productimage" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Weight (kg)</label>
            <input type="number" step="0.01" name="productweight" id="edit_productweight" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Stock</label>
            <input type="number" name="productstock" id="edit_productstock" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
function openAddModal() {
    var modal = new bootstrap.Modal(document.getElementById('addProductModal'));
    modal.show();
}
function openEditModal(btn) {
    var modal = new bootstrap.Modal(document.getElementById('editProductModal'));
    document.getElementById('edit_productid').value = btn.getAttribute('data-id');
    document.getElementById('edit_productcatalogid').value = btn.getAttribute('data-catalog');
    document.getElementById('edit_productregionid').value = btn.getAttribute('data-region');
    document.getElementById('edit_productname').value = btn.getAttribute('data-name');
    document.getElementById('edit_productdescription').value = btn.getAttribute('data-description');
    document.getElementById('edit_productpricerupiah').value = btn.getAttribute('data-pricerupiah');
    document.getElementById('edit_productpricedollar').value = btn.getAttribute('data-pricedollar');
    document.getElementById('edit_productweight').value = btn.getAttribute('data-weight');
    document.getElementById('edit_productstock').value = btn.getAttribute('data-stock');
    var image = btn.getAttribute('data-image');
    var preview = document.getElementById('editImagePreview');
    if(image) {
        preview.innerHTML = '<img src="' + (image.startsWith('http') ? image : '/storage/' + image) + '" class="h-12 rounded"/>';
    } else {
        preview.innerHTML = '<span class="text-gray-400">No image</span>';
    }
    document.getElementById('editProductForm').action = '/productcollection/' + btn.getAttribute('data-id');
    modal.show();
}
</script>
@endsection

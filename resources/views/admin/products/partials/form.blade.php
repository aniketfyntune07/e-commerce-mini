<div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name" class="form-control"
           value="{{ old('name', $product->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-control" rows="3">{{ old('description', $product->description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">Price</label>
    <input type="number" step="0.01" name="price" class="form-control"
           value="{{ old('price', $product->price ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Stock</label>
    <input type="number" name="stock" class="form-control"
           value="{{ old('stock', $product->stock ?? 0) }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Image</label>
    <input type="file" name="image" class="form-control">
    @if(isset($product) && $product->image)
        <img src="{{ asset('storage/'.$product->image) }}" alt="" class="img-thumbnail mt-2" width="120">
    @endif
</div>

@foreach($errors->all() as $error)
    <div class="text-danger small">{{ $error }}</div>
@endforeach

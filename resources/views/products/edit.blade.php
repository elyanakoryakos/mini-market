@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="card shadow-sm">
      <div class="card-header"><h5 class="m-0">Edit Product</h5></div>
      <div class="card-body">
        <form method="POST" action="{{ route('products.update', $product) }}">
          @csrf
          @method('PUT')
          <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
            @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
          </div>
          <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $product->price) }}" required>
            @error('price') <div class="text-danger small">{{ $message }}</div> @enderror
          </div>
          <div class="d-flex gap-2">
            <button class="btn btn-primary" type="submit">Update</button>
            <a href="{{ route('products.show', $product) }}" class="btn btn-outline-secondary">Cancel</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

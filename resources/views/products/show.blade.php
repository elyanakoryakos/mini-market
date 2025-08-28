@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="m-0">Product Details</h5>
    <div class="d-flex gap-2">
      {{-- Edit --}}
      <a class="btn btn-sm btn-outline-primary" href="{{ route('products.edit', $product) }}">Edit</a>
      
      {{-- Delete --}}
      <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?')" class="d-inline">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-outline-danger">Delete</button>
      </form>
    </div>
  </div>

  <div class="card-body">
    <dl class="row">
      <dt class="col-sm-3">ID</dt>
      <dd class="col-sm-9">{{ $product->id }}</dd>

      <dt class="col-sm-3">Name</dt>
      <dd class="col-sm-9">{{ $product->name }}</dd>

      <dt class="col-sm-3">Price</dt>
      <dd class="col-sm-9">${{ number_format($product->price,2) }}</dd>

      <dt class="col-sm-3">Created</dt>
      <dd class="col-sm-9">{{ $product->created_at->format('Y-m-d H:i') }}</dd>
    </dl>

    {{-- Add to Cart --}}
    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-3">
      @csrf
      <div class="input-group" style="max-width: 200px;">
        <input type="number" name="quantity" value="1" min="1" class="form-control">
        <button class="btn btn-success">Add to Cart</button>
      </div>
    </form>

    <div class="mt-3">
      <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Back</a>
    </div>
  </div>
</div>
@endsection

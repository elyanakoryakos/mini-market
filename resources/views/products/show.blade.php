@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="m-0">Product Details</h5>
    <a class="btn btn-sm btn-outline-primary" href="{{ route('products.edit', $product) }}">Edit</a>
  </div>
  <div class="card-body">
    <dl class="row">
      <dt class="col-sm-3">ID</dt><dd class="col-sm-9">{{ $product->id }}</dd>
      <dt class="col-sm-3">Name</dt><dd class="col-sm-9">{{ $product->name }}</dd>
      <dt class="col-sm-3">Price</dt><dd class="col-sm-9">${{ number_format($product->price,2) }}</dd>
      <dt class="col-sm-3">Created</dt><dd class="col-sm-9">{{ $product->created_at->format('Y-m-d H:i') }}</dd>
    </dl>
    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Back</a>
  </div>
</div>
@endsection

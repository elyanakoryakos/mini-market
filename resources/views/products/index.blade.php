@extends('layouts.app')

@section('content')
<div class="card shadow-sm mb-3">
  <div class="card-header"><strong>Search / Filter / Sort</strong></div>
  <div class="card-body">
    <form class="row g-2" method="GET" action="{{ route('products.index') }}">
      <div class="col-md-4">
        <input type="text" name="q" class="form-control" placeholder="Search by name..."
               value="{{ $q }}">
      </div>
      <div class="col-md-2">
        <input type="number" step="0.01" name="min_price" class="form-control" placeholder="Min price"
               value="{{ $min }}">
      </div>
      <div class="col-md-2">
        <input type="number" step="0.01" name="max_price" class="form-control" placeholder="Max price"
               value="{{ $max }}">
      </div>
      <div class="col-md-2">
        <select name="sort" class="form-select">
          <option value="created_at" @selected($sort==='created_at')>Sort by: Created</option>
          <option value="name"       @selected($sort==='name')>Name</option>
          <option value="price"      @selected($sort==='price')>Price</option>
        </select>
      </div>
      <div class="col-md-2">
        <select name="dir" class="form-select">
          <option value="desc" @selected($dir==='desc')>Desc</option>
          <option value="asc"  @selected($dir==='asc')>Asc</option>
        </select>
      </div>
      <div class="col-12 d-flex gap-2">
        <button class="btn btn-primary">Apply</button>
        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Reset</a>
      </div>
    </form>
  </div>
</div>

<div class="card shadow-sm">
  <div class="card-header"><h5 class="m-0">Products</h5></div>
  <div class="card-body">
    @if($products->isEmpty())
      <p class="text-muted mb-0">No products found.</p>
    @else
      <div class="table-responsive">
        <table class="table align-middle">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th class="text-end">Price</th>
              <th>Created</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($products as $p)
              <tr>
                <td>{{ $p->id }}</td>
                <td><a href="{{ route('products.show', $p) }}">{{ $p->name }}</a></td>
                <td class="text-end">${{ number_format($p->price,2) }}</td>
                <td>{{ $p->created_at->format('Y-m-d H:i') }}</td>
                <td class="text-end">
                  <a class="btn btn-sm btn-outline-primary" href="{{ route('products.edit', $p) }}">Edit</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      {{ $products->links() }}
    @endif
  </div>
</div>
@endsection

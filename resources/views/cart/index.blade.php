@extends('layouts.app')

@section('content')
  <h1 class="mb-3">My Cart</h1>

  @if (empty($cart))
    <p>Your cart is empty.</p>
  @else
    <table class="table">
      <thead>
        <tr>
          <th>Product</th>
          <th class="text-end">Price</th>
          <th class="text-center">Qty</th>
          <th class="text-end">Subtotal</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($cart as $productId => $item)
          <tr>
            <td>{{ $item['name'] }}</td>
            <td class="text-end">${{ number_format($item['price'],2) }}</td>
            <td class="text-center">
              <form action="{{ route('cart.update', $productId) }}" method="POST" class="d-inline">
                @csrf @method('PATCH')
                <input type="number" name="quantity" value="{{ $item['qty'] }}" min="1" max="100" style="width:80px">
                <button class="btn btn-sm btn-primary">Update</button>
              </form>
            </td>
            <td class="text-end">${{ number_format($item['price'] * $item['qty'],2) }}</td>
            <td class="text-end">
              <form action="{{ route('cart.remove', $productId) }}" method="POST" class="d-inline">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-outline-danger">Remove</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <th colspan="3" class="text-end">Total</th>
          <th class="text-end">${{ number_format($total,2) }}</th>
          <th class="text-end">
            <form action="{{ route('cart.clear') }}" method="POST">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-warning">Clear Cart</button>
            </form>
          </th>
        </tr>
      </tfoot>
    </table>
  @endif
@endsection

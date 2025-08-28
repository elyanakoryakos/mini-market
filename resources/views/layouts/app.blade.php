<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mini Market</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #f0f8ff; /* baby blue background */
    }
    .navbar {
      background-color: #4da6ff !important; /* stronger baby blue navbar */
    }
    .navbar-brand {
      font-weight: bold;
      color: white !important;
    }
    .btn-success {
      background-color: #5bc0de; /* soft baby blue button */
      border: none;
    }
    .btn-success:hover {
      background-color: #31b0d5;
    }
    .btn-outline-secondary {
      border-color: #5bc0de;
      color: #5bc0de;
    }
    .btn-outline-secondary:hover {
      background-color: #5bc0de;
      color: white;
    }
    .card {
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
      border: none;
    }
    .card-header {
      background-color: #e6f2ff;
      font-weight: 600;
      color: #005580;
    }
    table th {
      background-color: #cce6ff;
      color: #00334d;
    }
    table td {
      background-color: #f9fcff;
    }
    a {
      color: #007acc;
      text-decoration: none;
    }
    a:hover {
      text-decoration: underline;
    }
    .alert-success {
      background-color: #d9f2ff;
      border-color: #b3e0ff;
      color: #004466;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark mb-4">
    <div class="container">
      <a class="navbar-brand" href="{{ route('products.index') }}">Mini Market</a>
      <div class="ms-auto d-flex gap-2">
        {{-- ✅ Cart badge --}}
        @php $cartCount = collect(session('cart', []))->sum('qty'); @endphp
        <a class="btn btn-outline-light btn-sm" href="{{ route('cart.index') }}">
          Cart ({{ $cartCount }})
        </a>

        <a class="btn btn-outline-light btn-sm" href="{{ route('products.index') }}">All</a>
        <a class="btn btn-success btn-sm" href="{{ route('products.create') }}">+ Add Product</a>
      </div>
    </div>
  </nav>

  <main class="container">
    {{-- ✅ flash + validation alerts --}}
    @include('partials.alerts')

    @yield('content')
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

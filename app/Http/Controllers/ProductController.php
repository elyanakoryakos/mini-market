<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    // SEE ALL + SEARCH + FILTER + SORT
    public function index(Request $request)
    {
        $request->validate([
            'q'         => ['nullable','string','max:255'],
            'min_price' => ['nullable','numeric','min:0'],
            'max_price' => ['nullable','numeric','min:0'],
            'sort'      => ['nullable', Rule::in(['name','price','created_at'])],
            'dir'       => ['nullable', Rule::in(['asc','desc'])],
        ]);

        $q   = $request->input('q');
        $min = $request->input('min_price');
        $max = $request->input('max_price');
        $sort= $request->input('sort', 'created_at');
        $dir = $request->input('dir',  'desc');

        $products = Product::query()
            ->when($q,   fn($qry) => $qry->where('name', 'like', "%{$q}%"))
            ->when($min !== null, fn($qry) => $qry->where('price', '>=', $min))
            ->when($max !== null, fn($qry) => $qry->where('price', '<=', $max))
            ->orderBy($sort, $dir)
            ->paginate(10)
            ->withQueryString();

        return view('products.index', compact('products','q','min','max','sort','dir'));
    }

    // ADD NEW
    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'  => ['required','string','max:255'],
            'price' => ['required','numeric','min:0'],
        ]);

        $product = Product::create($data);

        return redirect()
            ->route('products.show', $product)
            ->with('ok', 'Product added!');
    }

    // VIEW DETAILS
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // UPDATE
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'  => ['required','string','max:255'],
            'price' => ['required','numeric','min:0'],
        ]);

        $product->update($data);

        return redirect()
            ->route('products.show', $product)
            ->with('ok', 'Product updated!');
    }
}

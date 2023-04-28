<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ShowProducts extends Component
{
    use WithPagination;

    public $search, $category, $price, $color;

    protected $queryString = [
        'search' => ['except' => ''],
        'category' => ['except' => ''],
        'price' => ['except' => ''],
        'color' => ['except' => '']
    ];

    public function updating()
    {
        $this->resetPage();
    }

    public function render()
    {
        $categories = Category::all();
        $prices = Product::select('price')->distinct()->get();
        $colors = Product::select('color')->distinct()->get();
        $products = Product::where([
            ['name', 'LIKE', '%' . $this->search . '%'],
            ['stock', '>', 0],
            ['state_id', 1]
        ])
            ->when($this->category, function ($query, $category) {
                $query->where('category_id', $category);
            })
            ->when($this->price, function ($query, $price) {
                $query->where('price', $price);
            })
            ->when($this->color, function ($query, $color) {
                $query->where('color', 'LIKE',  '%' . $color . '%');
            })
            ->paginate(4);

        return view('livewire.show-products', compact(
            'products',
            'categories',
            'prices',
            'colors',
        ));
    }
}

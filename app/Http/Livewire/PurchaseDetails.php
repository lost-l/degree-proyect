<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class PurchaseDetails extends Component
{
    use WithPagination;

    public Order $order;

    protected $listeners = [
        'finish', 'cancel'
    ];

    public function mount(Order $order)
    {
        $this->order = $order;
    }

    public function seeProduct($id)
    {
        return redirect()->route('product-details', Product::find($id));
    }

    public function finish()
    {
        $this->order->state_id = 2;
        $this->order->save();
        return redirect()->route('dashboard');
    }

    public function cancel()
    {
        if($this->order->state_id !== 1) return;
        $products = $this->order->products;
        foreach ($products as $productItem) {
            $product = Product::find($productItem->pivot->product_id);
            $product->stock += $productItem->pivot->quantity;
            $product->save();
        }
        unset($products);
        $this->order->delete();
        return redirect()->route('dashboard');
    }

    public function render()
    {
        $products = $this->order->products()
            ->select('products.name',)
            ->paginate(5, ['*'], 'productsPage');
        return view('livewire.purchase-details', compact('products'));
    }
}

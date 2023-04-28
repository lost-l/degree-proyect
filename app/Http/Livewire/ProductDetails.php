<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductDetails extends Component
{
    public Product $product;
    public $quantity = 1;

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function increment()
    {
        if (($this->quantity + 1) <= ($this->product->stock)) {
            $this->quantity++;
        }
    }

    public function decrement()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addItemCart()
    {
        if ($this->product->stock) {

            $itemId = $this->product->id;
            if (\Cart::get($itemId)) {
                if ((\Cart::get($itemId)["quantity"] + $this->quantity) <= $this->product->stock) {
                    \Cart::update($itemId, ['quantity' => $this->quantity]);
                    $this->emitTo('shopping-item', 'updateQuantityWayProduct', \Cart::get($itemId)["quantity"]);
                    $this->emitTo('shopping-cart', 'render');

                    $this->emit('alert-product', 'Producto Agregado');
                } else {
                    $this->emit('alert-product', 'Oops!!, Revisa la cantidad', 'info');
                }
            } else {
                \Cart::add([
                    'id' => $itemId,
                    'name' => $this->product->name,
                    'price' => $this->product->price,
                    'quantity' => $this->quantity,
                    'attributes' => [
                        'image' => $this->product->image,
                        'color' => $this->product->color,
                        'stock' => $this->product->stock,
                    ],
                ]);

                $this->emit('alert-product', 'Producto Agregado');
            }
        } else {
            $this->emit('alert-product', 'Oops!!, No hay en stock', 'info');
        }
    }

    public function render()
    {
        return view('livewire.product-details');
    }
}

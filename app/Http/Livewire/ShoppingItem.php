<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShoppingItem extends Component
{
    public $product, $quantity, $prodSum;

    protected $listeners = [
        'updateQuantityWayProduct'
    ];

    public function mount()
    {
        $this->quantity = $this->product['quantity'];
        $this->prodSum = \Cart::get($this->product['id'])->getPriceSum();
    }

    public function updatedQuantity()
    {
        $this->prodSum = \Cart::get($this->product['id'])->getPriceSum();
    }

    public function updateQuantityWayProduct($quantity)
    {
        $this->quantity = $quantity;
        $this->prodSum = \Cart::get($this->product['id'])->getPriceSum();
        $this->emitTo('shopping-cart', 'render');
    }

    public function incrementItem()
    {
        if (($this->quantity + 1) <= ($this->product['attributes']['stock'])) {
            $this->quantity++;
            \Cart::update($this->product["id"], ['quantity' => 1]);
            $this->prodSum = \Cart::get($this->product['id'])->getPriceSum();
            $this->emitTo('shopping-cart', 'render');
        }
    }

    public function decrementItem()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
            \Cart::update($this->product['id'], ['quantity' => -1]);
            $this->prodSum = \Cart::get($this->product['id'])->getPriceSum();
            $this->emitTo('shopping-cart', 'render');
        }
    }

    public function removeProductItem()
    {
        \Cart::remove($this->product['id']);
        $this->emitTo('shopping-cart', 'render');
    }

    public function render()
    {
        return view('livewire.shopping-item');
    }
}

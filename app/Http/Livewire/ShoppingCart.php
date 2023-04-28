<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShoppingCart extends Component
{
    public $open = false;
    public $subtotal = 0;
    public $products;

    protected $listeners = [
        'render', 'cleanCart', 'profile'
    ];

    public function profile()
    {
        return redirect()->route('dashboard');
    }

    public function purchase()
    {
        if(!auth()?->user()?->addresses->count()){
            $this->emit('missing-alert');
            return;
        }
        return redirect()->route('purchase.create');
    }

    public function cleanCart()
    {
        \Cart::clear();
    }

    public function render()
    {
        $this->subtotal = \Cart::getTotal();
        $this->products = \Cart::getContent();
        return view('livewire.shopping-cart');
    }
}

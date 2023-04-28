<?php

namespace App\Http\Livewire;

use App\Models\Address;
use App\Models\Order;
use App\Models\Product;
use App\Models\Tax;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Purchase extends Component
{
    public $addressId, $addressSelected,  $total, $products, $iva, $subtotal, $envio, $neto;

    public $deliveryDate, $available = false, $deliveryPerson = 0;

    public $deliveries;


    public $SelectorDeliveries;

    public $MenorCantidadEntregas=5;

    public $ContadorDeliverys;

    public $ContadorEach=0;

    protected $rules = [
        'addressId' => 'required',
        'addressSelected' => 'required',
        'deliveryDate' => 'required|date|after:yesterday|before:+2 week'
    ];

    protected $messages = [
        'deliveryDate.after' => 'La fecha no puede ser anterior al dia de hoy',
        'deliveryDate.before' => 'No disponemos de agenda para dichas fechas',
    ];

    protected $listeners = [
        'boughtDone'
    ];

    public function mount()
    {
        $this->user = auth()->user();
        $this->deliveries = User::role('delivery')->get();
        $this->products = \Cart::getContent();
        $this->subtotal = \Cart::getTotal();
        $this->iva = Tax::find(1);
        $this->addressId = $this->user->addresses[0]->id;
        $this->addressSelected = Address::find($this->addressId);
        $this->envio = $this->addressSelected->locality->price;

        $this->neto = $this->subtotal + $this->envio;

        $this->total = ($this->iva->is_active)
            ? ($this->neto + ($this->neto * ($this->iva->value / 100)))
            : $this->neto;
    }

    public function updatedAddressId()
    {
        $this->neto -= $this->envio;
        $this->addressSelected = Address::find($this->addressId);
        $this->envio = $this->addressSelected->locality->value('price');
        $this->neto += $this->envio;
        $this->total = ($this->iva->is_active)
            ? ($this->neto + ($this->neto * ($this->iva->value / 100)))
            : $this->neto;
    }

    public function updatedDeliveryDate()
    {
        $this->validate();
        foreach ($this->deliveries as $delivery) {
            
            $countDeliveries = $delivery->deliveries()
                ->whereDate('delivery_date', $this->deliveryDate)
                ->get()
                ->count();
//Cambios realizdos para la asginación de repartidores

            if ($this->ContadorEach == 0){ // Analiza el primer repartidor
                if ($countDeliveries < 5) {
                    $this->available = true;
                    $this->deliveryPerson = $delivery->cc;  //Asigna la orden a este repartidor por ahora
                    $this->MenorCantidadEntregas=$countDeliveries;  //Asigna valor mínimos de entregas
                    //$this->emit('Mostrador Valor', 'Pendiente', 'A ver', 'Sí entró en el primer');
                    //$this->$SelectorDeliveries;
                    
                }//falta ver qué hacer si el repartidor uno ya tiene 5 ordenes!!!!
            }else{ //Analiza al segundo repartidor en adelante
                if ($countDeliveries < 5){
                    if ($countDeliveries < $this->MenorCantidadEntregas){
                        $this->available = true;
                        $this->deliveryPerson = $delivery->cc;
                        $this->MenorCantidadEntregas=$countDeliveries;
                    }
                }

            }

            $this->ContadorEach++;            



//Fin cambios
//Esto es lo que estaba
           // if ($countDeliveries < 5) {
              //  $this->available = true;
               // $this->deliveryPerson = $delivery->cc;
               // break;
           // }
//Fin de la función que estaba

        }
        if (!$this->available) {
            $this->emit('purchase-alert', 'warning', 'Oops...', 'Lo sentimos, para esta fecha no disponemos de envios');
        }
    }

    public function buyProducts()
    {
        if ($this->available) {
            $order = new Order([
                'delivery_date' => $this->deliveryDate,
                'total' => $this->total,
                'iva' => ($this->iva->is_active) ? ($this->iva->value / 100) : 0,
                'user_id' => $this->user->cc,
                'delivery_id' => $this->deliveryPerson,
            ]);
            $order->address =  $this->addressSelected->description;
            $order->save();

            foreach ($this->products as $product) {
                $order->products()->attach($product['id'], [
                    'price' => $product['price'],
                    'quantity' => $product['quantity'],
                ]);
                $productBought = Product::find($product['id']);
                $productBought->stock -= $product['quantity'];
                if (!$productBought->stock) {
                    $productBought->state_id = 2;
                }
                $productBought->save();
            }

            $this->available = false;
            $this->emit('bought', 'success', 'Compra realizada', 'Tu pedido ha sido realizado con éxito. Por favor, ten presente que la fecha para tu entrega es ' . $this->deliveryDate . ' dentro del horario de 8am a 5pm.
            Gracias por utilizar nuestros servicios.');
            $this->emitTo('shopping-cart', 'cleanCart');
        } else {
            if (!$this->available)
                $this->emit('purchase-alert', 'warning', 'Oops...', 'Por favor, revisa otra fecha');
        }
    }

    public function boughtDone()
    {
        return redirect()->route('home');
    }

    public function render()
    {
        $addresses = $this->user->addresses;
        return view('livewire.purchase', compact('addresses'));
    }
}

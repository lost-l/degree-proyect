<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Orders extends Component
{
    use WithPagination;

    public $canReschedule = false, $canComplaint = false, $claim, $newDeliveryDate, $available = false, $deliveryPerson = 0;
    public Order $order;
    public $deliveries;

    public $MenorCantidadEntregas=5;
    public $ContadorEach=0;

    protected $rules = [
        'claim' => 'required|min:15',
    ];

    public function mount()
    {
        $this->deliveries = User::role('delivery')->get();
    }

    public function reschedule(Order $order)
    {
        $this->canReschedule = true;
        $this->order = $order;
    }

    public function complaint(Order $order)
    {
        $this->canComplaint = true;
        $this->order = $order;
    }

    public function updatedNewDeliveryDate()
    {
        $this->validate([
            'newDeliveryDate' => 'required|date|after:yesterday'
        ]);
        foreach ($this->deliveries as $delivery) {
            $countDeliveries = $delivery->deliveries()
                ->whereDate('delivery_date', $this->newDeliveryDate)
                ->get()
                ->count();
//Lo que estaba    
          //  if ($countDeliveries < 5) {
             //   $this->available = true;
             //   $this->deliveryPerson = $delivery->cc;
           //     break;
           // }
//FIN

//Lo NUEVO

            if ($this->ContadorEach == 0){ // Analiza el primer repartidor
                if ($countDeliveries < 5) {
                    $this->available = true;
                    $this->order->delivery_date = $this->newDeliveryDate;
                    $this->order->delivery_id = $delivery->cc;
                    $this->order->save();
                    $this->MenorCantidadEntregas=$countDeliveries; 
                    
                }
                
            }else{ //Analiza al segundo repartidor en adelante
                if ($countDeliveries < 5){
                    if ($countDeliveries < $this->MenorCantidadEntregas){
                        $this->available = true;
                        $this->order->delivery_date = $this->newDeliveryDate;
                        $this->order->delivery_id = $delivery->cc;
                        $this->order->save();
                        $this->MenorCantidadEntregas=$countDeliveries;
                    }
                }

            }

            $this->ContadorEach++;   

//FIN LO NUEVO

        }

        if ($this->available) {
            //$this->order->delivery_date = $this->newDeliveryDate;
            //$this->order->delivery_id = $this->deliveryPerson;
            //$this->order->save();
            $this->emit('purchase-alert', 'success', 'Cambio realizadó', 'Revisa los detalles de tu pedido');
        } else {
            $this->emit('purchase-alert', 'warning', 'Oops...', 'Lo sentimos, para esta fecha no disponemos de envios');
        }
    }

    public function updatedClaim()
    {
        $this->validate();
        $this->order->claim = $this->claim;
    }
    
    public function saveClaim()
    {
        $this->validate([
            'claim' => 'required|min:5',
        ]);

        $this->order->claim = $this->claim;
        $this->order->save();
        $this->emit('claim', 'success', 'Reclamo realizado', 'Se ha realizado el reclamo');
    }

    public function details(Order $order)
    {
        return redirect()->route('purchase.show', compact('order'));
    }

    public function render()
    {
        if (Auth::user()->hasRole('delivery')) {
            $orders = Auth::user()->deliveries()
                ->select('orders.id', 'orders.total', 'orders.delivery_date', 'orders.state_id', 'states.name')
                ->join('states', 'orders.state_id', '=', 'states.id')
                ->orderBy('orders.delivery_date', 'desc')
                ->paginate(5, ['*'], 'ordersPage');
        } else {
            $orders = Order::with('user')
                ->select('orders.id', 'orders.total', 'orders.delivery_date', 'orders.state_id', 'states.name')
                ->join('states', 'orders.state_id', '=', 'states.id')
                ->where('orders.user_id', auth()->user()->cc)
                ->orderBy('orders.delivery_date', 'desc')
                ->paginate(5, ['*'], 'ordersPage');
        }
        return view('livewire.orders', compact('orders'));
    }
}

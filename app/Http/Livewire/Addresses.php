<?php

namespace App\Http\Livewire;

use App\Models\Address;
use App\Models\Locality;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Addresses extends Component
{
    use WithPagination;

    public $description = '', $locality = 1, $isnew = false;
    public $updateCurrentAddress = false;

    protected $listeners = [
        'destroyAddress'
    ];

    public function openModal($address)
    {
        $this->updateCurrentAddress = true;
        $this->description = $address['description'];
        $this->locality = $address['locality_id'];
    }

    public function addNewAddress()
    {
        $this->updateCurrentAddress = $this->isnew = true;
    }

    public function updateAddress($id)
    {
        if ($this->isnew) {
            $id = 0;
            $this->validate([
                'description' => 'required|unique:addresses,description',
                'locality' => 'required|integer'
            ]);
        } else {
            $this->validate([
                'description' => 'required',
                'locality' => 'required|integer'
            ]);
        }

        $address = Address::firstOrNew(['id' => $id]);

        if ($this->isnew) {
            $address->user_id = Auth::user()->cc;
            $this->isnew = false;
        }

        $address->description = $this->description;
        $address->locality_id = $this->locality;
        $address->save();
        $this->updateCurrentAddress = false;
    }

    public function destroyAddress($id)
    {
        if (auth()->user()->addresses->count() > 1)
            Address::find($id)->delete();
    }

    public function render()
    {
        $localities = Locality::select('id', 'name')->get();
        $addresses = Address::with('user')
            ->select('addresses.id', 'addresses.description', 'addresses.locality_id', 'localities.name')
            ->where('addresses.user_id', Auth::user()->cc)
            ->join('localities', 'addresses.locality_id', '=', 'localities.id')
            ->paginate(5, ['*'], 'addressesPage');
        return view('livewire.addresses', compact('addresses', 'localities'));
    }
}

<?php

namespace App\Livewire\Core;

use App\Models\Farmer;
use App\Models\User;
use Livewire\Component;

class FarmerComponent extends Component
{
    public $farmers;
    public $showModal = false; // For toggling the modal
    public $user_id, $farm_name, $farm_address, $type_of_farming; // Form inputs

    protected $rules = [
        'user_id' => 'required|exists:users,id',
        'farm_name' => 'required|string|max:255',
        'farm_address' => 'required|string|max:255',
        'type_of_farming' => 'required|string|max:255',
    ];

    public function render()
    {
        $this->farmers = Farmer::with('user')->get();
        return view('livewire.core.farmer-component')->layout('layouts.app');
    }

    public function createFarmer()
    {
        $this->resetForm();
        $this->showModal = true; // Open the modal
    }

    public function saveFarmer()
    {
        $this->validate();

        Farmer::create([
            'user_id' => $this->user_id,
            'farm_name' => $this->farm_name,
            'farm_address' => $this->farm_address,
            'type_of_farming' => $this->type_of_farming,
        ]);

        $this->showModal = false; // Close the modal
        session()->flash('message', 'Farmer created successfully.');
    }

    public function resetForm()
    {
        $this->user_id = null;
        $this->farm_name = null;
        $this->farm_address = null;
        $this->type_of_farming = null;
    }
}

<?php

namespace App\Livewire\Core;

use App\Models\Farmer;
use Livewire\Component;

class FarmerViewComponent extends Component
{

    public $farmer;

    public function mount(){
        $id = $_GET['id'];
        $this->farmer = Farmer::where('id', $id)->with('user')->first();
    }

    public function render()
    {
        return view('livewire.core.farmer-view-component')->layout('layouts.app');
    }
}

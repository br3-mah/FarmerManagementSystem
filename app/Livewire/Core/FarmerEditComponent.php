<?php

namespace App\Livewire\Core;

use Livewire\Component;

class FarmerEditComponent extends Component
{
    public function mount(){
        
    }

    public function render()
    {
        return view('livewire.core.farmer-edit-component')->layout('layouts.app');
    }
}

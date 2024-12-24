<?php

namespace App\Livewire\Core;

use Livewire\Component;

class FarmerViewComponent extends Component
{
    public function render()
    {
        return view('livewire.core.farmer-view-component')->layout('layouts.app');
    }
}

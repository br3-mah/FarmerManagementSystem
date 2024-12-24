<?php

namespace App\Livewire\Core;

use Livewire\Component;

class UserComponent extends Component
{
    public function render()
    {
        return view('livewire.core.user-component')->layout('layouts.app');
    }
}

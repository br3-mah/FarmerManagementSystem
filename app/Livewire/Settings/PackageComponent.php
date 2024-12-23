<?php

namespace App\Livewire\Settings;

use Livewire\Component;
use Nwidart\Modules\Facades\Module;

class PackageComponent extends Component
{
    public $modules;
    public function render()
    {
        $this->modules = Module::all();
        return view('livewire.settings.package-component')->layout('layouts.app');
    }
}

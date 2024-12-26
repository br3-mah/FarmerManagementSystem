<?php
namespace App\Livewire\Settings;

use Livewire\Component;
use Nwidart\Modules\Facades\Module;

class PackageComponent extends Component
{
    public $modules = [];

    public $showModal = false;

    public function activateModule($moduleName)
    {
        Module::find($moduleName)->enable();
        session()->flash('message', "Module {$moduleName} activated successfully.");
    }

    public function deactivateModule($moduleName)
    {
        Module::find($moduleName)->disable();
        session()->flash('message', "Module {$moduleName} deactivated successfully.");
    }

    public function deleteModule($moduleName)
    {
        $module = Module::find($moduleName);
        if ($module) {
            $module->delete();
            session()->flash('message', "Module {$moduleName} deleted successfully.");
        }
    }

    public function render()
    {
        $this->modules = collect(Module::all())->map(function ($module) {
            return [
                'name' => $module->getName(),
                'isEnabled' => $module->isEnabled(),
                'path' => $module->getPath(),
            ];
        })->toArray();
        return view('livewire.settings.package-component')->layout('layouts.app');
    }
}



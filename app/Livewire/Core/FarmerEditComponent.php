<?php

namespace App\Livewire\Core;

use App\Models\Farmer;
use Livewire\Component;

class FarmerEditComponent extends Component
{
    public $farmerId;
    public $fname;
    public $lname;
    public $farm_name;
    public $farm_address;
    public $type_of_farming;
    public $is_prospect;

    public function mount()
    {
        $fid = $_GET['id'];
        $farmer = Farmer::where('id',$fid)->first();
        $this->farmerId = $farmer->id;
        $this->fname = $farmer->user->fname;
        $this->lname = $farmer->user->lname;
        $this->farm_name = $farmer->farm_name;
        $this->farm_address = $farmer->farm_address;
        $this->type_of_farming = $farmer->type_of_farming;
        $this->is_prospect = $farmer->is_prospect == 1 ? true : false;
    }

    public function updateFarmer()
    {
        $this->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'farm_name' => 'required|string|max:255',
            'farm_address' => 'required|string|max:255',
            'type_of_farming' => 'required|string|max:255',
        ]);

        $farmer = Farmer::findOrFail($this->farmerId);
        $farmer->farm_name = $this->farm_name;
        $farmer->farm_address = $this->farm_address;
        $farmer->type_of_farming = $this->type_of_farming;
        $farmer->is_prospect = $this->is_prospect ? 1 : 0;
        $farmer->save();

        $farmer->user->update([
            'fname' => $this->fname,
            'lname' => $this->lname,
        ]);

        session()->flash('message', 'Farmer details updated successfully.');
        return redirect()->route('dashboard'); // Adjust this route as needed
    }

    public function render()
    {
        return view('livewire.core.farmer-edit-component')->layout('layouts.app');
    }
}

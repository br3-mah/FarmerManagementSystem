<?php

namespace App\Livewire\Core;

use App\Models\Farmer;
use Livewire\Component;

class ProspectComponent extends Component
{

    public $farmers;
    public $showModal = false; // For toggling the modal
    public $user_id, $fname, $lname, $password, $farm_name, $farm_address, $type_of_farming; // Form inputs

    protected $rules = [
        'fname' => 'required',
        'lname' => 'required',
        'user_id' => 'nullable',
        'farm_name' => 'required|string|max:255',
        'farm_address' => 'required|string|max:255',
        'type_of_farming' => 'required|string|max:255',
    ];

    public function render()
    {
        $this->farmers = Farmer::with('user')->get();
        return view('livewire.core.prospect-component')->layout('layouts.app');
    }

    public function createFarmer()
    {
        $this->resetForm();
        $this->showModal = true; // Open the modal
    }

    public function saveFarmer()
    {
       try {
            $this->validate();

            $user = User::create([
                'fname' => $this->fname,
                'lname' => $this->lname,
                'email' => $this->lname.''.$this->fname.''.$this->user_id.'@gmail.com',
                'password' => Hash::make($this->password),
            ]);

            Farmer::create([
                'user_id' => $user->id,
                'farm_name' => $this->farm_name,
                'farm_address' => $this->farm_address,
                'type_of_farming' => $this->type_of_farming,
            ]);

            $this->showModal = false; // Close the modal
            session()->flash('message', 'Farmer created successfully.');
       } catch (\Throwable $th) {
            dd($th);
       }
    }

    public function resetForm()
    {
        $this->fname = null;
        $this->lname = null;
        $this->user_id = null;
        $this->farm_name = null;
        $this->farm_address = null;
        $this->type_of_farming = null;
    }
}

<?php

namespace App\Livewire\Core;

use App\Models\Farmer;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class FarmerComponent extends Component
{
    use WithFileUploads;

    public $farmers;
    public $showModal = false;
    public $photo_path; // New property for image upload
    public $user_id, $fname, $lname, $password, $farm_name, $farm_address, $type_of_farming;
    public $phone, $dob, $country, $gender, $committee;
    public $farm_size, $mobile_money_number, $bank_account_number, $bank_name;

    protected $rules = [
        'fname' => 'required',
        'lname' => 'required',
        'user_id' => 'nullable',
        'photo_path' => 'nullable|image|max:1024', // Validation for image upload
        'farm_name' => 'required|string|max:255',
        'farm_size' => 'nullable',
        'farm_address' => 'required|string|max:255',
        'phone' => 'nullable|string|max:15',
        'dob' => 'nullable|date',
        'country' => 'nullable|string|max:255',
        'gender' => 'nullable|string|max:10',
        'committee' => 'nullable|string|max:255',
        'mobile_money_number' => 'nullable|string|max:20',
        'bank_account_number' => 'nullable|string|max:20',
        'bank_name' => 'nullable|string|max:255',
        'type_of_farming' => 'required|string|max:255',
    ];

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

            // Store the photo if uploaded
            $photo_path = null;
            if ($this->photo_path) {
                $photo_path = $this->photo_path->store('profile-photos', 'public');
            }

            Farmer::create([
                'user_id' => $user->id,
                'photo_path' => $photo_path,
                'farm_name' => $this->farm_name,
                'farm_size' => $this->farm_size,
                'farm_address' => $this->farm_address,
                'phone' => $this->phone,
                'dob' => $this->dob,
                'country' => $this->country,
                'gender' => $this->gender,
                'committee' => $this->committee,
                'mobile_money_number' => $this->mobile_money_number,
                'bank_account_number' => $this->bank_account_number,
                'bank_name' => $this->bank_name,
                'type_of_farming' => $this->type_of_farming,
            ]);

            $this->showModal = false;
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
        $this->photo_path = null;
        $this->farm_name = null;
        $this->farm_size = null;
        $this->farm_address = null;
        $this->phone = null;
        $this->dob = null;
        $this->country = null;
        $this->gender = null;
        $this->committee = null;
        $this->mobile_money_number = null;
        $this->bank_account_number = null;
        $this->bank_name = null;
        $this->type_of_farming = null;
    }

    public function render()
    {
        $this->farmers = Farmer::with('user')->whereNot('is_prospect', 1)->get();
        return view('livewire.core.farmer-component')->layout('layouts.app');
    }
}

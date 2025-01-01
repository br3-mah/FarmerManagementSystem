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


{"farmers":[{"id":1,"user_id":4,"dob":"2018-05-02","phone":"0772147755","committee":"Sint consequatur Un","country":"Zambia","gender":null,"farm_name":"Melodie Duran","farm_address":"234\/78 Fugiat tenetur Lusaka East","farm_size":"1784.00","type_of_farming":"Mix Farming","mobile_money_number":"096044333","bank_account_number":"737121220070634","bank_name":"Dennis Burch Bank","is_prospect":0,"created_at":"2024-12-30T22:23:47.000000Z","updated_at":"2024-12-30T22:23:47.000000Z","user":null},{"id":2,"user_id":8,"dob":"1986-09-02","phone":"398 268-3673","committee":"Quasi omnis molestia","country":"Zambia","gender":null,"farm_name":"Jena Oneil","farm_address":"123 Veritatis eveniet q","farm_size":"12333.00","type_of_farming":"Voluptatem natus cu","mobile_money_number":"0975446512","bank_account_number":"5754434343434","bank_name":"Doris Mendez","is_prospect":0,"created_at":"2025-01-01T12:28:36.000000Z","updated_at":"2025-01-01T12:28:36.000000Z","user":null},{"id":3,"user_id":9,"dob":"2008-07-05","phone":"121 3743461","committee":"Deleniti omnis illo ","country":"Non fuga Placeat b","gender":null,"farm_name":"Martena Foreman","farm_address":"Est consequatur As","farm_size":"12000.00","type_of_farming":"Quis culpa aut omni","mobile_money_number":"300","bank_account_number":"391232323","bank_name":"Casey Harris","is_prospect":0,"created_at":"2025-01-01T12:28:59.000000Z","updated_at":"2025-01-01T12:28:59.000000Z","user":null},{"id":4,"user_id":10,"dob":null,"phone":null,"committee":null,"country":null,"gender":null,"farm_name":"Cheryl Silva","farm_address":"Ipsa optio est ex","farm_size":null,"type_of_farming":"Ullamco ea est ut n","mobile_money_number":null,"bank_account_number":null,"bank_name":null,"is_prospect":1,"created_at":"2025-01-01T12:29:24.000000Z","updated_at":"2025-01-01T12:29:24.000000Z","user":null},{"id":5,"user_id":11,"dob":null,"phone":null,"committee":null,"country":null,"gender":null,"farm_name":"Odessa Melton","farm_address":"Iure recusandae Nis","farm_size":null,"type_of_farming":"Consequatur minus a","mobile_money_number":null,"bank_account_number":null,"bank_name":null,"is_prospect":1,"created_at":"2025-01-01T12:29:33.000000Z","updated_at":"2025-01-01T12:29:49.000000Z","user":null}]}

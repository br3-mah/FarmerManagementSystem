<div class="content-wrapper">

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit {{ $fname.' '.$lname }}</h4>
                <p class="card-description">Update details of user below</p>
                <br><br>
                <form wire:submit.prevent="updateFarmer">
                    <div class="mb-3">
                        <label for="fname" class="form-label">First Name</label>
                        <input type="text" wire:model="fname" class="form-control" id="fname">
                        @error('fname') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="lname" class="form-label">Surname</label>
                        <input type="text" wire:model="lname" class="form-control" id="lname">
                        @error('lname') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="farm_name" class="form-label">Farm Name</label>
                        <input type="text" wire:model="farm_name" class="form-control" id="farm_name">
                        @error('farm_name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="farm_address" class="form-label">Farm Address</label>
                        <input type="text" wire:model="farm_address" class="form-control" id="farm_address">
                        @error('farm_address') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="type_of_farming" class="form-label">Type of Farming</label>
                        <input type="text" wire:model="type_of_farming" class="form-control" id="type_of_farming">
                        @error('type_of_farming') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Prospect Switch Field -->
                    <div class="mb-3 form-check form-switch bg-light p-4 rounded">
                        <input type="checkbox" wire:model.lazy="is_prospect" class="form-check-input" id="is_prospect">
                        <label class="form-check-label text-primary" for="is_prospect">Prospect farmer ?</label>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="content-wrapper">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Available Registered Farmers</h4>
                <p class="card-description">List of farmers below</p>
                <div class="mb-3">
                    <button class="btn btn-success btn-icon-text" wire:click="createFarmer">
                        <i class="mdi mdi-plus-circle-outline"></i> Create Farmer
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Full Names</th>
                                <th>Farm Name</th>
                                <th>Farm Address</th>
                                <th>Farming Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($farmers as $farmer)
                                <tr>
                                    <td class="py-1">
                                        <img src="https://img.freepik.com/free-vector/farmer-using-agricultural-technology_53876-120543.jpg" alt="image">
                                    </td>
                                    <td>{{ $farmer->user->fname }} {{ $farmer->user->lname }}</td>
                                    <td>{{ $farmer->farm_name }}</td>
                                    <td>{{ $farmer->farm_address }}</td>
                                    <td>{{ $farmer->type_of_farming }}</td>
                                    <td>
                                        <a href="{{ route('vfarmers', ['id'=>$farmer->id ]) }}" class="btn btn-primary btn-sm">View</a>
                                        <a href="{{ route('efarmers', ['id'=>$farmer->id ]) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <button class="btn btn-danger btn-sm" wire:click="deleteFarmer({{ $farmer->id }})">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @if ($showModal)
        <div class="modal fade show d-block" style="background-color: rgba(0, 0, 0, 0.5);">
            <div class="modal-dialog modal-xl"> <!-- Changed to modal-xl for wider modal -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create Farmer</h5>
                        <button type="button" class="btn-close" wire:click="$set('showModal', false)"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row">
                                <!-- Left Column -->
                                <div class="col-md-4">
                                    <!-- Profile Image Section -->
                                    <div class="mb-4 text-center">
                                        @if ($photo_path)
                                            <img src="{{ $photo_path->temporaryUrl() }}"
                                                class="rounded-circle mb-3"
                                                style="width: 100px; height: 100px; object-fit: cover;">
                                        @else
                                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto mb-3"
                                                style="width: 100px; height: 100px; border: 2px dashed #ccc;">
                                                <i class="fas fa-user fa-3x text-muted"></i>
                                            </div>
                                        @endif
                                        <div class="mb-3">
                                            <label for="photo" class="form-label">Profile Photo</label>
                                            <input type="file" wire:model="photo_path" class="form-control" id="photo" accept="image/*">
                                            @error('photo_path') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <!-- Personal Information -->
                                    <div class="mb-3">
                                        <label for="fname" class="form-label">First Name <span class="text-danger">*</span> </label>
                                        <input type="text" wire:model="fname" class="form-control" id="fname">
                                        @error('fname') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="lname" class="form-label">Surname <span class="text-danger">*</span> </label>
                                        <input type="text" wire:model="lname" class="form-control" id="lname">
                                        @error('lname') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="dob" class="form-label">Date of Birth <span class="text-danger">*</span> </label>
                                        <input type="date" wire:model="dob" class="form-control" id="dob">
                                        @error('dob') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    {{-- <div class="mb-3">
                                        <label for="gender" class="form-label">Gender</label>
                                        <select wire:model="gender" class="form-select form-control" id="gender">
                                            <option value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                        @error('gender') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div> --}}

                                </div>

                                <!-- Right Column -->
                                <div class="col-md-4 pt-4">
                                    <!-- Farm Information -->
                                    <div class="mb-3">
                                        <label for="farm_name" class="form-label">Farm Name <span class="text-danger">*</span> </label>
                                        <input type="text" wire:model="farm_name" class="form-control" id="farm_name">
                                        @error('farm_name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="farm_size" class="form-label">Farm Size (acres )</label>
                                        <input type="text" wire:model="farm_size" class="form-control" id="farm_size">
                                        @error('farm_size') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="farm_address" class="form-label">Farm Address <span class="text-danger">*</span> </label>
                                        <input type="text" wire:model="farm_address" class="form-control" id="farm_address">
                                        @error('farm_address') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="type_of_farming" class="form-label">Type of Farming <span class="text-danger">*</span> </label>
                                        <input type="text" wire:model="type_of_farming" class="form-control" id="type_of_farming">
                                        @error('type_of_farming') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="committee" class="form-label">Committee</label>
                                        <input type="text" wire:model="committee" class="form-control" id="committee">
                                        @error('committee') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                    <!-- Payment Information -->
                                <div class="col-md-4 pt-4">
                                    <div class="mb-3">
                                        <label for="mobile_money_number" class="form-label">Mobile Money Number</label>
                                        <input type="text" wire:model="mobile_money_number" class="form-control" id="mobile_money_number">
                                        @error('mobile_money_number') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="bank_account_number" class="form-label">Bank Account Number</label>
                                        <input type="text" wire:model="bank_account_number" class="form-control" id="bank_account_number">
                                        @error('bank_account_number') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="bank_name" class="form-label">Bank Name</label>
                                        <input type="text" wire:model="bank_name" class="form-control" id="bank_name">
                                        @error('bank_name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span> </label>
                                        <input type="text" wire:model="phone" class="form-control" id="phone">
                                        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="">
                                        <label for="country" class="form-label">Country <span class="text-danger">*</span> </label>
                                        <input type="text" wire:model="country" class="form-control" id="country">
                                        @error('country') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="items-center justify-between justify-content-between w-full flex">
                                <button type="button" class="btn btn-secondary" wire:click="$set('showModal', false)">Cancel</button>
                                <button type="button" class="btn btn-success" wire:click="saveFarmer">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

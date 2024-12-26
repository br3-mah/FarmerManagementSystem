<div class="content-wrapper">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Prospect Farmers</h4>
                <p class="card-description">List of prospects below</p>
                <div class="mb-3">
                    <button class="btn btn-success btn-icon-text" wire:click="createFarmer">
                        <i class="mdi mdi-plus-circle-outline"></i> Create Prospect
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
                                        <img src="../../images/faces/face1.jpg" alt="image">
                                    </td>
                                    <td>{{ $farmer->user->name }}</td>
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
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create Farmer</h5>
                        <button type="button" class="btn-close" wire:click="$set('showModal', false)"></button>
                    </div>
                    <div class="modal-body">
                        <form>

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
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="$set('showModal', false)">Cancel</button>
                        <button type="button" class="btn btn-success" wire:click="saveFarmer">Save</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

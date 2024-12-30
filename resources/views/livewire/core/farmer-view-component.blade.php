
<div class="content-wrapper">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css" rel="stylesheet">
  <style>
    .hover-scale:hover {
      transform: scale(1.01);
      transition: transform 0.2s ease-in-out;
    }
    .profile-image {
      width: 64px;
      height: 64px;
    }
    .icon-container {
      width: 40px;
      height: 40px;
    }
    .material-icons {
      font-size: 20px;
    }
    .pulse {
      animation: pulse 2s infinite;
    }
    @keyframes pulse {
      0% { opacity: 1; }
      50% { opacity: 0.5; }
      100% { opacity: 1; }
    }
  </style>

  <div class="container py-4">
    <!-- Profile Card -->
    <div class="card mb-4 hover-scale">
      <div class="card-body border-bottom">
        <div class="d-flex align-items-center gap-4">
          <div class="position-relative">
            <div class="position-absolute top-0 start-0 w-100 h-100 bg-success bg-opacity-10 rounded-circle pulse"></div>
            <img src="https://img.freepik.com/free-vector/farmer-using-agricultural-technology_53876-120543.jpg" alt="Profile" class="profile-image rounded-circle border border-4 border-white position-relative">
          </div>
          <div class="flex-grow-1">
            <h1 class="h1 mb-2">{{ $farmer->user->name }}</h1>
            <div class="d-flex align-items-center text-muted mb-1">
              <i class="material-icons text-success me-2">home</i>
              <span>{{ $farmer->farm_name }}</span>
            </div>
            <div class="d-flex align-items-center text-muted">
              <i class="material-icons text-success me-2">email</i>
              <span>{{ $farmer->user->email }}</span>
            </div>
          </div>
          <a href="{{ route('efarmers', ['id'=>$farmer->id ]) }}" class="btn btn-outline-success d-flex align-items-center gap-2">
            <i class="material-icons">edit</i>
            <span>Edit Profile</span>
          </a>
        </div>
      </div>

      <!-- Farm Details -->
      <div class="card-body">
        <h3 class="h5 mb-4 d-flex align-items-center">
          <i class="material-icons text-success me-2">grass</i>
          Farm Details
        </h3>
        <div class="row g-4">
          <div class="col-md-4">
            <div class="bg-light rounded p-3 h-100">
              <div class="d-flex align-items-center">
                <div class="icon-container bg-success rounded d-flex align-items-center justify-content-center me-3">
                  <i class="material-icons text-white">area_chart</i>
                </div>
                <div>
                  <div class="fw-medium">Farm Size</div>
                  <div class="text-success">{{ $farmer->farm_size }} acres</div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="bg-light rounded p-3 h-100">
              <div class="d-flex align-items-center">
                <div class="icon-container bg-success rounded d-flex align-items-center justify-content-center me-3">
                  <i class="material-icons text-white">location_on</i>
                </div>
                <div>
                  <div class="fw-medium">Location</div>
                  <div class="text-success">{{ $farmer->farm_address }}</div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="bg-light rounded p-3 h-100">
              <div class="d-flex align-items-center">
                <div class="icon-container bg-success rounded d-flex align-items-center justify-content-center me-3">
                  <i class="material-icons text-white">nature_people</i>
                </div>
                <div>
                  <div class="fw-medium">Farming Type</div>
                  <div class="text-success">{{ $farmer->type_of_farming }}</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Financial Details -->
    <div class="card hover-scale">
      <div class="card-body">
        <h3 class="h5 mb-4 d-flex align-items-center">
          <i class="material-icons text-primary me-2">account_balance_wallet</i>
          Financial Information
        </h3>
        <div class="row g-4">
          <div class="col-md-6">
            <div class="bg-light rounded p-3 h-100">
              <div class="d-flex align-items-center">
                <div class="icon-container bg-primary rounded d-flex align-items-center justify-content-center me-3">
                  <i class="material-icons text-white">phone_android</i>
                </div>
                <div>
                  <div class="fw-medium">Mobile Money</div>
                  <div class="text-primary">{{ $farmer->mobile_money_number }}</div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="bg-light rounded p-3 h-100">
              <div class="d-flex align-items-center">
                <div class="icon-container bg-primary rounded d-flex align-items-center justify-content-center me-3">
                  <i class="material-icons text-white">account_balance</i>
                </div>
                <div>
                  <div class="fw-medium">Bank Details</div>
                  <div class="text-primary">{{ $farmer->bank_name }}</div>
                  <div class="small text-muted">Acc: {{ $farmer->bank_account_number }}</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</div>
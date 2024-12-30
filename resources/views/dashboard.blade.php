<x-app-layout>
    <div class="content-wrapper">
        <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">Welcome{{ auth()->user()->name }}</h3>
                <h6 class="font-weight-normal mb-0">Dashboard Overview<span class="text-primary"></span></h6>
            </div>
            <div class="col-12 col-xl-4">
                <div class="justify-content-end d-flex">
                <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                {{-- <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                    <a class="dropdown-item" href="#">January - March</a>
                    <a class="dropdown-item" href="#">March - June</a>
                    <a class="dropdown-item" href="#">June - August</a>
                    <a class="dropdown-item" href="#">August - November</a>
                </div> --}}
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
        <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card tale-bg">
            <div class="card-people mt-auto">
                <img src="images/dashboard/people.svg" alt="people">
                <div class="weather-info">
                <div class="d-flex">
                    <div>
                    <h2 class="mb-0 font-weight-normal"><i class="icon-sun mr-2"></i>31<sup>C</sup></h2>
                    </div>
                    <div class="ml-2">
                    <h4 class="location font-weight-normal">Lusaka</h4>
                    <h6 class="font-weight-normal">Zambia</h6>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin transparent">
            <div class="row">
            <div class="col-md-6 mb-4 stretch-card transparent">
                <div class="card card-tale">
                <div class="card-body">
                    <p class="mb-4">Today’s Prospects</p>
                    <p class="fs-30 mb-2">{{ $prospects->where('created_at', '>=', now()->startOfDay())->count() }}</p>
                    <p>10.00% (30 days)</p>
                </div>
                </div>
            </div>
            <div class="col-md-6 mb-4 stretch-card transparent">
                <div class="card card-dark-blue">
                <div class="card-body">
                    <p class="mb-4">Total Prospects</p>
                    <p class="fs-30 mb-2">{{ $prospects->count() }}</p>
                    <p>22.00% (30 days)</p>
                </div>
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                <div class="card card-light-blue">
                <div class="card-body">
                    <p class="mb-4">Total Farmers</p>
                    <p class="fs-30 mb-2">{{ $farmers->count() }}</p>
                    <p>2.00% (30 days)</p>
                </div>
                </div>
            </div>
            <div class="col-md-6 stretch-card transparent">
                <div class="card card-light-danger">
                <div class="card-body">
                    <p class="mb-4">Active Modules</p>
                    <p class="fs-30 mb-2">{{ $moduleCounts['available'] }}</p>
                    <p>0.22% (30 days)</p>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>

        <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card position-relative">
            <div class="card-body">
                <div id="detailedReports" class="carousel slide detailed-report-carousel position-static pt-2" data-ride="carousel">
                <div class="carousel-inner">

                    <div class="carousel-item active">
                    <div class="row">
                        <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                        <div class="ml-xl-4 mt-3">
                        <p class="card-title">Detailed Reports</p>
                            <h1 class="text-primary">{{ $all_farmers->count() }}</h1>
                            <h3 class="font-weight-500 mb-xl-4 text-primary">Zambia Overall Farmers</h3>
                            <p class="mb-2 mb-xl-0">The total number of sessions within the date range. It is the period time a user is actively engaged with your website, page or app, etc</p>
                        </div>
                        </div>
                        <div class="col-md-12 col-xl-9">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive mb-3 mb-md-0 mt-3">
                                    <table class="table table-borderless report-table">
                                    <tr>
                                        <td class="text-muted">Lusaka</td>
                                        <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        </td>
                                        <td><h5 class="font-weight-bold mb-0">713</h5></td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Copperbelt</td>
                                        <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        </td>
                                        <td><h5 class="font-weight-bold mb-0">583</h5></td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Livingstone</td>
                                        <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        </td>
                                        <td><h5 class="font-weight-bold mb-0">924</h5></td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Southern</td>
                                        <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        </td>
                                        <td><h5 class="font-weight-bold mb-0">664</h5></td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Western</td>
                                        <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        </td>
                                        <td><h5 class="font-weight-bold mb-0">560</h5></td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Eastern</td>
                                        <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        </td>
                                        <td><h5 class="font-weight-bold mb-0">793</h5></td>
                                    </tr>
                                    </table>
                                </div>
                            </div>
                            {{-- <div class="col-md-6 mt-3">
                                <canvas id="south-america-chart"></canvas>
                                <div id="south-america-legend"></div>
                            </div> --}}
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#detailedReports" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#detailedReports" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
                </div>
            </div>
            </div>
        </div>
        </div>


        <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
            <div class="card-body">
                <p class="card-title">Latest 10 Farmers</p>
                <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                    <table id="exampleData" class="display expandable-table" style="width:100%">
                        <thead>
                        <tr>
                            <th>ID#</th>
                            <th>Name</th>
                            <th>Farming Category</th>
                            <th>NRC No.</th>
                            <th>Date of Birth</th>
                            <th>Status</th>
                            <th>Updated at</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($latestFarmers as $farmer)
                            <tr>
                                <td>{{ $farmer->id }}</td>
                                <td>{{ $farmer->user->fname.' '.$farmer->user->lname }}</td>
                                <td>{{ $farmer->type_of_farming }}</td>
                                <td>--</td>
                                <td>--</td>
                                <td>{{ $farmer->is_prospect ? 'Prospect' : 'Farmer' }}</td>
                                <td>{{ $farmer?->updated_at->format('d-m-Y H:i') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
                </div>
                </div>
            </div>


            </div>
        </div>
    </div>

</x-app-layout>

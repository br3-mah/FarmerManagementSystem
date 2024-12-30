@extends('farmsupport::layouts.master')

@section('content')
<div class="content-wrapper">
    <h1>Farmer Support</h1>


    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    
    <div class="content-wrapper">
        <section class="hero-section text-center">
            <div class="container">
                <h1 class="display-4 mb-4">Welcome to Farmer Support Center</h1>
                <p class="lead mb-4">Your trusted partner in agricultural success</p>
                <button class="btn btn-custom btn-lg">Get Started</button>
            </div>
        </section>

        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card feature-card">
                        <div class="card-body text-center">
                            <div class="feature-icon">🌱</div>
                            <h3 class="card-title">Expert Guidance</h3>
                            <p class="card-text">Access professional agricultural advice and support whenever you need it.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card">
                        <div class="card-body text-center">
                            <div class="feature-icon">📱</div>
                            <h3 class="card-title">Mobile Support</h3>
                            <p class="card-text">Get instant support through our mobile app and stay connected on the go.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card">
                        <div class="card-body text-center">
                            <div class="feature-icon">🎓</div>
                            <h3 class="card-title">Training Resources</h3>
                            <p class="card-text">Access comprehensive training materials and educational resources.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="module-info text-center mt-5">
                <p class="mb-0">Module: {!! config('farmsupport.name') !!}</p>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>

    <p>Module: {!! config('farmsupport.name') !!}</p>
</div>
@endsection

@extends('farmsupport::layouts.master')

@section('content')
<div class="content-wrapper">
    <h1>Farmer Support</h1>


    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-green: #2e7d32;
            --light-green: #4caf50;
            --pale-green: #e8f5e9;
        }

        .hero-section {
            background: linear-gradient(rgba(46, 125, 50, 0.9), rgba(46, 125, 50, 0.7)),
                        url('/api/placeholder/1200/400');
            color: white;
            padding: 4rem 0;
            margin-bottom: 2rem;
        }

        .feature-card {
            border: none;
            border-radius: 15px;
            transition: transform 0.3s ease;
            background: var(--pale-green);
            margin-bottom: 1.5rem;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .feature-icon {
            font-size: 2.5rem;
            color: var(--primary-green);
            margin-bottom: 1rem;
        }

        .btn-custom {
            background-color: var(--primary-green);
            color: white;
            padding: 0.8rem 2rem;
            border-radius: 25px;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-custom:hover {
            background-color: var(--light-green);
            color: white;
        }

        .content-wrapper {
            padding: 2rem 0;
        }

        .module-info {
            background: var(--pale-green);
            padding: 1rem;
            border-radius: 10px;
            margin-top: 2rem;
        }
    </style>
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

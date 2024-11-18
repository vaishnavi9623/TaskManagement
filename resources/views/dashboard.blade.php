@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Welcome to Your Dashboard</h1>
            <p class="text-center">Here you can find the overview of your activities and progress.</p>
        </div>
    </div>

    <!-- Cards Section -->
    <div class="row">
        <!-- Card 1 -->
        
        <div class="col-sm-4">
            <div class="card bg-warning text-light">
                <div class="card-header text-center fs-4 fw-bold">Total Tasks</div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-4">
                        <div class="text-center">
                            <h5 class="card-title">200</h5>
                            <p class="card-text">Assigned</p>
                        </div>
                        <hr style="width: 2px; height: 80px; border-width: 0; color: gray; background-color: gray;">
                        <div class="text-center">
                            <h5 class="card-title">10</h5>
                            <p class="card-text">Pending</p>
                        </div>
                        <hr style="width: 2px; height: 80px; border-width: 0; color: gray; background-color: gray;">
                        <div class="text-center">
                            <h5 class="card-title">150</h5>
                            <p class="card-text">Completed</p>
                        </div>
                    </div>
                    <a href="#" class="btn btn-light w-100">View More</a>
                </div>
            </div>
        </div>
        
        <div class="col-sm-4">
            <div class="card bg-danger text-light">
                <div class="card-header text-center fs-4 fw-bold">Total Projects</div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-4">
                        <div class="text-center">
                            <h5 class="card-title">200</h5>
                            <p class="card-text">Assigned</p>
                        </div>
                        <hr style="width: 2px; height: 80px; border-width: 0; color: gray; background-color: gray;">
                        <div class="text-center">
                            <h5 class="card-title">10</h5>
                            <p class="card-text">Pending</p>
                        </div>
                        <hr style="width: 2px; height: 80px; border-width: 0; color: gray; background-color: gray;">
                        <div class="text-center">
                            <h5 class="card-title">150</h5>
                            <p class="card-text">Completed</p>
                        </div>
                    </div>
                    <a href="#" class="btn btn-light w-100">View More</a>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="card bg-primary text-light">
                <div class="card-header text-center fs-4 fw-bold">Total Tasks</div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-4">
                        <div class="text-center">
                            <h5 class="card-title">200</h5>
                            <p class="card-text">Assigned</p>
                        </div>
                        <hr style="width: 2px; height: 80px; border-width: 0; color: gray; background-color: gray;">
                        <div class="text-center">
                            <h5 class="card-title">10</h5>
                            <p class="card-text">Pending</p>
                        </div>
                        <hr style="width: 2px; height: 80px; border-width: 0; color: gray; background-color: gray;">
                        <div class="text-center">
                            <h5 class="card-title">150</h5>
                            <p class="card-text">Completed</p>
                        </div>
                    </div>
                    <a href="#" class="btn btn-light w-100">View More</a>
                </div>
            </div>
        </div>
    <!-- Statistics Section -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-orange text-white">Statistics Overview</div>
                <div class="card-body">
                    <h5 class="card-title">Statistics</h5>
                    <p class="card-text">Here you can add graphs, charts, or any other statistics-related information.</p>
                    <a href="#" class="btn btn-orange">View Detailed Stats</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layout.app')
@section('main')
    <div class="container ps-3">
        <div class="ps-3">
            <h3> Dashboard </h3>
            <p>Welcome back! Here's what's happening at your bike service center.</p>
        </div>
        <div class="row">
            <div class="container ">
                <div class="row pt-4">

                    <div class="col-md-6 col-xl-3">
                        <div class="card bg-success  shadow rounded-5   order-card">
                            <div class="card-body text-dark ">

                                <p>Today's Bookings </p>
                                <h5> {{ $bookings->count() }} </h5>
                                <p>+3 from yesterday </p>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div class="card bg-success  shadow rounded-5   order-card">
                            <div class="card-body text-dark ">
                                <p>Low Stock Items </p>
                                <h5> 5 </h5>
                                <p>+3 from yesterday </p>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div class="card bg-success  shadow rounded-5   order-card">
                            <div class="card-body text-dark ">

                                <p>Revenue Today</p>
                                <h5> 5 </h5>
                                <p>+3 from yesterday </p>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div class="card bg-success  shadow rounded-5 order-card">
                            <div class="card-body text-dark ">

                                <p>Active Customers </p>
                                <h5> {{ $bookings->count() }} </h5>
                                <p>+3 from yesterday </p>

                            </div>
                        </div>
                    </div>

                </div>
            </div>



        </div>

        <div class="row  mt-3 shadow">


            <div class="col-8 ">
                <div class="bg-white rounded-4 shadow p-4">
                    <div class="d-flex justify-content-between align-items-center between mb-4">
                        <h2 class="text-xl font-semibold ">Today's Bookings</h2>
                        <button class="btn text-primary ">View All</button>
                    </div>
                      @foreach ($bookings as $booking)
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center  pt-3 px-3 border border-info rounded-4 ">
                            <div class="d-flex  align-items-center gap-4">
                                <div class="d-flex  gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-alert-circle h-4 w-4 text-blue-500">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" x2="12" y1="8" y2="12"></line>
                                        <line x1="12" x2="12.01" y1="16" y2="16"></line>
                                    </svg>
                                    <span
                                        class="px-2 py-1 rounded-5 text-xs font-medium bg-info text-white"> {{ ucfirst($booking->status) }} </span>
                                </div>
                                <div>
                                    <p class="font-medium text-dark">{{ ucfirst($booking->customerName) }}</p>
                                    <p class="text-sm text-dark">{{ ucfirst($booking->bikeBrand) }} {{ ucfirst($booking->bikeType) }} {{ ucfirst($booking->year) }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-medium text-gray-900">Premium Service</p>
                                <p class="text-sm text-gray-600">{{ ucfirst($booking->preferredTime) }}</p>
                            </div>
                        </div>
                    </div>
                     @endforeach
                </div>
            </div>

            <div class="col-3 pt-2 shadow">

                <div class="bg-white rounded-4 mb-4 shadow-sm p-4">
                   <div class="row m-0">
                    <h3> Quick Actions </h3>
                    <div class="col-12 p-2 mb-2 text-white text-center rounded-4 bg-primary ">
                        New Service Booking
                    </div>
                    <div class="col-12  mb-2 p-2 text-white text-center rounded-4 bg-success ">
                        New Service Booking
                    </div>
                    <div class="col-12 p-2  mb-2 text-white text-center rounded-4 bg-danger ">
                        New Service Booking
                    </div>
               </div>
                </div>
                    <div class="col-12 pb-4">
                        <div class="bg-white rounded-4 shadow-sm px-4 pt-3">
                            <h3 class="text-lg font-semibold text-dark fw-bold mb-4">Alerts</h3>
                            <div class="mb-4">
                                <div class="d-flex  items-start gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-alert-circle h-5 me-2 w-5 text-red-500 mt-0.5">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" x2="12" y1="8" y2="12"></line>
                                        <line x1="12" x2="12.01" y1="16" y2="16"></line>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-dark">Low Stock Alert</p>
                                        <p class="text-xs text-dark">Brake pads running low (3 units left)</p>
                                    </div>
                                </div>
                                <div class="d-flex  items-start space-x-3"><svg xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="lucide lucide-clock h-5 me-2 w-5 text-yellow-500 mt-0.5">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <polyline points="12 6 12 12 16 14"></polyline>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-dark">Overdue Service</p>
                                        <p class="text-xs text-dark">2 bikes exceed expected completion time</p>
                                    </div>
                                </div>
                                <div class=" d-flex items-start space-x-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-trending-up h-5 w-5 text-green-500 mt-0.5">
                                        <polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline>
                                        <polyline points="16 7 22 7 22 13"></polyline>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-dark">Great Performance</p>
                                        <p class="text-xs text-dark">15% increase in bookings this week</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

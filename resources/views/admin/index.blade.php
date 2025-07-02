@extends('layout.app')
@section('main')
    <div class="container ps-3">
        <div class="ps-3">
            <h3> Service Dashboard </h3>
            <p>Welcome back! Here's what's happening at your bike service center.</p>
        </div>
        <div class="row">
            <div class="col-3 px-4  py-3 shadow ">
                <p>Today's Bookings </p>
                <h5> {{ $bookings->count() }} </h5>
                <p>+3 from yesterday </p>
            </div>
            <div class="col-3 px-4  py-3  shadow ">
                <p>Active Customers </p>
                <h5> {{  $bookings->count() }} </h5>
                <p>+3 from yesterday </p>
            </div>
            <div class="col-3  px-4  py-3  shadow ">
                <p>Low Stock Items </p>
                <h5> 5 </h5>
                <p>+3 from yesterday </p>
            </div>
            <div class="col-3 px-4  py-3  shadow ">
                <p>Revenue Today</p>
                <h5> 5 </h5>
                <p>+3 from yesterday </p>
            </div>
        </div>

        <div class="row  mt-5 shadow">
            <div class="col-8">
                <div class="row m-0">
                    <div class="col-12 pt-2 shadow ">
                        <div class="d-flex">
                            <h3 class=""> Today's Bookings </h3>
                            <h3 class="ms-auto">View All </h3>
                        </div>
                        @foreach ($bookings as $booking )


                        <div class=" rounded-4 d-flex mt-2 mb-1 p-3 align-item-center " style="border: 1px solid black">
                            <h5> {{ $booking->status }} </h5>
                            <div class="ps-3 text-center">
                                <h4> {{$booking->customerName }} </h4>
                                <p>{{ $booking->bikeBrand}} {{ $booking->bikeType}} {{ $booking->year}} </p>
                            </div>
                            <div class="ms-auto text-center">
                                <h4> Premium Service</h4>
                                <p> {{ $booking->preferredTime}} </p>
                            </div>
                        </div>
                     @endforeach
                    </div>

                </div>

            </div>
            <div class="col-3 pt-2 shadow">
                <h3> Quick Actions </h3>
                <div class="row m-0">
                    <div class="col-12 p-2 mb-2 text-white text-center rounded-4 bg-primary ">
                        New Service Booking
                    </div>
                    <div class="col-12  mb-2 p-2 text-white text-center rounded-4 bg-success ">
                        New Service Booking
                    </div>
                    <div class="col-12 p-2  mb-2 text-white text-center rounded-4 bg-danger ">
                        New Service Booking
                    </div>
                    <div class="col-12 pb-4">
                        <div class="bg-white rounded-4 shadow-sm p-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Alerts</h3>
                            <div class="space-y-3">
                                <div class="d-flex  items-start space-x-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-alert-circle h-5 me-2 w-5 text-red-500 mt-0.5">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" x2="12" y1="8" y2="12"></line>
                                        <line x1="12" x2="12.01" y1="16" y2="16"></line>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Low Stock Alert</p>
                                        <p class="text-xs text-gray-600">Brake pads running low (3 units left)</p>
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
                                        <p class="text-sm font-medium text-gray-900">Overdue Service</p>
                                        <p class="text-xs text-gray-600">2 bikes exceed expected completion time</p>
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
                                        <p class="text-sm font-medium text-gray-900">Great Performance</p>
                                        <p class="text-xs text-gray-600">15% increase in bookings this week</p>
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

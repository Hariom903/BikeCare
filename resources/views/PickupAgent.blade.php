@extends('layout.app')
@section('main')

    <div class="container pt-4">
        <div class="ps-3">
            <h3 style="color:rgb(100, 9, 100); font-weight:bold"> Booking Management </h3>
            <p>Manage and track all service bookings</p>
        </div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                    role="tab" aria-controls="home" aria-selected="true"> Pending for Assigning </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                    role="tab" aria-controls="profile" aria-selected="false">Assigned Booking </button>
            </li>

        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">


                <table class="table display" id="myTablePending">
                    <thead style=" background-color: rgb(69, 3, 75);">
                        <tr class="text-center">

                            <th>Booking ID</th>
                            <th>Customer</th>
                            <th>Bike & Service</th>
                            <th>Date & Time</th>
                            <th>Status</th>
                            <th>Service Type</th>
                            <th>Cost</th>
                            <th>Opretion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr class="text-center">

                                <td>{{ $booking->booking_id }}</td>
                                <td>{{ $booking->customerName }} <br> {{ $booking->email }} ({{ $booking->phone }})</td>
                                <td>{{ $booking->bikeBrand }} {{ $booking->bikeType }} {{ $booking->year }}</td>
                                <td>{{ $booking->preferredDate }} {{ $booking->preferredTime }}</td>
                                <td>{{ $booking->status }}</td>
                                <td>{{ $booking->service_type }}</td>
                                <td>{{ $booking->cost ?? 'N/A' }}</td>
                                <td>
                                    <form action="{{ route('booking.pickup',$booking->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"> Bike Pick   </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>


        </div>
    </div>
@endsection

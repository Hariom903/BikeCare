@extends('layout.app')

@section('main')
    <div class="container pt-4">
        <div class="ps-3">
            <h3 style="color:rgb(100, 9, 100); font-weight:bold"> Booking Management </h3>
            <p>Manage and track all service bookings</p>
        </div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="PendingBooking-tab" data-bs-toggle="tab" data-bs-target="#PendingBooking "
                    type="button" role="tab" aria-controls="PendingBooking" aria-selected="true"> Pending Booking
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="AssignedBooking-tab" data-bs-toggle="tab" data-bs-target="#AssignedBooking"
                    type="button" role="tab" aria-controls="AssignedBooking" aria-selected="false"> Assigned To Pickup
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="picked_up-tab" data-bs-toggle="tab" data-bs-target="#picked_up" type="button"
                    role="tab" aria-controls="picked_up" aria-selected="false"> Picked Up </button>
            </li>
            <li class="nav-item" role="technician">
                <button class="nav-link" id="assigned_to_technician-tab" data-bs-toggle="tab"
                    data-bs-target="#assigned_to_technician" type="button" role="tab"
                    aria-controls="assigned_to_technician" aria-selected="false"> Assigned to Technician </button>
            </li>
            <li class="nav-item" role="in_progress">
                <button class="nav-link" id="in_progress-tab" data-bs-toggle="tab"
                    data-bs-target="#in_progress" type="button" role="tab"
                    aria-controls="in_progress" aria-selected="false"> Progress  </button>
            </li>
            <li class="nav-item" role="completed">
                <button class="nav-link" id="completed-tab" data-bs-toggle="tab"
                    data-bs-target="#completed" type="button" role="tab"
                    aria-controls="completed" aria-selected="false">  Completed Booking </button>
            </li>

        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="PendingBooking" role="tabpanel" aria-labelledby="home-tab">


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
                            <th>Manage Booking </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            @if ($booking->status !== 'pending')
                                @continue
                            @endif
                            <tr class="text-center">

                                <td>{{ $booking->booking_id }}</td>
                                <td>{{ $booking->customerName }} <br> {{ $booking->email }} ({{ $booking->phone }})</td>
                                <td>{{ $booking->bikeBrand }} {{ $booking->bikeType }} {{ $booking->year }}</td>
                                <td>{{ $booking->preferredDate }} {{ $booking->preferredTime }}</td>
                                <td>{{ $booking->status }}</td>
                                <td>{{ $booking->service_type }}</td>
                                <td>{{ $booking->cost ?? 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('managebooking',$booking->id) }}" class="btn btn-p"> Manage Booking </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>
            <div class="tab-pane fade" id="AssignedBooking" role="tabpanel" aria-labelledby="profile-tab">

                <table class="table display myTable" id="myTableAssigned">
                    <thead style=" background-color: rgb(69, 3, 75);">
                        <tr class="text-center">

                            <th>Booking ID</th>
                            <th>Customer</th>
                            <th>Bike & Service</th>
                            <th>Date & Time</th>
                            <th>Status</th>
                            <th>Cost</th>
                            <th> Pickup Agent Name</th>
                            <th> Manage Booking </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            @if ($booking->status !== 'assigned_to_pickup')
                                @continue
                            @endif

                            <tr class="text-center">

                                <td>{{ $booking->booking_id }}</td>
                                <td>{{ $booking->customerName }} <br> {{ $booking->email }} ({{ $booking->phone }})</td>
                                <td>{{ $booking->bikeBrand }} {{ $booking->bikeType }} {{ $booking->year }}</td>
                                <td>{{ $booking->preferredDate }} {{ $booking->preferredTime }}</td>
                                <td>{{ $booking->status }}</td>
                                <td>{{ $booking->cost ?? 'N/A' }}</td>
                                <td>
                                    {{ $booking->pickupAgent->name }}
                                </td>
                                <td>
                                    <a href="{{ route('managebooking',$booking->id) }}" class="btn btn-p"> Manage Booking </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>



            </div>
            <div class="tab-pane fade" id="picked_up" role="tabpanel" aria-labelledby="picked_up-tab">
                <table class="table display myTable" id="myTableAssigned">
                    <thead style=" background-color: rgb(69, 3, 75);">
                        <tr class="text-center">

                            <th>Booking ID</th>
                            <th>Customer</th>
                            <th>Bike & Service</th>
                            <th>Date & Time</th>
                            <th>Status</th>
                            <th>Cost</th>
                            <th>Pickup Agent Name</th>
                            <th> Manage Booking </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            @if ($booking->status !== 'picked_up')
                                @continue
                            @endif

                            <tr class="text-center">

                                <td>{{ $booking->booking_id }}</td>
                                <td>{{ $booking->customerName }} <br> {{ $booking->email }} ({{ $booking->phone }})</td>
                                <td>{{ $booking->bikeBrand }} {{ $booking->bikeType }} {{ $booking->year }}</td>
                                <td>{{ $booking->preferredDate }} {{ $booking->preferredTime }}</td>
                                <td>{{ $booking->status }}</td>
                                <td>{{ $booking->cost ?? 'N/A' }}</td>
                                <td>
                                    {{ $booking->pickupAgent->name ?? ' ' }}
                                </td>
                                <td>
                                    <a href="{{ route('managebooking',$booking->id) }}" class="btn btn-p"> Manage Booking </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>



            </div>
            <div class="tab-pane fade" id="assigned_to_technician" role="tabpanel" aria-labelledby="assigned_to_technician-tab">
                <table class="table display myTable" id="myTableAssigned">
                    <thead style=" background-color: rgb(69, 3, 75);">
                        <tr class="text-center">

                            <th>Booking ID</th>
                            <th>Customer</th>
                            <th>Bike & Service</th>
                            <th>Date & Time</th>
                            <th>Status</th>
                            <th>Cost</th>
                            <th>Technician Name</th>
                            <th> Manage Booking </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            @if ($booking->status !== 'assigned_to_technician')
                                @continue
                            @endif

                            <tr class="text-center">

                                <td>{{ $booking->booking_id }}</td>
                                <td>{{ $booking->customerName }} <br> {{ $booking->email }} ({{ $booking->phone }})</td>
                                <td>{{ $booking->bikeBrand }} {{ $booking->bikeType }} {{ $booking->year }}</td>
                                <td>{{ $booking->preferredDate }} {{ $booking->preferredTime }}</td>
                                <td>{{ $booking->status }}</td>
                                <td>{{ $booking->cost ?? 'N/A' }}</td>
                                <td>
                                    {{ $booking->technician->name ?? ' ' }}
                                </td>
                                <td>
                                    <a href="{{ route('managebooking',$booking->id) }}" class="btn btn-p"> Manage Booking </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>



            </div>
            <div class="tab-pane fade" id="in_progress" role="tabpanel" aria-labelledby="in_progress-tab">
                <table class="table display myTable" id="myTableAssigned">
                    <thead style=" background-color: rgb(69, 3, 75);">
                        <tr class="text-center">

                            <th>Booking ID</th>
                            <th>Customer</th>
                            <th>Bike & Service</th>
                            <th>Date & Time</th>
                            <th>Status</th>
                            <th>Cost</th>
                            <th>Technician  Name</th>
                            <th> Manage Booking </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            @if ($booking->status !== 'in_progress')
                                @continue
                            @endif

                            <tr class="text-center">

                                <td>{{ $booking->booking_id }}</td>
                                <td>{{ $booking->customerName }} <br> {{ $booking->email }} ({{ $booking->phone }})</td>
                                <td>{{ $booking->bikeBrand }} {{ $booking->bikeType }} {{ $booking->year }}</td>
                                <td>{{ $booking->preferredDate }} {{ $booking->preferredTime }}</td>
                                <td>{{ $booking->status }}</td>
                                <td>{{ $booking->cost ?? 'N/A' }}</td>
                                <td>
                                    {{ $booking->technician->name ?? ' ' }}
                                </td>
                                <td>
                                    <a href="{{ route('managebooking',$booking->id) }}" class="btn btn-p"> Manage Booking </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>



            </div>
            <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                <table class="table display myTable" id="myTableAssigned">
                    <thead style=" background-color: rgb(69, 3, 75);">
                        <tr class="text-center">

                            <th>Booking ID</th>
                            <th>Customer</th>
                            <th>Bike & Service</th>
                            <th>Date & Time</th>
                            <th>Status</th>
                            <th>Cost</th>
                           <th>Pickup Agent Name</th>
                             <th>Technician  Name</th>
                            <th>Manage Booking </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            @if ($booking->status !== 'completed')
                                @continue
                            @endif

                            <tr class="text-center">

                                <td>{{ $booking->booking_id }}</td>
                                <td>{{ $booking->customerName }} <br> {{ $booking->email }} ({{ $booking->phone }})</td>
                                <td>{{ $booking->bikeBrand }} {{ $booking->bikeType }} {{ $booking->year }}</td>
                                <td>{{ $booking->preferredDate }} {{ $booking->preferredTime }}</td>
                                <td>{{ $booking->status }}</td>
                                <td>{{ $booking->cost ?? 'N/A' }}</td>
                                <td>
                                    {{ $booking->pickupAgent->name ?? ' ' }}
                                </td>
                                <td>
                                    {{ $booking->technician->name ?? ' ' }}
                                </td>
                                <td>
                                    <a href="{{ route('managebooking',$booking->id) }}" class="btn btn-p"> Manage Booking </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>



            </div>

        </div>
    </div>



    <script>
        $(document).ready(function() {
            $('#myTablePending').DataTable({


            });

            $('#myTableAssigned').DataTable();
            $('#myTableassigned').DataTable();

        })
    </script>
@endsection

@extends('layout.app')

@section('main')

<div class="container">
    <div class="ps-3">
    <h3> Booking Management </h3>
    <p>Manage and track all service bookings</p>
    </div>
    <table class="table display" id="myTable">
        <thead>
            <tr class="text-center">
                <td> Select  </td>
                <th> Booking ID </th>
                <th>Customer </th>
                <th> Bike & Service</th>
                <th> Date & Time  </th>
                <th> Status</th>
               <th> Cost </th>
               <th> Action</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $booking)
                <tr class="text-center">
                    <td> <input type="checkbox" name="{{ $booking->booking_id}} " id="{{ $booking->booking_id}} "></td>
                   <td> {{ $booking->booking_id}} </td>
                   <td > {{ $booking->customerName}} <br>  {{ $booking->email}} ({{  $booking->phone }}) </td>
                   <td>{{ $booking->bikeBrand}} {{ $booking->bikeType}} {{ $booking->year}}  </td>
                   <td>{{ $booking->preferredDate}}  {{ $booking->preferredTime}}  </td>
                   <td> {{ $booking->status}} </td>
                   <td> </td>
                   <td>
                    <button class="btn btn-info"> See </button>
                    <button class="btn btn-info"> Edit  </button>
                    <button class="btn btn-info"> Delete  </button>

                   </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
@endsection

@extends('layout.app')

@section('main')
    <div class="container pt-4">
        <div class="ps-3">
            <h3 style="color:rgb(100, 9, 100); font-weight:bold">  Service Management </h3>
            <p>Manage and track all service bookings</p>
        </div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                    role="tab" aria-controls="home" aria-selected="true">  Assigning </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab"  data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Assigned Booking </button>
      </li>

    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">


              <table class="table display" id="myTablePending">
                  <thead style=" background-color: rgb(69, 3, 75);">
                      <tr class="text-center">
                          <th><input type="checkbox" id="select_all"> Select all </th>
                          <th>Booking ID</th>
                          <th>Customer</th>
                          <th>Bike & Service</th>
                          <th>Date & Time</th>
                          <th>Status</th>
                          <th>Service Type</th>
                          <th>Cost</th>
                          <th>Assign picup Agent </th>
                      </tr>
                  </thead>
                  <tbody>
                       @foreach ($bookings as $booking)

                    <tr class="text-center">
                        <td><input type="checkbox" class="booking_checkbox" value="{{ $booking->booking_id }}"></td>
                        <td>{{ $booking->booking_id }}</td>
                        <td>{{ $booking->customerName }} <br> {{ $booking->email }} ({{ $booking->phone }})</td>
                        <td>{{ $booking->bikeBrand }} {{ $booking->bikeType }} {{ $booking->year }}</td>
                        <td>{{ $booking->preferredDate }} {{ $booking->preferredTime }}</td>
                        <td>{{ $booking->status }}</td>
                        <td>{{ $booking->service_type }}</td>
                        <td>{{ $booking->cost ?? 'N/A' }}</td>
                        <td>
                             <select class="picupAgents_dropdown form-select form-select-sm"
                                data-booking-id="{{ $booking->booking_id }}">
                                <option value="">Select
                                  @if($booking->service_type=='drop')
                                 Technician
                                 @else
                                 Picup Agent
                                  @endif
                                </option>
                                @foreach ($picupAgents as $picupAgent)
                                    <option value="{{ $picupAgent->id }}">{{ $picupAgent->name }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                    </table>

                    <button id="assignBtn" class="btn btn-primary mt-3">Assign Selected</button>
    </div>

    </div>
    </div>



    <script>
        $(document).ready(function() {
            $('#myTablePending').DataTable({


            });

            $('#myTableAssigned').DataTable();
            $('#myTableassigned').DataTable();

            $('#select_all').on('click', function() {
                $('.booking_checkbox').prop('checked', this.checked);
            });

            $('#assignBtn').on('click', function() {
                const selectedBookings = [];
                const managerMap = {};
                let hasError = false;

                $('.booking_checkbox:checked').each(function() {
                    const bookingId = $(this).val();
                    selectedBookings.push(bookingId);

                    const managerId = $(`.manager_dropdown[data-booking-id="${bookingId}"]`).val();
                    if (!managerId) {
                        alert("Please select a manager for Booking ID: " + bookingId);
                        hasError = true;
                    } else {
                        managerMap[bookingId] = managerId;
                    }
                });

                if (hasError) return;

                if (selectedBookings.length === 0) {
                    alert('Please select at least one booking.');
                    return;
                }

                // AJAX Call
                $.ajax({
                    url: "{{ route('bookings.assign.ajax') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        booking_ids: selectedBookings,
                        manager_ids: managerMap
                    },
                    success: function(response) {
                        alert(response.message);
                        location.reload();
                    },
                    error: function(xhr) {
                        console.error(xhr);
                        alert('Something went wrong while assigning bookings.');
                    }
                });
            });
        });
    </script>
@endsection

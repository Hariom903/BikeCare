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
                            <th>Assign Manager</th>
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
                                    @if ($booking->status == 'pending' && $booking->service_type == 'drop' || $booking->status == 'picked_up' )

                                            <button type="button" onclick="openassignTechnician('{{ $booking->id }}')"
                                                class="btn btn-primary mt-2">Assign Technician </button>



                                    @elseif($booking->status == 'pending' && $booking->service_type != 'drop')
                                        <button type="button" onclick="openassignPickupAgent('{{ $booking->id }}')"
                                            class="btn btn-primary mt-2">Assign Pickup Agent</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>


        </div>
    </div>
    <div class="modal fade" id="assignPickupAgent" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="assignPickupAgent">
                    <div class="modal-header">
                        <h5 class="modal-title">Pickup Agents </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden"  value="" id="booking_id">

                        <div class="mb-3">
                            <label> Pickup Agents </label>
                            <select class="" name="pickup_agent" id="pickup_agent">
                                <option value=""> - select Pickup Agent - </option>
                                @foreach ($pickupAgents as $pickupAgent)
                                    <option value="{{ $pickupAgent->id ?? '    ' }}"> {{ $pickupAgent->name ?? '' }}
                                    </option>
                                @endforeach

                            </select>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" onclick="updatebookingforpickup()" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="assignTechnician" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="assignTechnician">
                    <div class="modal-header">
                        <h5 class="modal-title"> Technician  </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" id="booking_id">

                        <div class="mb-3">
                            <label>  Technician  </label>
                            <select class="" name="assigned_technician_id" id="assigned_technician_id">
                                <option value=""> - select Technician  - </option>
                                @foreach ($technicians as $technician)
                                    <option value="{{ $technician->id ?? '    ' }}"> {{ $technician->name ?? '' }}
                                    </option>
                                @endforeach

                            </select>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" onclick="updatebookingfortechnician()" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#myTablePending').DataTable();
        });
        const assignPickupAgent = document.getElementById('assignPickupAgent');
        const editModal = new bootstrap.Modal(assignPickupAgent);

       function openassignPickupAgent(id) {
    document.getElementById('booking_id').value = id;
    editModal.show();
}
           const assignTechnician = document.getElementById('assignTechnician');
            const assignTechnicianModel = new bootstrap.Modal(assignTechnician);

    function openassignTechnician(id) {
    document.getElementById('booking_id').value = id;
    assignTechnicianModel.show();
}

      function updatebookingforpickup() {
    var pickup_agent_id = document.getElementById('pickup_agent').value;
    var id = document.getElementById('booking_id').value;

    $.ajax({
        url: "{{ route('assingbooking.pickupagent') }}",
        type: "POST",
        data: {
            "_token": "{{ csrf_token() }}",
            'id': id,
            'assigned_pickup_id': pickup_agent_id,
        },
        success: (res) => {
            alert(res.success);
            location.reload();
        },
        error: (error) => {
            alert("Error occurred!");
        }
    });
}

function updatebookingfortechnician(){
 var assigned_technician_id = document.getElementById('assigned_technician_id').value;
    var id = document.getElementById('booking_id').value;

    $.ajax({
        url: "{{ route('assingbooking.technician') }}",
        type: "POST",
        data: {
            "_token": "{{ csrf_token() }}",
            'id': id,
            'assigned_technician_id': assigned_technician_id,
        },
        success: (res) => {
            alert(res.success);
            location.reload();
        },
        error: (error) => {
            alert("Error occurred!");
        }
    });
}
    </script>
@endsection



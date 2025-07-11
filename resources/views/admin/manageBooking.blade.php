@extends('layout.app')
@section('main')
    <div class="container  pt-4 pb-4">
        <h3 style="color:rgb(100, 9, 100); font-weight:bold"> Manage Booking </h3>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Custmer Details  --}}


        <div class ="p-4 rounded shadow border">
            <h3>Customer Information</h3>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="customerName" class="form-control" value="{{ $booking->customerName }}"
                        readonly>

                </div>
                <div class="col-md-6">
                    <label class="form-label">Phone Number</label>
                    <input type="text" name="phone" class="form-control" value="{{ $booking->phone }}" readonly>

                </div>
                <div class="col-md-6">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" value="{{ $booking->email }}" readonly>

                </div>
                <div class="col-md-6">
                    <label class="form-label">Address</label>
                    <input type="text" name="address" class="form-control" value="{{ $booking->address }}" readonly>

                </div>
            </div>
        </div>
        {{-- Booking Details  --}}
        <div class="p-4 mt-4 rounded shadow border">
            <h3>Booking Information</h3>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Booking ID</label>
                    <input type="text" name="bookingId" class="form-control" value="{{ $booking->booking_id }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Booking Date</label>
                    <input type="text" name="bookingDate" class="form-control"
                        value="{{ $booking->created_at->format('Y-m-d H:i:s') }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Service Type</label>
                    <input type="text" name="serviceType" class="form-control" value="{{ $booking->service_type }}"
                        readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Service Description</label>
                    <textarea name="serviceDescription" class="form-control" rows="3" readonly>{{ $booking->issues }}</textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Pickup Address</label>
                    <input type="text" name="pickupAddress" class="form-control" value="{{ $booking->address }}"
                        readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Pickup Date</label>
                    <input type="text" name="pickupDate" class="form-control"
                        value="{{ $booking->preferredDate ? $booking->preferredDate . ' ' . $booking->preferredTime : 'Not Scheduled' }}"
                        readonly>
                </div>
                @if ($booking->service_type === 'pickup')
                    <div class="col-md-6">
                        <label class="form-label">Pickup Agent</label>
                        <input type="text" name="pickupAgent" class="form-control"
                            value="{{ $booking->pickupAgent ? $booking->pickupAgent->name : 'Not Assigned' }}" readonly>
                    </div>
                @endif
                <div class="col-md-6">
                    <label class="form-label">Technician</label>
                    <input type="text" name="technician" class="form-control"
                        value="{{ $booking->technician ? $booking->technician->name : 'Not Assigned' }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Status</label>
                    <input type="text" name="status" class="form-control" value="{{ $booking->status }}" readonly>
                </div>

            </div>
        </div>
        {{--  billing   --}}
        <div class="p-4 mt-4 rounded shadow border">
            <h3>Billing Information</h3>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Billing Address</label>
                    <input type="text" name="billingAddress" class="form-control"
                        value="{{ $booking->billingAddress ? $booking->billingAddress : 'Not Provided' }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Billing Date</label>
                    <input type="text" name="billingDate" class="form-control"
                        value="{{ $booking->billingDate ? $booking->billingDate->format('Y-m-d H:i:s') : 'Not Provided' }}"
                        readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Invoice Number</label>
                    <input type="text" name="invoiceNumber" class="form-control"
                        value="{{ $booking->invoiceNumber ? $booking->invoiceNumber : 'Not Generated' }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Total Amount</label>
                    <input type="text" name="totalAmount" class="form-control"
                        value="{{ $booking->totalAmount ? '$' . number_format($booking->totalAmount, 2) : 'Not Calculated' }}"
                        readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Payment Method</label>
                    <input type="text" name="billingPaymentMethod" class="form-control"
                        value="{{ $booking->billingPaymentMethod ? $booking->billingPaymentMethod : 'Not Provided' }}"
                        readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Payment Status</label>
                    <input type="text" name="billingPaymentStatus" class="form-control"
                        value="{{ $booking->billingPaymentStatus ? $booking->billingPaymentStatus : 'Not Provided' }}"
                        readonly>
                </div>
            </div>
        </div>
        {{-- Generate Bill  --}}
        {{-- <div class="p-4 mt-4 rounded shadow border">
            <h3>Generate Bill</h3>
            <p>Click the button below to generate a bill for this booking.</p>
            <form action="{{route('booking.generatebill',$booking->id)}}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">Generate Bill</button>
            </form>
        </div> --}}
        {{-- Action Buttons --}}
        {{-- status',['assigned_to_pickup','pending','completed','picked_up','assigned_to_technician','in_progress' --}}
        <div class="pt-3 mt-4">
            <a href="{{ route('booking') }}" class="btn btn-secondary">Back to Bookings</a>
            @if ($booking->status !== 'completed')
                <a href="{{ route('managebooking', $booking->id) }}" class="btn btn-primary">Edit Booking</a>
            @endif

            @if ($booking->status === 'pending' && $booking->service_type === 'pickup')
                <form action="{{ route('managebooking.assignpickupagent') }}" method="POST">
                    @csrf
                    <div class="row mt-3">

                        <div class="form-group col-sm-4 mb-3">
                            <input type="hidden" name="id" value="{{ $booking->id }}">
                            <label for="pickup_agent" class="form-label">Assign Pickup Agent</label>
                            <select name="assigned_pickup_id" id="pickup_agent" class="form-select">
                                <option value="">Select Pickup Agent</option>
                                @foreach ($pickupAgents as $agent)
                                    <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                                @endforeach
                            </select>
                            @error('pickup_agent')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                        </div>

                            @enderror
                        </div>
                        <div class="col-sm-3 mt-3 d-flex align-items-center">
                            <button type="submit" class="btn btn-success">Assign Pickup Agent</button>
                        </div>
                    </div>
                </form>
            @endif

        </div>
        @if ($booking->status === 'pending' && $booking->service_type === 'drop'||$booking->status === 'picked_up')
            <form action="{{route('managebooking.assigntechnician')}}" method="POST" class="pb-2 mb-3 mt-3 d-inline">
                @csrf
                <input type="hidden" name="id" value="{{ $booking->id }}">
                <div class="row mt-3">
                    <div class="form-group col-sm-4 mb-3">
                        <label for="technician" class="form-label">Assign Technician</label>
                        <select name="technician" id="technician" class="form-select">
                            <option value="">Select Technician</option>
                            @foreach ($technicians as $technician)
                                <option value="{{ $technician->id }}">{{ $technician->name }}</option>
                            @endforeach
                        </select>
                        @error('technician')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-3 d-flex align-items-center">

                <button type="submit" class="btn mt-3 mb-3 btn-success">Assign Technician</button>
                    </div>
                </div>


            </form>
        @endif

        @if ($booking->status === 'assigned_to_pickup')
            <form action="{{route('booking.pickup',$booking->id)}}" method="POST" class=" pb-2 d-inline">
                @csrf
                <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                <button type="submit" class="btn mt-3 mb-3 btn-success">Mark as Picked Up</button>
            </form>
        @endif


        @if ($booking->status === 'assigned_to_technician')
        <div class="mt-2">
        <form action="{{route('booking.in_progress',$booking->id)}}" method="POST" class=" d-inline">
                @csrf
                <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                <button type="submit" class="btn mt-3 mb-3 btn-success">Mark as In Progress</button>
            </form>
        </div>
        @endif
        @if ($booking->status === 'in_progress')
            <form action="{{route('booking.completed',$booking->id)}}" method="POST" class="pb-2 d-inline">
                @csrf
                <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                <button type="submit" class="btn mt-3 mb-3 btn-success">Mark as Completed</button>
            </form>
        @endif
        @if ($booking->status === 'completed')
            <form action="{{--  --}}" method="get" class="pb-2  d-inline">
                @csrf
                <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                <button type="submit" class="btn mt-3 mb-3 btn-success">Generate Invoice</button>
            </form>

            <form action="{{ route('booking.additionalOpretionParts') }}" method="GET" class="pb-2 d-inline">
                @csrf
                <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                <button type="submit" class="btn mt-3 mb-3 btn-success">Add Additional Opretion Parts</button>
            </form>
        @endif


    </div>
    </div>
@endsection

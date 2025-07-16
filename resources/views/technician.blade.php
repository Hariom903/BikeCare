@extends('layout.app')
@section('main')

<div class="container pt-4">
    <h3 style="color:purple; font-weight:bold">Technician Dashboard</h3>
    <p>Your assigned service bookings</p>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark text-center">
            <tr>
                <th>Booking ID</th>
                <th>Customer</th>
                <th>Bike</th>
                <th>Service & Issues</th>
                <th>Date & Time</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($bookings as $booking)
            <tr class="text-center">
                <td>{{ $booking->booking_id }}</td>
                <td>{{ $booking->customerName }}<br>{{ $booking->phone }}</td>
                <td>{{ $booking->bikeBrand }} {{ $booking->bikeModel }}<br>Year: {{ $booking->year }}<br>No: {{ $booking->bikenumber }}</td>
                <td>{{ $booking->service }}<br>{{ $booking->issues }}</td>
                <td>{{ $booking->preferredDate }}<br>{{ $booking->preferredTime }}</td>
                <td>
                    <span class="badge
                    @if($booking->status=='assigned_to_technician') bg-warning
                    @elseif($booking->status=='in_progress') bg-primary
                    @elseif($booking->status=='completed') bg-success
                    @endif">
                        {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                    </span>
                </td>
                <td>
                    @if($booking->status=='assigned_to_technician')
                    <form action="{{ route('technician.in_progress', $booking->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-sm btn-primary">Start Work</button>
                    </form>
                    @elseif($booking->status=='in_progress')
                    <form action="{{ route('technician.completed', $booking->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-sm btn-success">Mark Completed</button>
                    </form>
                    @else
                        <span class="text-muted">No Action</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center text-muted">No assigned bookings found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection

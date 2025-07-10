@extends('layout.app')

@section('main')
<div class="container pt-4">
    <h3 style="color:darkblue; font-weight:bold">Pickup Agent Dashboard</h3>
    <p>Your assigned bookings to pick up</p>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark text-center">
            <tr>
                <th>Booking ID</th>
                <th>Customer</th>
                <th>Address</th>
                <th>Bike</th>
                <th>Preferred Time</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($bookings as $booking)
            <tr class="text-center">
                <td>{{ $booking->booking_id }}</td>
                <td>
                    {{ $booking->customerName }}<br>
                    📞 <a href="tel:{{ $booking->phone }}">{{ $booking->phone }}</a>
                </td>
                <td>{{ $booking->address }}</td>
                <td>
                    {{ $booking->bikeBrand }} {{ $booking->bikeModel }}<br>
                    Reg No: {{ $booking->bikenumber }}
                </td>
                <td>{{ $booking->preferredDate }}<br>{{ $booking->preferredTime }}</td>
                <td>
                    <span class="badge bg-info">
                        {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                    </span>
                </td>
                <td>
                    <form action="{{ route('pickup.markPickedUp', $booking->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-success">
                            ✅ Mark Picked Up
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center text-muted">
                    No assigned bookings to pick up.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

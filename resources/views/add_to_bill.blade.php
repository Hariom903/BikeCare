@extends('layout.app')
@section('main')
<h3>Add Item to Bill pls select Vehicle  </h3>
 <div class="container pt-4">
    <form action="{{  route('add-item-bill')}}" method="GET">
         {{-- error message   --}}
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
        @csrf
     <div class="col-md-3">
            <label class="form-label"> Vehicle Namber  </label>
           <select name="booking_id" class="form-select" required>
                <option value="">-- Select Booking --</option>
                @foreach ($bookings as $booking)
                    <option value="{{ $booking->id }}">
                        {{ $booking->bikenumber }} - {{ $booking->service }}
                    </option>
                @endforeach
            </select>
            {{-- SUBMIT  --}}
            <button type="submit" class="btn btn-primary mt-2">Select</button>
        </div>

        </form>
</div>


@endsection

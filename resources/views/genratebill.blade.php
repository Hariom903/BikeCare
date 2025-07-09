@extends('layout.app')

@section('main')
    <div class="container pt-4">
        <h3>Generate Bill</h3>

        <form action="{{-- your-route-here --}}" method="POST">
            @csrf
            <div class = "row">
                <div class="col-sm-3 mb-3">
                    <div class="mb-3">
                        <label>Booking ID</label>
                        <input type="text" name="booking_id" value="{{ $booking->id }}" class="form-control" readonly
                            required>
                    </div>
                </div>
                <div class="col-sm-3 mb-3">
                    <div class="mb-3">
                        <label>Service Charges (₹)</label>
                        <input type="number" name="service_charge"
                            @if ($booking->service == 'Premium Service') value="200" @readonly(true)
                        @elseif ($booking->service == 'Standard Service')
                        value="150" @readonly(true)
                        @elseif ($booking->service == 'Basic Service')
                        value="100" @readonly(true)
                        @else
                        value="0" @readonly(false) @endif
                            class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-3 mb-3">
                    <div class="mb-3">
                        <label>Service type</label>
                        <input type="text" name="service_type " value="{{ $booking->service }}" class="form-control"
                            readonly required>
                    </div>

                </div>
                <div class="col-sm-3 mb-3">
                    <div class="mb-3">
                        <label>Bike Number </label>
                        <input type="text" name="BikeNumber" value="{{ $booking->bikenumber }}" class="form-control"
                            readonly required>
                    </div>

                </div>
            </div>

            <h5>Parts Used</h5>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Part Name & Variant</th>
                        <th>Qty</th>
                        <th>Unit Price × Qty (₹)</th>
                        <th>
                            <button type="button" class="btn btn-sm btn-success" id="add-row">+ Add Part</button>
                        </th>
                    </tr>
                </thead>
                <tbody id="parts-table">
                    <tr>
                        <td>
                            <select name="parts[0][inventory_id]" class="form-select part-select" data-row="0" required>
                                <option value="">-- Select Part --</option>
                                @foreach ($inventories as $part)
                                    @foreach ($part->ProductVariant as $variant)
                                        <option value="{{ $variant->id }}">

                                            {{ $part->name }} - {{ $variant->size_or_type }} {{ $variant->unit }}
                                        </option>
                                    @endforeach
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="number" name="parts[0][qty]" class="form-control qty-input" data-row="0"
                                min="1" required>
                        </td>
                        <td>
                            <input type="number" name="parts[0][price]" class="form-control price-input" readonly>
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-danger remove-row" disabled>x</button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="mt-3 text-end">
                <label class="fw-bold">Grand Total (₹):</label>
                <input type="number" id="grand-total" name="grand_total"
                class="form-control d-inline-block w-auto text-end fw-bold" value="0" readonly>
            </div>

            <div class="mt-4 text-end">
                <button type="submit" class="btn btn-primary">Generate Bill</button>
            </div>
        </form>
    </div>
@endsection

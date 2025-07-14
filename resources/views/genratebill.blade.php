@extends('layout.app')
@section('main')
    <div class="container">
        <div class="text-center">
            <h2> Generate Bill</h2>
            <h5> Ignis It Solution Pvt. Ltd.</h5>
        </div>
        <hr />
        <div class="text-start pt-4">
            <p> Address: 1234 Street, City, State, Zip
                <span> Phone: (123) 456-7890 , Email : ignis@ignis.com </span>
            </p>
            <p> Date: {{ date('Y-m-d') }}</p>
        </div>
        <div class="d-flex justify-content-start  gap-4">
            <p class="border  p-1 "> Booking Order No :{{ $booking->booking_id }} </p>
            <p class="border  p-1 "> Repair Date and Time: {{ $booking->updated_at }} </p>
            <p class="border p-1"> Billing Executive Name : {{ Auth::user()->name }} </p>

        </div>
        <hr />
        <div class="text-start pt-4">
            <div class="d-flex justify-content-start gap-5">
                <div class="text-start">
                    <h5>Customer Details</h5>
                    <p> Name: {{ $booking->customerName }}</p>
                    <p> Phone: {{ $booking->phone }}</p>
                    <p> Email: {{ $booking->email }}</p>
                    <p> Address: {{ $booking->address }}</p>
                </div>
                <div>
                    <h5>Vehicle Details</h5>
                    <p> Vehicle No: {{ $booking->bikenumber }}</p>
                    <p> Vehicle Model: {{ $booking->bikeModel }}</p>
                    <p> Vehicle Type: {{ $booking->bikeType }}</p>

                </div>

            </div>
        </div>
        <hr />
 <div class="container mt-5">
    <h4>Existing Operation Parts</h4>
    @if($operationParts->isEmpty())
        <p>No operation parts added yet.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product Variant</th>
                    <th>Quantity</th>
                    <th>Price </th>
                    <th>Taxable  </th>
                    <th>SGST</th>
                    <th>Rate</th>
                    <th>CGST</th>
                    <th>Rate</th>
                    <th>MRP  </th>
                </tr>
            </thead>
            <tbody>
                @php

                @endphp
                @foreach($operationParts as $part)

                    <tr>
                        <td>
                            {{ $part->productVariant->product->name }} —
                            {{ $part->productVariant->size_or_type }} {{ $part->productVariant->unit }}
                        </td>
                        <td>{{ $part->quantity }}</td>
                        <td>₹{{ $part->price }}</td>
                        <td>₹{{$part->taxable}}</td>

                        <td>{{ $part->productVariant->SGST }} %  </td>
                        <td>₹{{  ($part->productVariant->SGST * $part->taxable) / 100 }}</td>
                        <td>{{ $part->productVariant->CGST }} %</td>
                        <td>₹{{  ($part->productVariant->CGST * $part->taxable) / 100 }}</td>
                        <td>₹{{  $part->MRP   }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="8" class="text-end"><strong>Total:</strong></td>
                    <td>₹{{ $operationParts->sum('MRP') }}</td>
            </tbody>
        </table>
    @endif
</div>
        {{-- Add Addition charech like service Charge and Laber charge  Add  --}}
        <div class=" row">
            <div class = " d-flex justify-content-end">
                <form action="{{route('genratebill.store') }}" method="POST" class="pb-2 d-inline">
                    @csrf
                    <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                    <div class="d-flex gap-3">
                        <div>
                              <label for="service">Service Type: </label>
                            <p>    {{ $booking->service }}  </p>
                        </div>
                        <div>
                            <label for="serviceCharge">Service Charge: </label>
                            <input type="number" name="serviceCharge" @if ($booking->service=="Basic Service")
                             value="200" min="200" @elseif ($booking->service=="Standard Service")
                             value="500" min="500"
                             @else
                             value =""
                            @endif id="serviceCharge" class="form-control"
                                placeholder="Enter Service Charge" required>
                        </div>
                        <div>
                            <label for="laberCharge">Laber Charge:</label>

                            <input type="number" name="laberCharge" id="laberCharge" class="form-control"
                                placeholder="Enter Laber Charge" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-lable" for="payment_method"> Payment Method  </label>
                              <select name="payment_method" class="form-control" id="payment_method">
                                <option selected disabled value=""> - Select Payment Method - </option>
                                <option value="CASH"> CASH </option>
                                <option value="UPI"> UPI </option>
                                <option value="NETBANKING"> NETBANKING </option>
                                <option value="CARD"> CARD </option>
                              </select>
                        </div>

                    </div>

                    <button type="submit  " class="btn mt-3 mb-3 btn-success">Generate Bill</button>
                </form>
            </div>
        </div>

    </div>
@endsection


@extends('layout.app')
@section('main')

<div class="container pt-4">
    <h3 style="color:darkgreen; font-weight:bold">🧾 Add Parts to Bill</h3>
    <p>For Vehicle: <strong>{{ $booking->bikenumber }}</strong> (Service: {{ $booking->service }})</p>

    {{-- Success & error alerts --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{route('booking.additionalOpretionParts.store')}}" method="POST" id="billForm">
        @csrf

        <input type="hidden" name="booking_id" value="{{ $booking->id }}">

        <div id="itemRows">
            <div class="row g-3 mb-2 itemRow">
                {{-- Product Variant --}}
                <div class="col-md-6">
                    <label class="form-label">Product Variant</label>
                    <select name="items[0][variant_id]" class="form-select" required>
                        <option value="">-- Select Product Variant --</option>
                        @foreach ($technicianParts as $technicianPart)

                        @if ($technicianPart->quantity <= 0)
                            <option value="" disabled>
                                {{ $technicianPart->productVariant->product->name }} —
                                {{ $technicianPart->productVariant->size_or_type }}
                                {{ $technicianPart->productVariant->unit }} —
                                Out of Stock
                            </option>

                        @else

                              <option value="{{ $technicianPart->id }}">
                                    {{ $technicianPart->productVariant->product->name }} —
                                    {{ $technicianPart->productVariant->size_or_type }}
                                    {{ $technicianPart->productVariant->unit }} —
                                   Unit Technician Assing   {{ $technicianPart->quantity }}
                                  Per Unit Price   (₹{{ $technicianPart->price }})

                                </option>
                        @endif
                        @endforeach
                    </select>
                </div>

                {{-- Quantity --}}
                <div class="col-md-3">
                    <label class="form-label">Quantity</label>
                    <input type="number" name="items[0][quantity]" class="form-control" placeholder="Qty" min="1" max="{{ $technicianPart->quantity}}" required>
                </div>

                {{-- Remove button --}}
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" class="btn btn-danger btn-sm removeRow">Remove</button>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <button type="button" class="btn btn-secondary" id="addMore"><i class="fa-solid fa-plus" style="color: #f7f7f8;"></i>    </button>
        </div>

        <div>
            <button type="submit" class="btn btn-primary">Add to Bill</button>
        </div>
    </form>
</div>
 {{-- old opretion part list  --}}

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
                    <th>Rate </th>
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
                    $totalwithGST = 0;
                @endphp
                @foreach($operationParts as $part)
                    @php
                        $total = $part->total + ($part->total * $part->productVariant->SGST) / 100 + ($part->total * $part->productVariant->CGST) / 100;
                        $totalwithGST += $total;
                    @endphp
                    <tr>
                        <td>
                            {{ $part->productVariant->product->name }} —
                            {{ $part->productVariant->size_or_type }} {{ $part->productVariant->unit }}
                        </td>
                        <td>{{ $part->quantity }}</td>
                        <td>₹{{ $part->price }}</td>
                        <td>₹{{ $part->total}}</td>

                        <td>{{ $part->productVariant->SGST }} %</td>
                        <td>₹{{  ($part->productVariant->SGST * $part->total) / 100 }}</td>
                        <td>{{ $part->productVariant->CGST }} %</td>
                        <td>₹{{  ($part->productVariant->CGST * $part->total) / 100 }}</td>
                        <td>₹{{  $total  }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="8" class="text-end"><strong>Total:</strong></td>
                    <td>₹{{ $totalwithGST }}</td>
            </tbody>
        </table>
    @endif
</div>

<script>
let rowIndex = 1;

document.getElementById('addMore').addEventListener('click', function () {
    const itemRows = document.getElementById('itemRows');
    const firstRow = itemRows.querySelector('.itemRow');
    const newRow = firstRow.cloneNode(true);

    // clear inputs
    newRow.querySelectorAll('select, input').forEach(el => {
        if (el.tagName === 'SELECT') el.selectedIndex = 0;
        if (el.tagName === 'INPUT') el.value = '';
    });

    // fix name attributes
    newRow.querySelectorAll('select, input').forEach(el => {
        el.name = el.name.replace(/\d+/, rowIndex);
    });

    itemRows.appendChild(newRow);
    rowIndex++;
});

document.addEventListener('click', function(e) {
    if (e.target.classList.contains('removeRow')) {
        const rows = document.querySelectorAll('.itemRow');
        if (rows.length > 1) {
            e.target.closest('.itemRow').remove();
        }
    }
});
</script>

@endsection

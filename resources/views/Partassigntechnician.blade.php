@extends('layout.app')
@section('main')


<div class="container pt-4">


    {{-- Success & error alerts --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('partassignaechnician.store')}}" method="POST" id="billForm">
        @csrf


        <div id="itemRows">
            <div class="row g-3 mb-2 itemRow">
                {{-- Product Variant --}}
                <div class="col-md-3">
                    <label class="form-label">Product Variant</label>
                    <select name="items[0][variant_id]" class="form-select" required>
                        <option value="">-- Select Product Variant --</option>
                        @foreach ($inventories as $product)
                            @foreach ($product->ProductVariant as $variant)
                                <option value="{{ $variant->id }}">
                                    {{ $product->name }} — {{ $variant->size_or_type }} {{ $variant->unit }} — ₹{{ $variant->unit_price }} — Stock: {{ $variant->quantity_in_stock }}
                                </option>
                            @endforeach
                        @endforeach
                    </select>
                </div>
                {{--  --}}
                  <div class="col-md-3">
                    <label class="form-label"> Technician Select </label>
                    <select name="items[0][technician_id]" class="form-select" required>
                        <option value="">-- Select Technician--</option>
                        @foreach ($technicians as $technician)

                            <option value="{{ $technician->id }}">
                                {{ $technician->name }}
                            </option>

                        @endforeach
                    </select>
                </div>


                {{-- Quantity --}}
                <div class="col-md-3">
                    <label class="form-label">Quantity</label>
                    <input type="number" name="items[0][quantity]" class="form-control" placeholder="Qty" min="1" required>
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

 {{-- <div class="container mt-5">
    <h4>Existing Operation Parts</h4>
    @if($operationParts->isEmpty())
        <p>No operation parts added yet.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product Variant</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($operationParts as $part)

                    <tr>
                        <td>
                            {{ $part->productVariant->product->name }} —
                            {{ $part->productVariant->size_or_type }} {{ $part->productVariant->unit }}
                        </td>
                        <td>{{ $part->quantity }}</td>
                        <td>₹{{ $part->price }}</td>
                        <td>₹{{ $part->total}}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3" class="text-end"><strong>Total:</strong></td>
                    <td>₹{{ $operationParts->sum('total')  }}</td>
            </tbody>
        </table>
    @endif
</div> --}}

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



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #000;
        }

        .header {
            text-align: right;
            font-size: 24px;
            font-style: italic;
        }

        .hr {
            border-top: 1px solid #000;
            margin: 10px 0;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            border: 1px solid #000;
            padding: 4px;
            text-align: center;
        }

        .table th {
            background-color: #f0f0f0;
        }

        .no-border td {
            border: none;
            padding: 2px;
        }

        .text-end {
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="header"><em>IIS</em></div>
    <div class="hr"></div>

    <table class="no-border" width="98%">
        <tr>
            <td><b>Invoice No:</b> {{ $booking->id }}</td>
            <td style="text-align:center;"><b>Service Labour Invoice</b></td>
            <td style="text-align:right;"><b>Invoice Date:</b> {{$booking->bills->created_at  }}</td>
        </tr>
    </table>

    <div class="hr"></div>

    <table class="no-border" width="100%">
        <tr>
            <td width="50%">
                <b>Ignis IT Solutions</b><br>
                406, 410, The Mark, 20/A,<br>
                Anand Bazar Rd, Ashirwad SBI Colony,<br>
                Old Palasia, Indore,<br>
                Madhya Pradesh 452001<br>
                GST: 232323XXXXXXX<br>
                BillType: {{ $booking['bills']->payment_method ?? 'NaN' }}
            </td>
            <td width="50%" style="text-align: end;">
                {{ $booking->customerName }}<br>
                {{ $booking->address }}<br>
                Mobile: {{ $booking->phone }}<br>
                Email: {{ $booking->email }}
            </td>
        </tr>
    </table>

    <div class="hr"></div>

    <table class="no-border" width="100%">
        <tr>
            <td width="33%">JC NO: Na</td>
            <td width="33%">Service: {{ $booking->service }}</td>
            <td width="33%">Technician: {{ $booking->technician->name }}</td>
        </tr>
        <tr>
            <td>KMs: xxxx</td>
            <td>Model: {{ $booking->bikeModel }}, {{ $booking->bikeBrand }}, {{ $booking->bikeType }}</td>
            <td>RegNo.: {{ $booking->bikenumber }}</td>
        </tr>
    </table>

    <br>

    <table class="table">
        <thead>
            <tr>
                <th>S No.</th>

                <th>Particulars</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Taxable</th>
                <th>SGST</th>
                <th>Rate</th>
                <th>CGST</th>
                <th>Rate</th>
                <th>MRP</th>
            </tr>
        </thead>
        <tbody>
            @php $sno = 1; @endphp
            @foreach ($booking->opretionPart as $part)
                <tr>
                    <td>{{ $sno++ }}</td>

                    <td>{{ $part->productVariant->product->name }} — {{ $part->productVariant->size_or_type }}
                        {{ $part->productVariant->unit }}</td>
                    <td>{{ $part->quantity }}</td>
                    <td>&#8377;{{ $part->price }}</td>
                    <td>&#8377;{{ $part->taxable }}</td>
                    <td>{{ $part->productVariant->SGST }}%</td>
                    <td>&#8377;{{ ($part->productVariant->SGST * $part->taxable) / 100 }}</td>
                    <td>{{ $part->productVariant->CGST }}%</td>
                    <td>&#8377;{{ ($part->productVariant->CGST * $part->taxable) / 100 }}</td>
                    <td>&#8377;{{ $part->MRP }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="12"></td>
            </tr>
            <tr>
                <td colspan="9" class="text-end"><strong>Total Amount Parts:</strong></td>
                <td>&#8377;{{ $booking->opretionPart->sum('MRP') }}</td>
            </tr>
            <tr>
                <td colspan="9" class="text-end"><strong>Total Amount Labour:</strong></td>
                <td>&#8377;{{ $booking->bills->laber_charge }}</td>
            </tr>
            <tr>
                <td colspan="9" class="text-end"><strong>Total Amount Service:</strong></td>
                <td>&#8377;{{ $booking->bills->service_charge }}</td>
            </tr>
            <tr>
                <td colspan="9" class="text-end"><strong>Net Payable Amount:</strong></td>
                <td>&#8377;{{ $booking->bills->total_amount }}</td>
            </tr>

            <tr>
                    <td colspan="10" class="text-end">
    <strong>Amount in Words:</strong>
    {{ amount_in_words($booking->bills->total_amount) }}
</td>

            </tr>
        </tbody>
    </table>
    <table width="100%" style="margin-top: 80px;">
        <tr>
            <td width="50%" style="text-align: center;">
                <div style="border-top: 1px solid #000; width: 30%; margin: 0 auto; padding-top: 5px;">
                    Authorized Signatory - Sign & Date
                </div>
            </td>
            <td width="50%" style="text-align: center;">
                <div style="border-top: 1px solid #000; width: 30%; margin: 0 auto; padding-top: 5px;">
                    Customer Sign & Date
                </div>
            </td>
        </tr>
    </table>

 <form action="{{ route('billinvoice.download',$booking->id) }}" class="text-end" method="post">
    @csrf
        <button class="btn btn-primary p-2 m-1 " > Download Now </button>
 </form>


</body>

</html>

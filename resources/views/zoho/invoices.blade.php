@extends('layouts.mobile')

@section('content')
<div class="container">
    <h2>Zoho Invoices</h2>

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <table class="table  table-bordered table-light">
        <thead>
            <tr>
                <th>Invoice #</th>
                <th>Customer</th>
                <th>Date</th>
                <th>Total</th>
                <th>Download</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($invoices as $invoice)
                <tr>
                    <td>{{ $invoice['invoice_number'] }}</td>
                    <td>{{ $invoice['customer_name'] }}</td>
                    <td>{{ \Carbon\Carbon::parse($invoice['date'])->format('d M Y') }}</td>
                    <td>{{ $invoice['total'] }}</td>
                    <td><a href="{{ route('zoho.invoice.download', $invoice['invoice_id']) }}" class="btn btn-sm btn-primary" target="_blank">Download PDF</a></td>
                    
                </tr>
            @empty
                <tr><td colspan="5">No invoices found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
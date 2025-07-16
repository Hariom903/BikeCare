<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;

class BillinvoiceController extends Controller
{
  public function index($id){

     $booking = Service::with('bills','opretionPart.productVariant','technician')
     ->where('id',$id)
     ->first();
    //  dd($booking);
     $pdf= pdf::loadView('billinvoice',compact('booking'));
     $pdfFileName = 'invoice' . $booking->id . '.pdf';
//     $filePath = storage_path('invoices/' . $pdfFileName); // Replace with your desired path

// // Save the PDF to the server
//     $pdf->save($filePath);
    return view('billinvoice',compact('booking'));

  }

public function download($id)
{
    $booking = Service::with('bills', 'opretionPart.productVariant', 'technician')
        ->where('id', $id)
        ->first();
    $pdf = PDF::loadView('billinvoice', compact('booking'));
    $invoicesPath = storage_path('invoices');
    if (!File::exists($invoicesPath)) {
        File::makeDirectory($invoicesPath, 0755, true);
    }
    $pdfFileName = 'invoice_' . $booking->id . '_' . now()->format('Ymd_His') . '.pdf';
    $filePath = $invoicesPath . '/' . $pdfFileName;
    $pdf->save($filePath);

     
    return $pdf->download($pdfFileName);
}

}

<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Barryvdh\DomPDF\Facade\Pdf;

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
    $filePath = storage_path('invoices/' . $pdfFileName); // Replace with your desired path

// Save the PDF to the server
    $pdf->save($filePath);
    return view('billinvoice',compact('booking'));

  }
}

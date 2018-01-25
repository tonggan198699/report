<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
use PDF;
use App;

class ReportController extends Controller
{
      public function index()
      {
        return view('main');
      }


      public function store(Request $request)
    {
        $this->validate($request, [
          'invoiceNo' => 'required|string',
          'date' => 'required',
          'companyName' => 'required',
          'address' => 'required',
          'city' => 'required',
          'postCode' => 'required',
          'country' => 'required',
          'description' => 'required|string|max:500',
          'unitPrice' => 'required|numeric',
          'vat' => 'required|numeric'
        ]);

        $report = Report::create([
          'invoiceNo' => $request['invoiceNo'],
          'date' => $request['date'],
          'companyName' => $request['companyName'],
          'address' => $request['address'],
          'city' => $request['city'],
          'postCode' => $request['postCode'],
          'country' => $request['country'],
          'description' => $request['description'],
          'unitPrice' => $request['unitPrice'],
          'vat' => $request['vat']
        ]);

        if ($report) {
          $report->save();
          $request->session()->flash('success', 'You have successfully created your report');
            return redirect()->route('report.show', $report);
        } else {
            return redirect()->back()->with('failure', 'Please try again!');
        }
    }

    public function show(Report $report)
    {
      $companyAddressLineOne = "11-12 Tokenhouse Yard";
      $companyAddressLineTwo = "London EC2R 7AS";
      $companyAddressLineThree = "United Kingdom";
      $companyPhone = "+44 7860 463 193";
      $companyEmail = "mstrasser@wallstreetdocs.com";
      $companyVatRegNo = "GB 993 9523 61";

      return view('report',
      compact('report', 'companyAddressLineOne','companyAddressLineTwo',
      'companyAddressLineThree','companyPhone','companyEmail','companyVatRegNo'));

    }

    public function convertToPdf(Report $report)
    {

      $companyAddressLineOne = "11-12 Tokenhouse Yard";
      $companyAddressLineTwo = "London EC2R 7AS";
      $companyAddressLineThree = "United Kingdom";
      $companyPhone = "+44 7860 463 193";
      $companyEmail = "mstrasser@wallstreetdocs.com";
      $companyVatRegNo = "GB 993 9523 61";

      $pdf = PDF::loadView('htmlReport', compact('report', 'companyAddressLineOne','companyAddressLineTwo',
      'companyAddressLineThree','companyPhone','companyEmail','companyVatRegNo'));
      return $pdf->download('report.pdf');

    }

}

<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;

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
            return redirect('/report');;
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

    public function saveAsWordDocx()
    {

      $report = Report::all();

      $word = new \PhpOffice\PhpWord\PhpWord();

      $newSection = $word->addSection();

      $invoceNo = $report->invoiceNo;
      $date = $report->date;
      $companyAddressLineOne = "11-12 Tokenhouse Yard";
      $companyAddressLineTwo = "London EC2R 7AS";
      $companyAddressLineThree = "United Kingdom";
      $companyPhone = "+44 7860 463 193";
      $companyEmail = "mstrasser@wallstreetdocs.com";
      $companyVatRegNo = "GB 993 9523 61";
      $companyName = $report->companyName;
      $address = $report->address;
      $city = $report->city;
      $postCode = $report->postCode;
      $country = $report->country;
      $id = $report->id;
      $description = $report->description;
      $unitPrice = $report->unitPrice;
      $vat = $report->vat;
      $getVatPrice = $report->getVatPrice();
      $getTotalPrice = $report->getTotalPrice();

      $html = (
        `
      <div class="myForm">
        <h1>Invoice</h1>
          <div class="row">
              <div class="col-md-3 pull-left">
                <table class="table table-sm table-bordered">
                  <thead>
                    <tr>
                      <th>Invoice No.</th>
                      <th>Date</th>
                      <th>Page</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr>
                      <td>${invoiceNo}</td>
                      <td>${date}</td>
                      <td>1 of 1</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="col-md-3 pull-right">
                  <p>${companyAddressLineOne}</p>
                  <p>${companyAddressLineTwo}</p>
                  <p>${companyAddressLineThree}</p>
                  <p>Phone: ${companyPhone}</p>
                  <p>Email: ${companyEmail}</p>
                  <p>VAT Reg. Number: ${$companyVatRegNo}</p>
              </div>
          </div>

          <div class="row">
              <div class="col-md-4 pull-left">
                <table class="table table-sm table-bordered">
                  <thead>
                    <tr>
                      <th>Bill to:</th>
                    </tr>
                  </thead>

                  <tbody>
                      <td>
                        <p>${companyName}</p>
                        <p>${address}</p>
                        <p>${city}</p>
                        <p>${postCode}</p>
                        <p>${country}</p>
                      </td>
                  </tbody>
                </table>
              </div>

              <div class="col-md-4 pull-right">
                <table class="table table-sm table-bordered">
                  <thead>
                    <tr>
                      <th>Purchase Order No.</th>
                      <th>Terms</th>
                    </tr>
                  </thead>

                  <tbody>
                      <td></td>
                      <td>Payment Within 30 Days</td>
                  </tbody>
                </table>
              </div>
          </div>

          <div class="row">
              <div class="col-md-8 pull-left">
                <table class="table table-sm table-bordered">
                  <thead>
                    <tr>
                      <th>Quantity</th>
                      <th>Description</th>
                      <th>Unit Price</th>
                      <th>Line Total</th>
                      <th>VAT</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr>
                      <td>${id}}</td>
                      <td>${description}</td>
                      <td>£ ${unitPrice}.00</td>
                      <td>£100.00</td>
                      <td>${vat}%</td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td>
                        <p>Subtotal: £ ${unitPrice}.00</p>
                        <p>VAT Total: £ ${getVatPrice}.00</p>
                        <p>Total: £ ${getTotalPrice}.00</p>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
          </div>
      </div>
      `);

      \PhpOffice\PhpWord\Shared\Html::addHtml($newSection, $html);

      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment;filename="report.docx"');

      $objectWriter = \PhpOffice\PhpWord\IOFactory::createWriter($word, 'Word2007');

      try{
        $objectWriter->save(storage_path('report.docx'));
      } catch (Exception $e) {
      }

      return response()->download(storage_path('report.docx'));

      }

}

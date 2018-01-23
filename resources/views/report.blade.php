@extends('app')

  @section('content')

  @if(session()->has('success'))
  <div class="alert alert-success">
      {{ session()->get('success') }}
  </div>
  @endif

  @if(session()->has('failure'))
  <div class="alert alert-danger">
      {{ session()->get('failure') }}
  </div>
  @endif

@if($report)
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
                <td>{{$report->invoiceNo}}</td>
                <td>{{$report->date}}</td>
                <td>1 of 1</td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="col-md-3 pull-right">
            <p>{{$companyAddressLineOne}}</p>
            <p>{{$companyAddressLineTwo}}</p>
            <p>{{$companyAddressLineThree}}</p>
            <p>Phone: {{$companyPhone}}</p>
            <p>Email: {{$companyEmail}}</p>
            <p>VAT Reg. Number: {{$companyVatRegNo}}</p>
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
                  <p>{{$report->companyName}}</p>
                  <p>{{$report->address}}</p>
                  <p>{{$report->city}}</p>
                  <p>{{$report->postCode}}</p>
                  <p>{{$report->country}}</p>
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
                <td>{{$report->id}}</td>
                <td>{{$report->description}}</td>
                <td>£{{$report->unitPrice}}.00</td>
                <td>£100.00</td>
                <td>{{$report->vat}}%</td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td>
                  <p>Subtotal: £{{$report->unitPrice}}.00</p>
                  <p>VAT Total: £{{$report->getVatPrice()}}.00</p>
                  <p>Total: £{{$report->getTotalPrice()}}.00</p>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
    </div>
</div>

<form id="docxform" action="/createWord">
    <input type="hidden" id="htmlstring" name="htmlstring" value="">
    <input type="submit" id="docbutton" name="htmlstring" value="Generate doxc file">
</form>


<script>

$('#docbutton').click(function() {
  $('#htmlstring').val($('#myForm').html());
});

</script>

@endif

  @endsection

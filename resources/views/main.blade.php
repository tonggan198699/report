@extends('app')

  @section('content')

  <h1>Report Generator Template</h1>

  <h3>Please enter the following information in order to generate a report</h3>
    <form method="post" action="/save">
    {{ csrf_field() }}
      <div class="row">
          <div class="col-md-3">
              <div class="form-group">
                  <label for="invoiceNo">Invoice Number</label>
                  <input type="text" name="invoiceNo" class="form-control" placeholder="Please enter your invoice no">
              </div>
          </div>

          <div class="col-md-3">
              <div class="form-group">
                    <label for="date">Date</label>
                    <input type="text" name="date" class="form-control" placeholder="dd/mm/yyyy">
              </div>
          </div>

          <div class="col-md-4">
              <div class="form-group">
                    <label for="companyName">Company Name</label>
                    <input type="text" name="companyName" class="form-control" placeholder="Please enter the company name">
              </div>
          </div>
      </div>

  <h3>Bill to the following address:</h3>

      <div class="row">
          <div class="col-md-6">
              <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" class="form-control" placeholder="Please enter the address line">
              </div>
          </div>

          <div class="col-md-3">
              <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" name="city" class="form-control" placeholder="Please enter the city">
              </div>
          </div>
      </div>

      <div class="row">
          <div class="col-md-3">
              <div class="form-group">
                    <label for="postCode">Post Code</label>
                    <input type="text" name="postCode" class="form-control" placeholder="Please enter the post code">
              </div>
          </div>

          <div class="col-md-3">
              <div class="form-group">
                    <label for="country">Country</label>
                    <input type="text" name="country" class="form-control" placeholder="Please enter the post code">
              </div>
          </div>
      </div>

      <div class="row">
          <div class="col-md-8">
              <div class="form-group">
                    <label for="country">Invoice Description</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
              </div>
          </div>
      </div>

      <div class="row">
          <div class="col-md-3">
              <div class="form-group">
                    <label for="country">Unit Price in £</label>
                    <input name="unitPrice" class="form-control" placeholder="Please enter the unit price">
              </div>
          </div>

          <div class="col-md-3">
              <div class="form-group">
                    <label for="country">VAT in %</label>
                    <input name="vat" class="form-control" placeholder="Please enter the VAT ">
              </div>
          </div>
      </div>

      <button type="submit" class="btn btn-primary pull-right">Submit</button>

    </form>


  @endsection

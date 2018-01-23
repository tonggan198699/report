<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class report extends Model
{

  protected $guarded = [];

  protected $fillable = [
    'invoiceNo',
    'date',
    'companyName',
    'address',
    'city',
    'postCode',
    'country',
    'description',
    'unitPrice',
    'vat',
  ];

  public function getVatPrice()
  {
    return $this->unitPrice * 0.2;
  }

  public function getTotalPrice()
  {
    return $this->getVatPrice() + $this->unitPrice;
  }



}

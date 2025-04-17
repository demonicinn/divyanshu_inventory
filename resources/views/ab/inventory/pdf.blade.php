<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}

.center {
    text-align: center;
}
.right {
    text-align: right;
}
.brn {
    border-right: 1px solid #fff;
}
.bbn {
    border-bottom: 1px solid #fff;
}
.bn {
    border: none;
}
.bold {
    font-weight: 700;
}
</style>
</head>
<body>


@php
    $store = $stock->store;

@endphp



<table style="width:100%">
  <tr>
    <th colspan="4" style="font-size: 30px;">{{ $store->name }}</th>
  </tr>
  <tr>
    <td colspan="4" class="">{!! $store->address !!}</td>
  </tr>
  <tr>
    <td colspan="4" class="">Contact Number : {{ $store->number }}</td>
  </tr>
  <tr>
    <td colspan="4" class="center bold">GATE PASS</td>
  </tr>
  <tr>
    <td colspan="2" class="center">Truck Number: {{ $stock->vehicle_number }}</td>
    <td colspan="2" class="center">Date: {{ $stock->issue_date }} - {{ date('h:ia', strtotime($stock->issue_time)) }}</td>
  </tr>

  <tr>
    <td class="center bold">#</td>
    <td class="center bold">Product</td>
    <td class="center bold">Units</td>
    <td class="center bold">Kg</td>
  </tr>

  @foreach($stock->stockProducts as $i => $product)
  <tr>
    <td class="center">{{ $i + 1 }}</td>
    <td class="center">{{ $product->product->name }}</td>
    <td class="center">{{ $product->units }}</td>
    <td class="center">{{ $product->kg }}</td>
  </tr>
  @endforeach
  
  


</table>
</body>
</html>


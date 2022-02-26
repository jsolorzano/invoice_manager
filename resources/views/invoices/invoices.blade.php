<!DOCTYPE html>
<html lang="es">
 <head>
  <title>Invoice</title>
  <style>
  table,th,td {
    border: 1px solid black;
    text-align: left;
  }
  </style>
 </head>
 <body>
	 
  <input type="button" value="Imprimir" class="printbutton" align="right">
	 
  @foreach($invoices as $invoice)
  <h1>Invoice {{$invoice->id}}</h1>
  <table width="100%">
   <tr>
    <th colspan="2"><h2>Client</h2></th>
    <th colspan="2"><h2>{{$invoice->client}}</h2></th>
   </tr>
   <tr>
    <th><h3>Product</h3></th>
    <th><h3>Price</h3></th>
    <th><h3>Tax</h3></th>
    <th><h3>Total</h3></th>
   </tr>
   
   @php
   $sub_total = 0;
   $total_tax = 0;
   $total = 0;
   @endphp
   
   @foreach($invoice->invoice_purchases as $invoice_purchase)
   <tr>
    <td>{{$invoice_purchase->purchase->product->name}}</td>
    <td>{{$invoice_purchase->purchase->product->price}}</td>
    <td>{{$invoice_purchase->purchase->quantity}}</td>
    <td>{{$invoice_purchase->purchase->product->price * $invoice_purchase->purchase->quantity}}</td>
    
    @php($sub_t = $invoice_purchase->purchase->product->price * $invoice_purchase->purchase->quantity)
    @php($sub_total += $sub_t)
    @php($total_tax += ($sub_t * $invoice_purchase->purchase->product->tax / 100))
    
   </tr>
   @endforeach
   <tr>
    <td colspan="3">Subtotal</td>
	<td>{{number_format($sub_total, 2)}}</td>
   </tr> 
   <tr>
    <td colspan="3">Total tax</td>
	<td>{{number_format($total_tax, 2)}}</td>
   </tr> 
   <tr>
    <td colspan="3">Total price</td>
    @php($total = $sub_total + $total_tax)
	<td>{{number_format($total, 2)}}</td>
   </tr> 
  </table>
  <br>
  <hr>
  @endforeach
  
 <script>
	document.querySelectorAll('.printbutton').forEach(function(element) {
		element.addEventListener('click', function() {
			this.style.display = 'none';  // Hide button before printing  
			print();
		});
	});
 </script>
 </body>
</html>

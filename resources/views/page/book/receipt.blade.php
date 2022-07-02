@extends('layout.main')

@section('header_Page', 'Field List')

@section('content')

<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="SB-Mid-client-5YdtWeygbL5-ZWKb"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
  </head>
 
  <body>

    <style>
        .custom-card{
            max-width: 650px;
            margin: auto
        }
    </style>

    <div class="container">

      
      <div class="custom-card bg-white shadow-lg p-4">
          <div>
              <h1 class="text-center fw-bold">RECEIPT</h1>
              <h5 class="text-center mb-2">Booking ID</h5>
              <h5 class="text-center">FIT-{{$order->id}}</h5>
          </div>
          <hr>
          <div class="d-flex mb-2">
            <div style="width: 100px;">Field Name </div>
            <div>: {{$field->name}}</div>
        </div>
            <div class="d-flex mb-2">
                <div style="width: 100px;">Location </div>
                <div>: {{$field->address}}</div>
            </div>
            <div class="d-flex mb-2">
                <div style="width: 100px;">Date  </div>
                <div>: {{$date}}</div>
            </div>
            <div class="d-flex mb-4">
                <div style="width: 100px;">Duration </div> 
                <div>: {{count($order_list)}} Hours</div>
            </div>
    
            <div class="mb-3">Receipt Detail</div>
            <table class="table table-bordered mb-3">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Start Time</th>
                        <th scope="col">Duration</th>
                        <th scope="col">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order_list as $item)
                        <tr>
                            <td>{{$item->fieldTypes->name}}</td>
                            <td>{{$item->time}}</td>
                            <td>1 hours</td>
                            <td>Rp. {{$item->price}}</td>
                        </tr>
                    @endforeach
                    <tr>
                </tbody>
              </table>
              <div class="mb-3">Total Price : Rp.{{$order->total_price}}</div>
              {{-- @if($order->payment_status == 1)
                <div class="mb-3">*Note : If Status in pop up payment Say "Payment Success", click cancel button</div>
              @endif --}}
              {{-- <div class="d-grid gap-2"> --}}
                {{-- {{dd(json_decode($order->json_result, true))}} --}}
                @php
                  if($order->json_result != null){
                    $json_pay = json_decode($order->json_result, true);
                  }
                  // dd($json_pay["transaction_status"]);
                @endphp
              <div class="text-center">
                  {{-- @if($order->json_result != null && $json_pay["transaction_status"] == "settlement") --}}
                  @if($order->payment_status == 2)
                    <h3 class="text-success text-center">Payment Success</h3>
                  @else
                  <button class="btn btn-success fw-bold fs-5 ps-4 pe-4" id="pay-button">
                        @if ($order->json_result == null)
                          PAY NOW 
                        @else
                          CHECK PAYMENT
                        @endif
                      </button>
                  @endif
              </div>

              <form action="/fieldsTo/send/order/{{$order->id}}" id="submit_form" method="post">
                    @csrf
                    <input type="hidden" name="status" id="status">
                    <input type="hidden" name="json" id="json_callback">
              </form>

        </div>

    </div>

 
    <script type="text/javascript">


      // var url = 'https://api.sandbox.midtrans.com/v2/{{$order->midtrans_order_id}}/status'

      // // fetch(url).then((res) => {
      // //   console.log(res);
      // // })

      // $.ajax({
      //     url: 'https://api.sandbox.midtrans.com/v2/{{$order->midtrans_order_id}}/status',
      //     beforeSend: function(xhr) {
      //       xhr.setRequestHeader("Accept", "application/json")
      //       xhr.setRequestHeader("Content-Type", "application/json")
      //       xhr.setRequestHeader("Authorization", "Basic U0ItTWlkLXNlcnZlci1UT3ExYTJBVnVpeWhoT2p2ZnMzVV7LZU87")
      //     }, success: function(data){
      //         alert(data);
      //         console.log("data ", data);
      //         //process the JSON data etc
      //     }
      // })


      // For example trigger on button clicked, or any time you need
      var payButton = document.getElementById('pay-button');
      payButton.addEventListener('click', function () {
        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
        
        // customer will be redirected after completing payment pop-up
        window.snap.pay('{{$order->snap_token}}', {
          onSuccess: function(result){
            /* You may add your own implementation here */
            console.log(result.status_message[0]);
            if(result.status_message[0] == "transaction has been succeed"){
              document.getElementById('status').value = 2
            }
            // alert("payment success!");
            sendresponse(result)
          },
          onPending: function(result){
            /* You may add your own implementation here */
            console.log(result.status_message[0]);
            if(result.status_message[0] == "transaction has been succeed"){
              document.getElementById('status').value = 2
            }
            // alert("wating your payment!");
            sendresponse(result)
          },
          onError: function(result){
            /* You may add your own implementation here */
            console.log(result.status_message[0]);
            if(result.status_message[0] == "transaction has been succeed"){
              document.getElementById('status').value = 2
            }
            sendresponse(result)
            console.log(result);
            // alert("payment failed!");
            // sendresponse(result)
          },
          onClose: function(){
            /* You may add your own implementation here */
            // console.log(result.status_message[0]);
            // if(result.status_message[0] == "transaction has been succeed"){
            //   document.getElementById('status').value = 2
            // }
            // sendresponse(result)
            // console.log(result);
            // alert('you closed the popup without finishing the payment');
          }
        })
      });

      function sendresponse(result){
        document.getElementById('json_callback').value = JSON.stringify(result)
        $('#submit_form').submit();
      }
    </script>
  </body>
</html>

@endsection
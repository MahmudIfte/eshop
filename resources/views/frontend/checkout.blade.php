@extends('layouts.front')
@section('title')
    Check-Out
@endsection
@section('content')
    <div class="container mt-5">
        <form action="{{ url('/place-order') }}" method="POST" enctype="multipart/form">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            Basic details
                            <hr>
                            <div class="row checkout-form">
                                <div class="col-md-6">
                                    <label for="">First Name</label>
                                    <input type="text" class="form-control firstname" name="fname" placeholder="First Name"
                                        value="{{ Auth::user()->name }}">
                                    <span id="fname_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Last Name</label>
                                    <input type="text" class="form-control lastname" name="lname" placeholder="Last Name"
                                        value="{{ Auth::user()->lname }}">
                                    <span id="lname_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Email</label>
                                    <input type="text" class="form-control email" name="email" placeholder="Email"
                                        value="{{ Auth::user()->email }}">
                                    <span id="email_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Phone number</label>
                                    <input type="text" class="form-control phone" name="phone" placeholder="Phone number"
                                        value="{{ Auth::user()->phone }}">
                                    <span id="phone_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Address -1</label>
                                    <input type="text" class="form-control address1" name="address1" placeholder="Address"
                                        value="{{ Auth::user()->address1 }}">
                                    <span id="address1_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Address -2</label>
                                    <input type="text" class="form-control address2" name="address2" placeholder="Address"
                                        value="{{ Auth::user()->address2 }}">
                                    <span id="address2_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">City</label>
                                    <input type="text" class="form-control city" name="city" placeholder="City"
                                        value="{{ Auth::user()->city }}">
                                    <span id="city_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">State</label>
                                    <input type="text" class="form-control state" name="state" placeholder="State"
                                        value="{{ Auth::user()->state }}">
                                    <span id="state_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Country</label>
                                    <input type="text" class="form-control country" name="country" placeholder="Country"
                                        value="{{ Auth::user()->country }}">
                                    <span id="country_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Pin code</label>
                                    <input type="text" class="form-control pincode" name="pincode" placeholder="Pin code"
                                        value="{{ Auth::user()->pincode }}">
                                    <span id="pincode_error" class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <h3>Order Details</h3>
                            <hr>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Qty</th>
                                        <th>Per Price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartItems as $item)
                                        <tr>
                                            <td>{{ $item->products->name }}</td>
                                            <td>{{ $item->prod_qty }}</td>
                                            <td>{{ $item->products->selling_price }}</td>
                                            <td>{{ $item->products->selling_price * $item->prod_qty }}</td>
                                            {{-- <td>{{ $item->prod_qty*$item->products->selling_price }}</td> --}}
                                            {{-- <td>{{ $item->total_price }}</td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- <h4 class="px-2">Grand Total:{{ $item->products->selling_price*$item->prod_qty }}</h4> --}}
                            <hr>
                            <input type="hidden" name="payment_mode" value="COD">
                            <button type="submit" class="btn btn-primary  w-100 mt-3">Place order |COD</button>
                            <button type="button" class="btn btn-danger w-100 mt-3 razorpay_btn">Pay with razorpay</button>
                            <div id="paypal-button-container"></div>
                        </div>
                    </div>
                </div>
        </form>
    </div>
@endsection



@section('scripts')
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script
        src="https://www.paypal.com/sdk/js?client-id=Ac4cBaSCCbCOPnirJI08xQ7XTb7dI3qn_2QyHkAYOWbXRozbjeLpqRwGq3Cda3eMKSwSBy9wiknksOnp">
    </script>

    <script>
        paypal.Buttons({

            // Sets up the transaction when a payment button is clicked
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '{{ $item->products->selling_price * $item->prod_qty }}'
                        }
                    }]
                });
            },


            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {

                    // alert('Transaction completed by' + details.payer.name.given_name);

                    var firstname = $(".firstname").val();
                    var lastname = $(".lastname").val();
                    var email = $(".email").val();
                    var phone = $(".phone").val();
                    var city = $(".city").val();
                    var country = $(".country").val();
                    var state = $(".state").val();
                    var pincode = $(".pincode").val();
                    var address1 = $(".address1").val();
                    var address2 = $(".address2").val();
                    $.ajax({
                        method: "POST",
                        url: "/place-order",
                        data: {
                            fname: firstname,
                            lname: lastname,
                            email: email,
                            phone: phone,
                            address1: address1,
                            address2: address2,
                            city: city,
                            state: state,
                            country: country,
                            pincode: pincode,
                            payment_mode: "paid by Paypal",
                            payment_id: details.id,
                        },
                        success: function(responseb) {
                            // alert(responseb.status);
                            swal(responseb.status);
                            window.location.href = "/my-orders";
                        },
                    });






                    //   console.log('Capture result', details, JSON.stringify(details, null, 2));
                    //   var transaction = details.purchase_units[0].payments.captures[0];
                    //   alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');


                });
            }
        }).render('#paypal-button-container');
    </script>






@endsection

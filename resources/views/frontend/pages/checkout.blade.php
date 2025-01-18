@extends('frontend.master')
@section('content')

   
    <section class="flex checkoutMain max-w-7xl  mx-auto px-10 py-20 space-x-7">

        <div class="w-3/5 checkout mb-10">
          <h1 class="text-xl mb-7">Checkout</h1>
          <div class="border p-7 rounded-md shadow-md">
            <h2 class="text-lg font-medium text-gray-900">Shipping Details</h2>

            <form id="checkoutForm" action="{{route('checkout.process')}}" method="post">
              @csrf
                <div class="gap-y-4 grid grid-cols-1 mt-2 sm:gap-x-4 sm:grid-cols-2 checkoutFormD">
                  
                  <div>
                    <label for="receiver_name" class="block text-sm font-medium text-gray-700">Name<span class="text-red-500">*</span></label>
                    <div class="mt-1">
                      <input required value="{{old('receiver_name')}}" type="text"  name="receiver_name" id="receiver_name" autocomplete="address-level2" class="block border border-gray-300 focus:outline-emerald-600 focus:ring-indigo-500 px-4 py-[10px] rounded-md shadow-sm sm:text-sm w-full"/>
                      @error('receiver_name')
                        <p class="text-red-600 mt-5">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>

                  <div>
                    <label for="receiver_phone" class="block text-sm font-medium text-gray-700">Phone<span class="text-red-500">*</span></label>
                    <div class="mt-1">
                      <input required value="{{old('receiver_phone')}}" type="text" name="receiver_phone" id="receiver_phone" autocomplete="address-level2" class="block border border-gray-300 focus:outline-emerald-600 focus:ring-indigo-500 px-4 py-[10px] rounded-md shadow-sm sm:text-sm w-full" />
                      @error('receiver_phone')
                        <p class="text-red-600 mt-5">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>

                  

                  <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email<span class="text-red-500">*</span></label>
                    <div class="mt-1">
                      <input required value="{{old('email')}}" type="text"  name="email"  id="email" autocomplete="address-level2"
                        class="block border border-gray-300 focus:outline-emerald-600 focus:ring-indigo-500 px-4 py-[10px] rounded-md shadow-sm sm:text-sm w-full"/>
                        @error('email')
                          <p class="text-red-600 mt-5">{{ $message }}</p>
                        @enderror
                      </div>
                  </div>

                  <div>
                    <label for="location" class="block text-sm font-medium text-gray-700">City Location <span class="text-red-500">*</span></label>
                    <div class="mt-1">
                      {{-- <input value="{{old('location')}}"  type="text" name="location" id="location"  autocomplete="address-level2" /> --}}
                        <select
                        class="form-select appearance-none
                            block
                            w-full
                            px-3
                            py-1.5
                            text-base
                            font-normal
                            text-gray-700
                            bg-white bg-clip-padding bg-no-repeat
                            border border-solid border-gray-300
                            rounded
                            transition
                            ease-in-out
                            m-0
                            focus:text-gray-700 focus:bg-white focus:outline-none"
                        name="location" id="location_select" required>
                        <option selected disabled >Select Location</option>
                        @foreach($shipping_charge as $data)
                        <option value="{{$data->slug}}" deliveryCharge="{{$data->amount}}">{{$data->location}}  [BDT. {{$data->amount}}]</option>
                        
                        @endforeach
                    </select>
                        @error('location')
                          <p class="text-red-600 mt-5">{{ $message }}</p>
                        @enderror
                      </div>
                  </div>
                  
                    <div class="sm:col-span-2">
                      <label for="address" class="block text-sm font-medium text-gray-700">Address<span class="text-red-500">*</span> </label>
                      <div class="mt-1">
                        <input required value="{{old('receiver_address')}}" type="text" name="receiver_address" id="receiver_address"  autocomplete="street-address" class="block border border-gray-300 focus:outline-emerald-600 focus:ring-indigo-500 px-4 py-[10px] rounded-md shadow-sm sm:text-sm w-full"/>
                        @error('receiver_address')
                          <p class="text-red-600 mt-5">{{ $message }}</p>
                        @enderror
                      </div>
                    </div>

                   <div class="col-span-2 space-y-3">
                    <h2 class="text-lg font-medium text-gray-900">Payment Method<span class="text-red-500">*</span></h2>
                    <label class="border border-gray-200 cursor-pointer flex items-center p-2 relative rounded-md rounded-tl-md rounded-tr-md">
                        <input type="radio" name="payment_method" value="COD" class="h-7 w-7 mt-0.5 cursor-pointer text-indigo-600 border-gray-300 focus:ring-indigo-500" aria-labelledby="payment-method-0-label" aria-describedby="payment-method-0-description"
                            {{ old('payment_method') == 'COD' ? 'checked' : '' }} checked/>
                        <div class="ml-5 flex items-center justify-between w-full">
                            <span id="payment-method-0-label" class="text-gray-900 block text-base font-medium">
                                COD
                            </span>
                            <div>
                            </div>
                        </div>
                    </label>
                
                    <label class="border border-gray-200 cursor-pointer flex items-center p-2 relative rounded-md rounded-tr-md">
                        <input type="radio" name="payment_method" value="SSL" class="h-7 w-7 mt-0.5 cursor-pointer text-indigo-600 border-gray-300 focus:ring-indigo-500" aria-labelledby="payment-method-1-label" aria-describedby="payment-method-1-description"
                            {{ old('payment_method') == 'SSL' ? 'checked' : '' }} />
                        <div class="ml-5 flex items-center justify-between w-full">
                            <span id="payment-method-1-label" class="text-gray-900 block text-base font-medium">
                                Online Payment SSL
                            </span>
                            <div>
                            </div>
                        </div>
                    </label>
                </div>
                
                  
                </div>
            

          </div>

          <div class="p-5">
            <button
              class="bg-darkred-100 lg:px-4 px-3 lg:py-1 rounded text-white focus:outline-none hover:bg-darkred-50"
            >
              <span class="flex py-2 px-5"><span>Place order</span></span>
            </button>
          </div>
        </div>
        <div class="w-2/5 orderSummmery">
          <h1 class="text-xl mb-7">Order Summary</h1>
          <div class="bg-white border-2 p-7 rounded-md shadow-md">
            <div class="flex justify-between pb-3">
              <span class="capitalize text-sm font-medium">sub total</span>
              <span class="capitalize text-sm font-light">BDT. <span id="sub_total">{{$total}}</span></span>
            </div>
            <div class="flex justify-between pb-3">
              <span class="capitalize text-sm font-medium">Total Discount</span>
              <span class="capitalize text-sm font-light">BDT. <span id="total_discount">{{$total_discount}}</span></span>
            </div>
            <div class="flex justify-between pb-3">
              <span class="capitalize text-sm font-medium">Delivery Charge</span>
              <span class="capitalize text-sm font-light">BDT. <span id="delivery_charge">0</span></span>
            </div>

           

            <p class="border-b-2 border-gray-200 w-full pt-10"></p>

            <div class="flex justify-between pt-2">
              <span class="capitalize text-base">Total:</span>
              <span class="capitalize text-base">BDT. <span id="total_price">{{$total - $total_discount}}</span></span>
            </div>
            <div class="flex justify-center pt-5">
              <button id="submitButton"
              type="submit"
                class="max-w-xs flex-1 bg-[#ff6a28] transition duration-300 hover:bg-[#f77f4c] border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white focus:outline-none  sm:w-full"
              >
                Proceed to payment
              </button>
            </div>
          </div>
        </div>

      </form>
    </section>
    {{-- <script>
  document.getElementById("submitButton").addEventListener("click", function() {
    document.getElementById("checkoutForm").submit(); // Submit the form
  });
</script> --}}









@endsection


@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
          $('#location_select').change(function(){
            // Get the selected option's deliveryCharge attribute value
            var deliveryCharge = $(this).find(':selected').attr('deliveryCharge');
            // Set the delivery_charge span to the selected delivery charge
            $('#delivery_charge').text(deliveryCharge);

            // Calculate the total price
            var subTotal = parseFloat($('#sub_total').text());
            var totalDiscount = parseFloat($('#total_discount').text());
            var totalDeliveryCharge = parseFloat(deliveryCharge);
            var totalPrice = subTotal - totalDiscount + totalDeliveryCharge;
            // Update the total_price span with the new total price
            $('#total_price').text(totalPrice);
        });
        });
    </script>
@endpush

<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.heads')
    <title>add product</title>
</head>

<body>
    <div class="m-auto p-5 text-center">
        <form action="{{route('business.appointments.billing.store',['appointment'=>'2'])}}" method="post">
            @csrf
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <div>
                <x-label for="customer_name" :value="__('Customer Name')" />
                <x-input id="customer_name" class="block mt-1 w-full" type="text" name="customer_name"
                    :value="$appointment['user']['firstname'].' '.$appointment['user']['lastname']" />
            </div>
            <div>
                <x-label for="email" :value="__('Email Address')" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$appointment['user']['email']" />
            </div>
            <div>
                <x-label for="contact" :value="__('Contact Number')" />
                <x-input id="contact" class="block mt-1 w-full" type="tel" name="contact" :value="$appointment['user']['contact']" />
            </div>
            <div>
                <x-label for="" :value="__('Payment Method')" />
                <div class="flex flex-row w-full">
                    <x-input id="immediate" class="block mt-1 " type="radio" name="payment_method"
                        value="immediate" />
                    <x-label for="immediate" class="w-fit" :value="__('Pay Immediately')" />
                </div>
                <div class="flex flex-row w-full">
                    <x-input id="personal" class="block mt-1 " type="radio" name="payment_method" value="personal" />
                    <x-label for="personal" class="w-fit" :value="__('Personal')" />
                </div>
            </div>
            <div>
                <x-label for="service_remarks" :value="__('Service Details')" />
                <textarea name="service_remarks" id="service_remarks" class="w-full" rows="3">{{old('service_remarks')}}</textarea>
            </div>
            <div>
                <table class="text-center w-full">
                    <thead>
                        <tr>
                            <th>item</th>
                            <th>quantity</th>
                            <th>price</th>
                            <th>subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <x-input id="items[]" class="block mt-1 w-full" type="text"
                                    name="items[]" />
                            </td>
                            <td>
                                <x-input id="quantity[]" class="block mt-1 w-full" type="number"
                                    name="quantity[]" />
                            </td>
                            <td>
                                <x-input id="price[]" class="block mt-1 w-full" type="number"
                                    name="price[]" />
                            </td>
                            <td>
                                <x-input id="subtotal[]" class="block mt-1 w-full" type="number"
                                    name="subtotal[]" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div>
                <table class="text-center w-full">
                    <thead>
                        <tr>
                            <th>discount</th>
                            <th colspan="2">amount</th>
                            <th>type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <x-input id="discount[]" class="block mt-1 w-full" type="number"
                                    name="discount[]" />
                            </td>
                            <td>
                                <x-input id="percent[]" class="block mt-1 w-full" type="number"
                                    name="percent[]" :placeholder="__('Percent')"/>
                            </td>
                            <td>
                                <x-input id="flat[]" class="block mt-1 w-full" type="number"
                                    name="flat[]" :placeholder="__('Flat')"/>
                            </td>
                            <td>
                                <button>toggle php/%</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="m-5">
                <button type="submit" class="p-5 bg-white">Submit</button>
            </div>
        </form>
    </div>
    @include('includes.feet')
</body>

</html>

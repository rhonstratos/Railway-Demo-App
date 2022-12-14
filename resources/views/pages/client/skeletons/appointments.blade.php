<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.heads')
    <title>skeleton - appointments</title>
</head>

<body class="text-center w-1/2 mx-auto p-10 my-5">
    <form class="bg-slate-300 p-5" action="{{ route('customer.appointments.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div>
            <x-label for="firstName" :value="__('First Name')" />
            <x-input id="firstName" class="block mt-1 w-full" type="text" name="firstName" :value="$user->firstname" readonly="readonly" />
        </div>
        <div>
            <x-label for="lastName" :value="__('Last Name')" />
            <x-input id="lastName" class="block mt-1 w-full" type="text" name="lastName" :value="$user->lastname" readonly="readonly" />
        </div>
        <div>
            <x-label for="contact" :value="__('Contact Number')" />
            <x-input id="contact" class="block mt-1 w-full" type="tel" name="contact" :value="$user->contact" readonly="readonly" />
        </div>
        <div>
            <x-label for="email" :value="__('Email Address')" />
            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$user->email" readonly="readonly" />
        </div>
        <div>
            <x-label for="alt_contact" :value="__('Alternate Contact Number')" />
            <x-input id="alt_contact" class="block mt-1 w-full" type="text" name="alt_contact" :value="old('alt_contact')" />
        </div>
        <div>
            <select name="category" id="cateogry">
                <option value="Mother Board">Mother Board</option>
            </select>
        </div>

        <div>
            <x-label for="product_brand" :value="__('Product Brand')" />
            <x-input id="product_brand" class="block mt-1 w-full" type="text" name="product_brand" :value="old('product_brand')" />
        </div>
        <div>
            <x-label for="model_name" :value="__('Model Name')" />
            <x-input id="model_name" class="block mt-1 w-full" type="text" name="model_name" :value="old('model_name')" />
        </div>
        <div>
            <x-label for="model_num" :value="__('Model Number')" />
            <x-input id="model_num" class="block mt-1 w-full" type="text" name="model_num" :value="old('model_num')" />
        </div>
        <div>
            <x-label for="date_time" :value="__('Date & Time')" />
            <x-input id="date_time" class="block mt-1 w-full" type="datetime-local" name="date_time" :value="old('date_time')" />
        </div>
        <div>
            <textarea name="concern" id="concern" class="w-full" rows="4">{{old('concern')}}</textarea>
        </div>
        <div>
            <input type="file" name="files[]" multiple="multiple">
        </div>
        <div class="m-5">
            <button type="submit" class="p-5 bg-white">Submit</button>
        </div>
    </form>
</body>

</html>

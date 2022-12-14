<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.heads')
    <title>shop settings</title>
</head>

<body class="bg-slate-700 text-white">
    <div class="text-center grid grid-flow-row">
        <div>
            <h2>CURRENT APPOINTMENT SETTINGS</h2>
            <div>
                @if (Auth::check())
                @php
                    $user = Auth::user();
                    $shop = $user->shop;
                    $acc_settings = $user->accountSettings;
                    $shop_img = $acc_settings->profile_img;
                    $userId =Auth::user()->userId;
                    $shop_img="storage/users/{$userId}/images/profile/{$shop_img}";
                    $apt = $shop->toArray();
                    $operatingHours = $shop['appointment_settings']['operatingHours'];
                    $operatingDays = $shop['appointment_settings']['operatingDays'];
                    $accomodation_interval= $shop['appointment_settings']['accomodation_interval'];
                    $castedDays = [];
                    foreach ($operatingDays as $day) {
                        switch ($day) {
                            case \App\Models\Shop::WEEK_MONDAY:     $castedDays[\App\Models\Shop::WEEK_MONDAY] = 'Monday'; break;
                            case \App\Models\Shop::WEEK_TUESDAY:    $castedDays[\App\Models\Shop::WEEK_TUESDAY] = 'Tuesday'; break;
                            case \App\Models\Shop::WEEK_WEDNESDAY:  $castedDays[\App\Models\Shop::WEEK_WEDNESDAY] = 'Wednesday'; break;
                            case \App\Models\Shop::WEEK_THURSDAY:   $castedDays[\App\Models\Shop::WEEK_THURSDAY] = 'Thursday'; break;
                            case \App\Models\Shop::WEEK_FRIDAY:     $castedDays[\App\Models\Shop::WEEK_FRIDAY] = 'Friday'; break;
                            case \App\Models\Shop::WEEK_SATURDAY:   $castedDays[\App\Models\Shop::WEEK_SATURDAY] = 'Saturday'; break;
                            case \App\Models\Shop::WEEK_SUNDAY:     $castedDays[\App\Models\Shop::WEEK_SUNDAY] = 'Sunday'; break;
                        }
                    }
                    $accomodation_slots = $shop['appointment_settings']['accomodation_slots'];
                    $contacts = $apt['contacts'];
                    $googleMaps = $apt['googleMaps'];
                    $googleMaps_embed = $apt['googleMaps_embed'];
                    $services = $apt['services'];
                    $address = $apt['address'];
                    $user = $shop->user->only('userId', 'firstname', 'lastname', 'email', 'contact', 'birthday');
                @endphp
                {{-- {{dd($apt_settings['appointment_settings']['operatingHours']['start'])}} --}}
                {{-- {{dd($apt)}} --}}
                <div class="grid grid-flow-row">
                    <h2 >Shop Name</h2>
                        <div class="font-bold">{{$apt['name']}}</div>
                    <h2 >Shop Img</h2>
                        <img src="{{asset($shop_img)}}" class="mx-auto" alt="{{$acc_settings->profile_img}}">
                    <h2 >Shop Description</h2>
                        <div class="font-bold">{{$apt['description']}}</div>
                    <h2 >Shop Tagline</h2>
                        <div class="font-bold">{{$apt['tagline']}}</div>
                    <h2 >Operating Hours</h2>
                        <div>Start: <span class="font-bold">{{ \Carbon\Carbon::parse($operatingHours['start'])->format('h:i A') }}</span></div>
                        <div>End: <span class="font-bold">{{ \Carbon\Carbon::parse($operatingHours['end'])->format('h:i A') }}</span></div>
                    <h2 >Operating Days</h2>
                    @forelse ($castedDays as $key => $days)
                        <div class="font-bold">{{$days}}</div>
                    @empty
                        <div class="font-bold">empty</div>
                    @endforelse
                    <h2 >Accomodation slots per interval</h2>
                        <div class="font-bold">{{$accomodation_slots}}</div>
                    <h2 >Interval hour/minute</h2>
                        <div class="font-bold">{{$accomodation_interval['hours']}} hour/s</div>
                        <div class="font-bold">{{$accomodation_interval['minutes']}} minute/s</div>
                    <h2 >Address</h2>
                    <div>
                        <div>Street: <span class="font-bold">{{$address['street']}}</span></div>
                        <div>Province: <span class="font-bold">{{$address['province']}}</span></div>
                        <div>City: <span class="font-bold">{{$address['city']}}</span></div>
                        <div>Barangay: <span class="font-bold">{{$address['brgy']}}</span></div>
                        <div>Zip/Postal Code: <span class="font-bold">{{$address['zip']}}</span></div>
                    </div>
                    <h2 >Contacts</h2>
                    @forelse ($contacts as $contact)
                        <div class="font-bold">{{$contact}}</div>
                    @empty
                        <div class="font-bold">empty</div>
                    @endforelse
                    <h2 >Services</h2>
                    @forelse ($services as $service)
                        <div class="font-bold">{{$service}}</div>
                    @empty
                        <div class="font-bold">empty</div>
                    @endforelse
                    <h2 >Google Maps</h2>
                        <div class="font-bold">{{$googleMaps}}</div>
                    <h2 >Google Maps Embed</h2>
                        <div class="font-bold">{{$googleMaps_embed}}</div>
                </div>
            @endif
            </div>
        </div>
        <div class="my-[20px] w-1/2 mx-auto">
            <form action="{{route('business.shop-settings.form1')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <div>
                    <h2>FORM 1</h2>
                </div>
                <div>
                    <x-label for="shop_name" value="Shop Name" class="text-white"/>
                    <x-input id="shop_name" name="shop_name" type="text" class="bg-black w-full" :value="$apt['name']" />
                </div>
                <div>
                    <x-label for="tagline" value="Tagline" class="text-white"/>
                    <x-input id="tagline" name="tagline" type="text" class="bg-black w-full" :value="$apt['tagline']" />
                </div>
                <div>
                    <x-label for="shop_img" value="Image" class="text-white"/>
                    <x-input id="shop_img" name="shop_img" type="file" class="bg-black w-full" />
                </div>
                <div>
                    <button type="submit">Submit</button>
                </div>
            </form>
        </div>
        <div class="my-[20px] mb-10 w-1/2 mx-auto">
            <form action="{{route('business.shop-settings.form2')}}" method="post">
                @csrf
                @method('PATCH')
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <div>
                    <h2>FORM 2</h2>
                </div>
                <div>
                    <x-label for="googleMaps_embed" value="Google Maps URL Link" class="text-white"/>
                    <x-input id="googleMaps_embed" name="googleMaps_embed" type="text" readonly class="bg-black w-full" :value="$googleMaps_embed" />
                </div>
                <div>
                    <x-label for="street" value="Street/Apartment/Building" class="text-white"/>
                    <x-input id="street" name="street" type="text" class="bg-black w-full" :value="$address['street']" />
                </div>
                <div>
                    <x-label for="province" value="Province" class="text-white"/>
                    <x-input id="province" name="province" type="text" class="bg-black w-full" :value="$address['province']" />
                </div>
                <div>
                    <x-label for="city" value="City/Municipal" class="text-white"/>
                    <x-input id="city" name="city" type="text" class="bg-black w-full" :value="$address['city']" />
                </div>
                <div>
                    <x-label for="brgy" value="Barangay" class="text-white"/>
                    <x-input id="brgy" name="brgy" type="text" class="bg-black w-full" :value="$address['brgy']" />
                </div>
                <div>
                    <x-label for="zip" value="Zip Code" class="text-white"/>
                    <x-input id="zip" name="zip" type="text" class="bg-black w-full" :value="$address['zip']" />
                </div>
                <div class="mapouter my-3">
                    <iframe width="600" height="500" id="gmap_canvas"
                    class="rounded-lg mx-auto"
                        src="{{$googleMaps_embed}}"
                        frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                </div>
                <div>
                    <x-label for="googleMaps" value="Google Maps URL Link" class="text-white"/>
                    <x-input id="googleMaps" name="googleMaps" type="text" class="bg-black w-full" :value="$googleMaps" />
                </div>
                <div>
                    <button type="submit">Submit</button>
                </div>
            </form>
        </div>
        <div class="my-[20px] mb-10 w-1/2 mx-auto">
          <form action="{{route('business.shop-settings.form3')}}" method="post">
              @csrf
              @method('PATCH')
              <!-- Session Status -->
              <x-auth-session-status class="mb-4" :status="session('status')" />
              <!-- Validation Errors -->
              <x-auth-validation-errors class="mb-4" :errors="$errors" />
              <div>
                  <h2>FORM 3</h2>
              </div>
              <div>
                    <textarea name="shop_desc" id="shop_desc" class="bg-black w-full" rows="3">{{$apt['description']}}</textarea>
              </div>
              @foreach ($contacts as $key => $field)
              <div>
                  <x-label for="contacts" :value="$key" class="text-white capitalize"/>
                  <x-input id="contacts" name="contacts[{{$key}}]" type="text" class="bg-black w-full" :value="$field" />
              </div>
              @endforeach
              <div>
                  <button type="submit">Submit</button>
              </div>
          </form>
        </div>
        <div class="my-[20px] mb-10 w-1/2 mx-auto">
            <form action="{{route('business.shop-settings.form4')}}" method="post">
                @csrf
                @method('PATCH')
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <div>
                    <h2>FORM 4</h2>
                </div>
                <div>
                    <x-label for="time_opening" value="Opening Hours" class="text-white capitalize"/>
                    <x-input id="time_opening" name="time_opening" type="time" class="bg-black w-full" :value="\Carbon\Carbon::parse($operatingHours['start'])->format('H:i')" />
                </div>
                <div>
                    <x-label for="time_closing" value="Closing Hours" class="text-white capitalize"/>
                    <x-input id="time_closing" name="time_closing" type="time" class="bg-black w-full" :value="\Carbon\Carbon::parse($operatingHours['end'])->format('H:i')" />
                </div>
                <div>
                    <x-label for="time_interval" value="Accomodation Slots per Time Block" class="text-white capitalize"/>
                    <x-input id="time_interval" name="time_interval" type="number" class="bg-black w-full" :value="$accomodation_slots" />
                </div>
                <div>
                    <x-label for="time_interval_hour" value="Time Interval Hour" class="text-white capitalize"/>
                    <x-input id="time_interval_hour" name="time_interval_hour" type="number" class="bg-black w-full" :value="$accomodation_interval['hours']" />
                </div>
                <div>
                    <x-label for="time_interval_minute" value="Time Interval Minutes" class="text-white capitalize"/>
                    <x-input id="time_interval_minute" name="time_interval_minute" type="number" class="bg-black w-full" :value="$accomodation_interval['minutes']" />
                </div>
                <div>
                    <x-label  value="Operating Days" class="text-white capitalize"/>
                    @foreach (config('enums.week_days') as $key => $days)
                    <div class="flex flex-row text-center mx-auto w-full">
                        <x-label for="week_days-{{$key}}" :value="$days" class="text-white capitalize"/>
                        <input id="week_days-{{$key}}" name="operating_days[{{$key}}]" type="checkbox" {{((isset($castedDays[$key])) ? __('checked'):__(''))}} class="bg-black" />
                    </div>
                    @endforeach
                </div>
                <div>
                    <button type="submit">Submit</button>
                </div>
            </form>
          </div>
    </div>
    @include('includes.feet')
    <script>
        $('input#street').on('input',(e) => changeGoogleMaps());
        $('input#province').on('input',(e) => changeGoogleMaps());
        $('input#city').on('input',(e) => changeGoogleMaps());
        $('input#brgy').on('input',(e) => changeGoogleMaps());
        $('input#zip').on('input',(e) => changeGoogleMaps());
        const changeGoogleMaps = () => {
            let street = $('input#street').val()
            let province = $('input#province').val()
            let city = $('input#city').val()
            let brgy = $('input#brgy').val()
            let zip = $('input#zip').val()

            let query = `${(street ? street+',':'')}${(brgy ? brgy+',':'')}${(city ? city+',':'')}${(province ? province+',':'')}${(zip ? zip+',':'')}`
            while(query.indexOf(' ') >= 0){
                query = query.replace(' ','%20')
            }
            let url = `https://maps.google.com/maps?q=${query}&t=&z=13&ie=UTF8&iwloc=&output=embed`
            $('input#googleMaps_embed').val(url)
            $('iframe#gmap_canvas').attr('src',url)
        };
    </script>
</body>

</html>

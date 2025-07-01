{{-- address.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OhhBuddie | Address</title>
    <link rel="icon" type="image/x-icon" href="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Ohbuddielogo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/assets/css/style.css') }}">
    <style>
        :root { --primary-color: #efc475; }
        body {
            font-family: 'Arial', sans-serif;
            background-color: black;
            color: white;
            padding-top: 60px;
            padding-bottom: 80px;
        }
        .navbar-fixed-top, .btn-fixed-bottom {
            position: fixed;
            left: 0; right: 0;
            z-index: 1030;
        }
        .navbar-fixed-top {
            top: 0;
            background-color: black;
            height: 60px;
            display: flex;
            align-items: center;
            padding: 0 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.5);
        }
        .navbar-fixed-top .header { font-size: 18px; font-weight: bold; margin-left: 15px; }
        .container { background: black; border-radius: 12px; padding: 20px; }
        .section-title { font-size: 16px; font-weight: bold; color: var(--primary-color); margin-bottom: 10px; }
        .form-control { border: none; border-radius: 8px; font-size: 14px; padding: 12px; }
        .form-control:focus { box-shadow: none; }
        .btn-fixed-bottom {
            bottom: 0;
            text-align: center;
        }
        .btn-primary {
            background-color: var(--primary-color);
            color: black;
            font-weight: bold;
            border: none;
        }
        .mobile-input-wrapper {
            display: flex;
            align-items: center;
            background-color: transparent;
        }
        .country-code {
            background-color: white;
            color: black;
            padding: 5px;
            border-radius: 4px 0 0 4px;
        }
        .country-code img {
            width: 20px;
            height: 14px;
            margin-right: 5px;
        }
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        .dropdown-custom { width: 100%; font-size: 14px; }
        .save-address-section .form-check {
            text-align: center;
        }
        .styled-radio, .styled-checkbox { display: none; }
        .styled-label {
            display: inline-block;
            cursor: pointer;
            padding: 10px 16px;
            border: 2px solid white;
            border-radius: 30px;
            transition: 0.3s ease;
        }
        .styled-radio:checked + .styled-label,
        .styled-checkbox:checked + .styled-label {
            background-color: var(--primary-color);
            color: black;
            border-color: var(--primary-color);
        }
        .styled-label i {
            margin-right: 8px;
        }
        
        
        
        
        
        
        /* Replace your existing .mobile-input-wrapper and related CSS with this: */

.mobile-input-wrapper {
    display: flex;
    align-items: stretch; /* This ensures all elements have same height */
    gap: 0;
    border: 1px solid #ced4da;
    border-radius: 8px;
    overflow: hidden;
    background-color: white;
    padding: 0; /* Remove any padding from wrapper */
    margin-bottom: 1rem;
}

.mobile-input-wrapper.form-control {
    padding: 0 !important; /* Override Bootstrap form-control padding */
}

.country-code {
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f8f9fa;
    color: black;
    padding: 12px 10px; /* Match the input padding */
    border-right: 1px solid #ced4da;
    white-space: nowrap;
    font-weight: 500;
    min-width: 50px; /* Ensure consistent width */
    border-radius: 0; /* Remove any border radius */
}

.country-code img {
    width: 16px;
    height: 14px;
    margin-right: 5px;
}

.mobile-input-wrapper input[type="number"] {
    flex: 1; /* Take up remaining space */
    border: none !important;
    outline: none !important;
    box-shadow: none !important;
    border-radius: 0 !important;
    padding: 12px;
    font-size: 14px;
    background: white;
    color: black;
    margin: 0; /* Remove any margins */
}

.mobile-input-wrapper input[type="number"]:focus {
    border: none !important;
    box-shadow: none !important;
    outline: none !important;
}

.mobile-input-wrapper .btn {
    border-radius: 10px; !important;
    font-size:10px;
    border: none;
    padding: 6px 8px; /* Match input padding */
    white-space: nowrap;
    /*font-weight: bold;*/
    min-width: 45px; /* Ensure button doesn't get too small */
    margin: 0; /* Remove any margins */
    height:35px;
}

/* Focus effect for the entire wrapper */
.mobile-input-wrapper:focus-within {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.25rem rgba(239, 196, 117, 0.25);
}

/* Remove spinner arrows from number input */
input[type="number"]::-webkit-outer-spin-button,
input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

input[type="number"] {
    -moz-appearance: textfield;
}
    </style>
</head>
<body>

    <!-- Top Navbar -->
    <div class="navbar-fixed-top">
        <a href="javascript:history.back();" style="font-size: 20px; color:white;"><i class="fas fa-arrow-left"></i></a>
        <div class="header">ADD NEW ADDRESS</div>
    </div>

    <!-- Main Content -->
    
    @guest
    <div class="container">
        <h5 class="section-title">Contact Details</h5>

        <!-- OTP Form -->
        <form method="POST" action="{{ route('otp.generate1') }}">
            @csrf
            <div class="mobile-input-wrapper form-control mb-3">
                <span class="country-code">
                    <img src="https://upload.wikimedia.org/wikipedia/en/4/41/Flag_of_India.svg" alt="India Flag"> +91
                </span>
                <input
                    type="number"
                    name="mobile_no"
                    id="mobile"
                    class="form-control"
                    placeholder="Enter WhatsApp Number"
                    maxlength="10"
                    required
                    value="{{ old('mobile_no') }}"
                >
                <button type="submit" class="btn btn-danger btn-sm" style="background-color:var(--primary-color); color:black; font-size:10px; margin-top:5px; margin-right:5px">Send OTP</button>
            </div>
            <span id="error-message" style="color: red; display: none;">Invalid mobile number. Start with 6-9 & 10 digits only.</span>
        </form>

        <!-- Conditionally Show OTP Field -->
        @if(session('otp_sent') || old('otp'))
            <div class="mb-3 mt-2">
                <input type="text" class="form-control" name="otp" placeholder="Enter OTP" required>
            </div>
        @endif

        <!-- Address Form -->
        <form action="/address/store" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            <div class="mb-3">
                <input type="text" class="form-control" name="name" placeholder="Enter your name" required>
            </div>

            <div class="divider mt-4"></div>
            <h5 class="section-title">Address</h5>

            <div class="mb-3"><input type="text" class="form-control" name="address_line_1" placeholder="Address Line 1" required></div>
            <div class="mb-3"><input type="text" class="form-control" name="address_line_2" placeholder="Address Line 2"></div>
            <div class="mb-3"><input type="text" class="form-control" name="locality" placeholder="Locality" required></div>
            <div class="mb-3"><input type="number" class="form-control" name="pincode" placeholder="Pincode" minlength="6" maxlength="6" required></div>

            <div class="row">
                <div class="col-6 mb-3">
                    <select name="state" id="registered_state" class="form-control dropdown-custom" required>
                        <option value="">--Select State--</option>
                        @foreach($state as $st)
                            <option value="{{ $st->id }}">{{ $st->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6 mb-3">
                    <select name="city" id="registered_city" class="form-control dropdown-custom" required>
                        <option value="">--Select City--</option>
                    </select>
                </div>
            </div>

             <div class="save-address-section mt-4">
            <h5 class="section-title">Save Address As</h5>
            <div class="d-flex justify-content-around mt-3">
        
                    <div class="form-check" style="padding-left:0px;">
                        <input class="form-check-input styled-radio" type="radio" name="type" id="home" value="home" checked>
                        <label class="form-check-label styled-label" for="home">
                            <i class="fas fa-home"></i> Home
                        </label>
                    </div>
                    <div class="form-check" style="padding-left:0px;">
                        <input class="form-check-input styled-radio" type="radio" name="type" id="work" value="work">
                        <label class="form-check-label styled-label" for="work">
                            <i class="fas fa-briefcase"></i> Work
                        </label>
                    </div>
                    <div class="form-check" style="padding-left:0px;">
                        <input class="form-check-input styled-radio" type="radio" name="type" id="others" value="other">
                        <label class="form-check-label styled-label" for="others">
                            <i class="fas fa-briefcase"></i> Other
                        </label>
                    </div>
               
            </div>
        </div>

            <!-- Submit Button -->
            <div class="btn-fixed-bottom mt-4">
                <button type="submit" class="btn btn-primary w-100" id="addAddressBtn">Add Address</button>
            </div>
        </form>
    </div>


   @endguest
   
   @auth
   
     <div class="container">
        <!-- Contact Details -->
        <div>
            <h5 class="section-title">Contact Details</h5>
            <form action="/address/store" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                     <input type="hidden" class="form-control" id="name" name="user_id" value="{{ Auth::user()->id }}" required>
                </div>
                <!--<div class="mb-3">-->
                <!--    <input type="tel" class="form-control" id="mobile" placeholder="Enter your mobile number" required>-->
                <!--</div>-->
                
            <div class="mobile-input-wrapper form-control" style="width:100%">
                <span class="country-code">
                    <img src="https://upload.wikimedia.org/wikipedia/en/4/41/Flag_of_India.svg" alt="India Flag" class="flag-icon">
                    +91
                </span>
                <input type="number" id="mobile" maxlength="10" class="form-control" placeholder="Enter Mobile Number" name="phone" style=" padding: 9px;">
            </div>
                <span id="error-message" style="color: red; display: none;">Please enter a valid 10-digit mobile number starting with 6, 7, 8, or 9.</span>
                
       
        </div>

        <div class="divider"></div>

        <!-- Address -->
        <div>
            <h5 class="section-title">Address</h5>
          
                <div class="mb-3">
                    <input type="text" class="form-control" id="address" name="address_line_1" placeholder="Enter Address Line 1" required>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" id="address" name="address_line_2" placeholder="Enter Address Line 2" >
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" id="locality" name="locality" placeholder="Enter Your Locality" required>
                </div>
                <div class="mb-3">
                    <input type="number" class="form-control" id="pincode" minlength="6" maxlength="6" name="pincode" placeholder="Enter Your Pincode" required>
                </div>
                <div class="row">
                    <div class="col-6 mb-3">
                        <!--<input type="text" class="form-control" id="district" placeholder="City" >-->
                        <select class="form-control dropdown-custom" name="state" id="registered_state">
                            <option value="" selected disabled>--Select State--</option>
                            @foreach($state as $st)
                                <option value="{{$st->id}}">{{$st->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-6 mb-3">
                        <!--<input type="text" class="form-control" id="district" placeholder="City" >-->
                        <select id="registered_city" class="form-control dropdown-custom" name="city">
                            <option selected>--Select City--</option>
                        </select>
                    </div>
                </div>
          
        </div>

        <div class="divider"></div>

        <!-- Save Address As Section -->
        <div class="save-address-section mt-4">
            <h5 class="section-title">Save Address As</h5>
            <div class="d-flex justify-content-around mt-3">
        
                    <div class="form-check" style="padding-left:0px;">
                        <input class="form-check-input styled-radio" type="radio" name="type" id="home" value="home" checked>
                        <label class="form-check-label styled-label" for="home">
                            <i class="fas fa-home"></i> Home
                        </label>
                    </div>
                    <div class="form-check" style="padding-left:0px;">
                        <input class="form-check-input styled-radio" type="radio" name="type" id="work" value="work">
                        <label class="form-check-label styled-label" for="work">
                            <i class="fas fa-briefcase"></i> Work
                        </label>
                    </div>
                    <div class="form-check" style="padding-left:0px;">
                        <input class="form-check-input styled-radio" type="radio" name="type" id="others" value="other">
                        <label class="form-check-label styled-label" for="others">
                            <i class="fas fa-briefcase"></i> Other
                        </label>
                    </div>
               
            </div>
        </div>
        
        <!-- Default Address Section -->
        <!--<div class="default-address-section mt-4">-->
        <!--    <div class="form-check d-flex align-items-center justify-content-center">-->
        <!--        <input class="form-check-input styled-checkbox" type="checkbox" id="defaultAddress">-->
        <!--        <label class="form-check-label styled-label ms-3" for="defaultAddress">-->
        <!--            <i class="fas fa-check-circle"></i> Make It Default-->
        <!--        </label>-->
        <!--    </div>-->
        <!--</div>-->
    </div>
     <div class="btn-fixed-bottom">
        <button class="btn btn-primary w-100" id="addAddressBtn">Add Address</button>
    </div>
   
   @endauth
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Dynamic City Dropdown
        $('#registered_state').on('change', function() {
            const stateId = $(this).val();
            if (stateId) {
                $.get("{{ route('getCities') }}", { state_id: stateId }, function(data) {
                    $('#registered_city').empty().append('<option value="">--Select City--</option>');
                    data.forEach(city => $('#registered_city').append(`<option value="${city.id}">${city.name}</option>`));
                });
            }
        });

        // Mobile validation
        $('#mobile').on('input', function() {
            const val = this.value;
            const error = $('#error-message');
            if (/^[0-5]/.test(val) || val.length > 10) {
                this.value = val.slice(0, -1);
                error.show();
            } else {
                error.hide();
            }
        });
    </script>
</body>
</html>
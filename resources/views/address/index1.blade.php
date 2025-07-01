<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>OhhBuddie | Address</title>
    <link rel="icon" type="image/x-icon" href="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Ohbuddielogo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/assets/css/style.css') }}"> 
    

        
    <style>
        @media screen and (min-width: 778px){
            .navbar-fixed-top, .btn-fixed-bottom{
                left: 30% !important;
                 right: 30% !important;
            }
            .container{
                width: 40% !important;
            }
            
        }
        
    </style>
    
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: black;
            color: white;
            padding-top: 60px; /* For navbar height */
            padding-bottom: 80px; /* For button height */
            margin: 0;
        }

        .navbar-fixed-top {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            background-color: black;
            height: 60px;
            display: flex;
            align-items: center;
            padding: 0 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
        }

        .navbar-fixed-top .header {
            font-size: 18px;
            font-weight: bold;
           
            margin-left: 15px;
        }

        .container {
           
            background: black;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .form-control {
            /*color: #f5f5f5;*/
            border: none;
            border-radius: 8px;
            font-size: 14px;
            padding: 12px;
        }

        .form-control:focus {
            outline: none;
            /*border: 2px solid var(--primary-color);*/
            box-shadow: none;
            /*background-color: black;*/
            /*color: white;*/
        }

        .form-check-label {
            font-size: 14px;
            color: #f5f5f5;
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .divider {
            border-top: 1px solid #444;
            margin: 20px 0;
        }

        .btn-fixed-bottom {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            /*padding: 16px;*/
            text-align: center;
            
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            font-size: 16px;
            font-weight: bold;
            /*border-radius: 30px;*/
            color:black;
        }


        /* Extra Spacing for Mobile View */
        @media (max-width: 576px) {
            .form-control {
                font-size: 16px;
                padding: 14px;
            }

            .container {
                padding: 15px;
            }

            .btn-primary {
                font-size: 18px;
                padding: 14px;
            }
             .styled-label {
                    font-size: 14px;
                    padding: 10px;
                }
            
                .styled-label i {
                    font-size: 16px;
                }
        }
        
        
        
        
        /* Save Address As Section */
            .save-address-section .form-check {
                text-align: center;
            }
            
            .styled-radio {
                display: none;
            }
            
            .styled-label {
                display: inline-block;
                cursor: pointer;
                font-size: 16px;
                padding: 12px 16px;
                border: 2px solid white;
                border-radius: 30px;
                transition: all 0.3s ease;
            }
            
            .styled-radio:checked + .styled-label {
                background-color: var(--primary-color);
                color: #000;
                border: 2px solid var(--primary-color);
                box-shadow: 0 4px 8px rgba(239, 196, 117, 0.3);
            }
            
            /* Icons */
            .styled-label i {
                margin-right: 8px;
                font-size: 18px;
            }
            
            /* Default Address Section */
            .default-address-section {
                margin-top: 20px;
            }
            
            .styled-checkbox {
                display: none;
            }
            
            .styled-checkbox + .styled-label {
                font-size: 16px;
                color: var(--primary-color);
                display: flex;
                align-items: center;
                padding: 10px 16px;
                border: 2px solid var(--primary-color);
                border-radius: 30px;
                cursor: pointer;
                transition: all 0.3s ease;
            }
            
            .styled-checkbox:checked + .styled-label {
                background-color: var(--primary-color);
                color: #000;
                box-shadow: 0 4px 8px rgba(239, 196, 117, 0.3);
            }
            
            /* Icons for Checkbox */
            .styled-checkbox + .styled-label i {
                margin-right: 10px;
                font-size: 18px;
            }
            
        
        /*Add Address Button Styles */
        #addAddressBtn {
            background-color: var(--primary-color);
            border: none;
            font-size: 16px;
            font-weight: bold;
            border-radius: unset;
            color: Black;
            transition: all 0.3s ease;
        }
        
        /* Active (Pressed) Effect */
        #addAddressBtn:active {
            background-color: #c79233;
            box-shadow: none;
            Color:white;
        }

    </style>
    <style>
    .mobile-input-wrapper {
        display: flex;
        align-items: center;
        padding: 5px;
    }

    .country-code {
        display: flex;
        align-items: center;
        padding: 5px;
        background-color: white;
        color: black;
    }
    
    .flag-icon {
        width: 20px;
        height: 14px;
        margin-right: 5px;
    }
    
    .mobile-input-wrapper input[type="text"] {
        flex: 1;
        border: none;
        padding: 5px;
        outline: none;
    }

    </style>
    <style>
        
    /* Compact and responsive dropdown */
    .dropdown-custom {
        width: 100%; /* Ensure full width */
        
        font-size: 14px; /* Improve readability */
       
        border-radius: 5px; /* Slightly rounded corners */
    }
    
    /* Prevent dropdown from going outside the screen */
    .dropdown-custom:focus {
        overflow: auto;
    }
    
    /* Ensure dropdown stays within the viewport */
    .dropdown-menu {
        max-height: 200px; /* Set max height */
        overflow-y: auto; /* Enable scrolling */
    }
    
    /* Fix layout on small screens */
    @media (max-width: 576px) {
        .dropdown-custom {
            font-size: 13px;
            
        }
    }
    
    input[type=number]:focus {
      border: none;
    }
    
    @media (max-width: 370px) {
        .phinput {
            width: 43vw !important;
            
        }
    }
    
    </style>
</head>
<body>

    <!-- Top Navbar -->
    <div class="navbar-fixed-top">
        <a href="javascript:history.back();" style="font-size: 20px; color:white;">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div class="header">ADD NEW ADDRESS</div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <!-- Contact Details -->
        <div>
            <h5 class="section-title">Contact Details
            
           
            
            @auth
            @endauth
            
            </h5>
            
            <form method="POST" action="{{ route('otp.generate1') }}" style="position: absolute; top: 14vh;">

                        @csrf
						<div class="input-group">
                            <!--<label for="mobile_no" class="col-md-4 col-form-label text-md-end">{{ __('Mobile No') }}</label>-->
                            
                            <div class="mobile-input-wrapper form-control" style="width:93vw">
                                <span class="country-code ">
                                    <img src="https://upload.wikimedia.org/wikipedia/en/4/41/Flag_of_India.svg" alt="India Flag" class="flag-icon">
                                     +91 
                                </span>
                                <input type="text" class="phinput" value="{{ substr($phone, 3) }}" name="mobile_no" style="width:54vw;" readonly>

                                <span id="error-message" style="color: red; display: none;">Please enter a valid 10-digit mobile number starting with 6, 7, 8, or 9.</span>
                                    
                                 @guest
                                	<button class="btn btn-danger mx-0" style="background-color:var(--primary-color); color:black; border:none; height: 100%;">
            							OTP Sent
            						</button>
            					 @endguest
            					 @auth
                                	<button class="btn btn-danger mx-0" style="background-color:green; color:white; border:none; height: 100%;">
            							Verified
            						</button>
            					 @endauth
                            </div>
                                @error('mobile_no')

                                    <span class="invalid-feedback" role="alert">

                                        <strong>{{ $message }}</strong>

                                    </span>

                                @enderror
						</div>

					

						</form>
						
						
			@guest			
            <form method="POST" action="{{ route('otp.getlogin1') }}" style="position: absolute; top: 22vh;">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user_id }}" />
            
                <div style="position: relative; width: 93vw">
                    <input type="text" name="otp" id="otp"
                        class="@error('otp') is-invalid @enderror form-control"
                        value="{{ old('otp') }}"
                        style="width: 100%; padding-right: 100px;" {{-- space for button --}}
                        placeholder="Enter Your 6 Digit OTP" />
            
                    <button type="submit"
                        style="
                            position: absolute;
                            right: 0;
                            top: 0;
                            height: 100%;
                            border: none;
                            background-color: #efc475;
                            padding: 0 15px;
                            border-top-right-radius: 5px;
                            border-bottom-right-radius: 5px;
                            font-weight: bold;
                            font-size:10px; 
                            margin-top:5px; 
                            margin-right:5px;
                            min-width: 45px;
                            height:39px;
                            border-radius:10px;
                        ">
                        Verify
                    </button>
            
                    @error('otp')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </form>   
            @endguest
            
            
            <form action="/address/store" method="POST">
                @csrf
                @guest
                <div class="mb-3" style="position: absolute; top: 31vh;">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" style="width:93vw;" >
                     <input type="hidden" class="form-control" id="name" name="user_id"  >
                </div>
                @endguest
                @auth
                <div class="mb-3" style="position: absolute; top: 22vh;">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" style="width:93vw;" required>
                     <input type="hidden" class="form-control" id="name" name="user_id"  >
                </div>
                @endauth

       
        </div>
        @guest
        <div class="divider" style="margin-top: 30vh;"></div>
        @endguest
        @auth
        <div class="divider" style="margin-top: 22vh;"></div>
        @endauth
        <!-- Address -->
        <div>
            <h5 class="section-title">Address</h5>
               <input type="text" value="{{$phone}}" name="phone" style="width:220px;" hidden>
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
                        <select class="form-control dropdown-custom" name="state" id="registered_state" required>
                            <option value="" selected disabled>--Select State--</option>
                            @foreach($state as $st)
                                <option value="{{$st->id}}">{{$st->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-6 mb-3">
                        <!--<input type="text" class="form-control" id="district" placeholder="City" >-->
                        <select id="registered_city" class="form-control dropdown-custom" name="city" required>
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
    
    </div>

        <!-- Add Address Button -->
    @auth
    <div class="btn-fixed-bottom">
        <button class="btn btn-primary w-100" id="addAddressBtn">Add Address</button>
    </div>
  </form>
  @endauth

  <!-- Add jQuery to handle AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#registered_state').on('change', function() {
                var state_id = $(this).val();

                if (state_id) {
                    $.ajax({
                        url: "{{ route('getCities') }}",
                        type: "GET",
                        data: { state_id: state_id },
                        success: function(data) {
                            $('#registered_city').empty();
                            $('#registered_city').append('<option selected>--Select City--</option>');
                            $.each(data, function(key, city) {
                                $('#registered_city').append('<option value="'+ city.id +'">'+ city.name +'</option>');
                            });
                        }
                    });
                } else {
                    $('#registered_city').empty();
                    $('#registered_city').append('<option selected>--Select City--</option>');
                }
            });
        });
    </script>


    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.getElementById('mobile').addEventListener('input', function() {
            var mobile = this.value;
            var errorMessage = document.getElementById('error-message');
            
            // Check if the first digit is one of 0, 1, 2, 3, 4, 5, and prevent input
            if (/^[0-5]/.test(mobile)) {
                this.value = mobile.slice(0, -1); // Remove the last character entered
                errorMessage.style.display = 'block';
            } else {
                errorMessage.style.display = 'none';
            }
    
            // Allow only 10 digits
            if (mobile.length > 10) {
                this.value = mobile.slice(0, 10); // Limit to 10 digits
            }
        });
    </script>

    @if (Auth::check())
    <script src="https://cdn.logrocket.io/LogRocket.min.js"></script>
    <script>
        LogRocket.init('a4hegy/ohh-buddie'); // Replace this with your actual LogRocket ID

        LogRocket.identify("{{ Auth::user()->id }}", {
            name: "{{ Auth::user()->name }}",
            email: "{{ Auth::user()->email }}",
            phone: "{{ Auth::user()->phone }}"
        });
    </script>
    @endif
    
    <!-------Body  Section------>
    
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KCL2HTR9" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    
    <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=2681722928691492&ev=PageView&noscript=1"/></noscript>
    
</body>
</html>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>nihusubu | Register</title>

    {{--  google analytics  --}}
    @include('layouts.google_analytics')

    <!-- Hotjar Tracking Code for http://nihusubu.com -->
    <script>
        (function(h,o,t,j,a,r){
            h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
            h._hjSettings={hjid:1891042,hjsv:6};
            a=o.getElementsByTagName('head')[0];
            r=o.createElement('script');r.async=1;
            r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
            a.appendChild(r);
        })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    </script>

    <link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/plugins/steps/jquery.steps.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="text-center loginscreen   animated fadeInDown">
        <div class="col-md-8 col-md-offset-2">
            <div>

                {{--  <span class="logo-name">N</span>  --}}
                <img style="height:150px;" src="{{ asset('logo_transparent.png') }}" />

            </div>
            <div class="ibox-content">
                <h2>
                    Set up your organization profile
                </h2>

                <form id="form" action="{{ route('business.store.account') }}" method="post" class="wizard-big">
                    @csrf
                    <h1>Account</h1>
                    <fieldset>
                        <h2>User Information</h2>
                        <div class="row">
                            <div class="col-lg-10 col-md-offset-1">
                                <div class="form-group">
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                    <label>Name *</label>
                                    <input id="name" name="name" type="text" placeholder="{{ __('Name') }}" value="{{ old('name') }}" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }} input-lg required">
                                </div>
                                <div class="form-group">
                                    @if ($errors->has('username'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                    <label>Username *</label>
                                    <input id="username" name="username" type="text"  placeholder="{{ __('Username') }}" value="{{ old('username') }}" class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }} input-lg required">
                                </div>
                                <div class="form-group">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                    <label>Email *</label>
                                    <input id="email" name="email" type="email" placeholder="{{ __('Email') }}" value="{{ old('email') }}" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }} input-lg required email">
                                </div>
                                <div class="form-group">
                                    @if ($errors->has('phone_number'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('phone_number') }}</strong>
                                        </span>
                                    @endif
                                    <label>Phone Number *</label>
                                    <input id="phone_number" name="phone_number" type="tel" placeholder="{{ __('Phone number') }}" value="{{ old('phone_number') }}" class="form-control {{ $errors->has('phone_number') ? ' is-invalid' : '' }} input-lg required">
                                </div>
                                <div class="form-group">
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                    <label>Password *</label>
                                    <input id="password" name="password" type="password" value="{{ old('password') }}"  class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }} input-lg required">
                                </div>
                                <div class="form-group">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                    <label>Confirm Password *</label>
                                    <input id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}"  type="password" class="form-control {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }} input-lg required">
                                </div>
                            </div>
                        </div>

                    </fieldset>

                    <h1>Business</h1>
                    <fieldset>
                        <h2>Business Information</h2>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    @if ($errors->has('business_name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('business_name') }}</strong>
                                        </span>
                                    @endif
                                    <label>Name *</label>
                                    <input id="business_name" name="business_name" placeholder="{{ __('Business name') }}" value="{{ old('business_name') }}" type="text" class="form-control {{ $errors->has('business_name') ? ' is-invalid' : '' }} input-lg required">
                                </div>
                                <div class="form-group">
                                    @if ($errors->has('portal'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('portal') }}</strong>
                                        </span>
                                    @endif
                                    <label>Portal <i class="has-warning" data-toggle="tooltip" data-placement="right" title="Portal is an institution specific name that seperates your institution from others."><i class="fa fa-2x fa-question-circle"></i></i></label>
                                    <input id="portal" name="portal" type="text" onblur="this.value=removeSpaces(this.value)" onkeyup="removeSpaces(this.value)"  placeholder="{{ __('Portal') }}" value="{{ old('portal') }}" class="form-control {{ $errors->has('portal') ? ' is-invalid' : '' }} input-lg required">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    @if ($errors->has('business_email'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('business_email') }}</strong>
                                        </span>
                                    @endif
                                    <label>Email *</label>
                                    <input id="business_email" name="business_email" placeholder="{{ __('Business Email') }}" value="{{ old('business_email') }}" type="text" class="form-control {{ $errors->has('business_email') ? ' is-invalid' : '' }} input-lg required email">
                                </div>
                                <div class="form-group">
                                    @if ($errors->has('business_phone_number'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('business_phone_number') }}</strong>
                                        </span>
                                    @endif
                                    <label>Phone Number *</label>
                                    <input id="business_phone_number" name="business_phone_number" placeholder="{{ __('Business Phone Number') }}" value="{{ old('business_phone_number') }}" type="text" class="form-control {{ $errors->has('business_phone_number') ? ' is-invalid' : '' }} required input-lg">
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="form-group">
                                @if ($errors->has('address_line_1'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('address_line_1') }}</strong>
                                    </span>
                                @endif
                                <label>Address Line 1 *</label>
                                <input id="address_line_1" name="address_line_1" type="text" placeholder="{{ __('Address Line 1') }}" value="{{ old('address_line_1') }}" class="form-control {{ $errors->has('address_line_1') ? ' is-invalid' : '' }} input-lg">
                            </div>
                            <div class="form-group">
                                @if ($errors->has('address_line_2'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('address_line_2') }}</strong>
                                    </span>
                                @endif
                                <label>Address Line 2</label>
                                <input id="address_line_2" name="address_line_2" placeholder="{{ __('Address Line 2') }}" value="{{ old('address_line_2') }}" type="text" class="form-control {{ $errors->has('address_line_2') ? ' is-invalid' : '' }} input-lg">
                            </div>
                            <div class="form-group">
                                @if ($errors->has('street'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('street') }}</strong>
                                    </span>
                                @endif
                                <label>Street</label>
                                <input id="street" name="street" type="text" placeholder="{{ __('Street') }}" value="{{ old('street') }}" class="form-control {{ $errors->has('street') ? ' is-invalid' : '' }} input-lg">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    @if ($errors->has('city'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('city') }}</strong>
                                        </span>
                                    @endif
                                    <label>City *</label>
                                    <input id="city" name="city" type="text" placeholder="{{ __('City') }}" value="{{ old('city') }}" class="form-control {{ $errors->has('city') ? ' is-invalid' : '' }} input-lg required">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    @if ($errors->has('postal_code'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('postal_code') }}</strong>
                                        </span>
                                    @endif
                                    <label>Postal Code *</label>
                                    <input id="postal_code" name="postal_code" placeholder="{{ __('Postal Code') }}" value="{{ old('postal_code') }}" type="text" class="form-control {{ $errors->has('postal_code') ? ' is-invalid' : '' }} input-lg required">
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    @if ($errors->has('currency'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('currency') }}</strong>
                                        </span>
                                    @endif
                                    <label>Currency *</label>
                                    <select name="currency" id="currency" class="form-control input-lg {{ $errors->has('currency') ? ' is-invalid' : '' }} required">
                                        <option selected value="0839e6c9-20b3-4442-b3b6-5137a4d309ec">KES - Kenyan Shillings</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    @if ($errors->has('plan'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('plan') }}</strong>
                                        </span>
                                    @endif
                                    <label>Plan *</label>
                                    <select name="plan" id="plan" class="form-control input-lg {{ $errors->has('plan') ? ' is-invalid' : '' }} required">
                                        <option value="{{$plan->id}}">{{$plan->name}}[{{$plan->price}}]</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </fieldset>


                    <h1>Finish</h1>
                    <fieldset>
                        <h2>Terms and Conditions</h2>
                    <input id="acceptTerms" name="acceptTerms" type="checkbox" class="required"> <label for="acceptTerms">I agree with the <a target="_blank" href="{{route('terms.and.conditions')}}">Terms and Conditions</a>.</label>

                        {{-- <button type="submit" class="btn btn-success btn-block btn-outline btn-lg mt-4">{{ __('Save') }}</button> --}}
                    </fieldset>
                </form>
            </div>
            <p class="m-t">Copyright &copy; <script>document.write(new Date().getFullYear());</script></p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{ asset('inspinia') }}/js/jquery-2.1.1.js"></script>
    <script src="{{ asset('inspinia') }}/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="{{ asset('inspinia') }}/js/plugins/iCheck/icheck.min.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('inspinia') }}/js/inspinia.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/pace/pace.min.js"></script>
    <!-- Steps -->
    <script src="{{ asset('inspinia') }}/js/plugins/staps/jquery.steps.min.js"></script>

    <!-- Jquery Validate -->
    <script src="{{ asset('inspinia') }}/js/plugins/validate/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
    <script>
       function removeSpaces(string){
        string = string.replace(/\ /g,"_");
        return string;
       }
    </script>
    <script>
        $(document).ready(function(){
            $("#wizard").steps();
            $("#form").steps({
                bodyTag: "fieldset",
                onStepChanging: function (event, currentIndex, newIndex)
                {
                    // Always allow going backward even if the current step contains invalid fields!
                    if (currentIndex > newIndex)
                    {
                        return true;
                    }

                    // Forbid suppressing "Warning" step if the user is to young
                    if (newIndex === 3 && Number($("#age").val()) < 18)
                    {
                        return false;
                    }

                    var form = $(this);

                    // Clean up if user went backward before
                    if (currentIndex < newIndex)
                    {
                        // To remove error styles
                        $(".body:eq(" + newIndex + ") label.error", form).remove();
                        $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
                    }

                    // Disable validation on fields that are disabled or hidden.
                    form.validate().settings.ignore = ":disabled,:hidden";

                    // Start validation; Prevent going forward if false
                    return form.valid();
                },
                onStepChanged: function (event, currentIndex, priorIndex)
                {
                    // Suppress (skip) "Warning" step if the user is old enough.
                    if (currentIndex === 2 && Number($("#age").val()) >= 18)
                    {
                        $(this).steps("next");
                    }

                    // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
                    if (currentIndex === 2 && priorIndex === 3)
                    {
                        $(this).steps("previous");
                    }
                },
                onFinishing: function (event, currentIndex)
                {
                    var form = $(this);

                    // Disable validation on fields that are disabled.
                    // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
                    form.validate().settings.ignore = ":disabled";

                    // Start validation; Prevent form submission if false
                    return form.valid();
                },
                onFinished: function (event, currentIndex)
                {
                    var form = $(this);

                    // Submit form input
                    form.submit();
                }
            }).validate({
                        errorPlacement: function (error, element)
                        {
                            element.before(error);
                        },
                        rules: {
                            password_confirmation: {
                                equalTo: "#password"
                            }
                        }
                    });
       });
    </script>
</body>

</html>

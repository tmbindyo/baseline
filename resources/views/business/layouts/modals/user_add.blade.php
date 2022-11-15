<div class="modal inmodal" id="userRegistration" tabindex="-1" role="dialog" aria-labelledby="tagRegistrationLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="fa fa-user modal-icon"></i>
                <h4 class="modal-title">User Registration</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('business.user.store',$institution->portal) }}" autocomplete="off" class="form-horizontal form-label-left">
                    @csrf

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-12">
                            <div class="has-warning">
                                <input type="email" id="email" name="email" required="required" placeholder="Email" class="form-control input-lg">
                                <i>user email</i>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="has-warning">
                                <input type="text" id="first_name" name="first_name" required="required" placeholder="First Name" class="form-control input-lg">
                                <i>first name</i>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="has-warning">
                                <input type="text" id="last_name" name="last_name" required="required" placeholder="Last Name" class="form-control input-lg">
                                <i>last name</i>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="has-warning">
                                <input type="text" id="phone_number" name="phone_number" required="required" placeholder="Phone Number" class="form-control input-lg">
                                <i>phone number</i>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="has-warning">
                                <select name="role" data-placeholder="Choose a role..." class="chosen-select"  tabindex="2">
                                    <option></option>
                                    @foreach($roles as $role)
                                        <option value="{{encrypt($role->id)}}">{{str_replace($institution->portal.' ', "", $role->name)}}</option>
                                    @endforeach()
                                </select>
                                <i>role</i>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="has-warning">
                                <input type="password" id="password" name="password" required="required" class="form-control input-lg">
                                <i>password</i>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="has-warning">
                                <input type="password" id="password_confirmation" name="password_confirmation" required="required" class="form-control input-lg">
                                <span id='message'></span>
                                <i>confirm password</i>
                            </div>
                        </div>
                    </div>




{{--
                    <br>
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
                    </div> --}}

                    <hr>

                    <div class="text-center">
                        <button type="submit" class="btn btn-block btn-outline btn-lg btn-success mt-4">{{ __('Save') }}</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

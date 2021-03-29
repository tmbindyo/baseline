<div class="modal inmodal" id="agentRegistration" tabindex="-1" role="dialog" aria-labelledby="tagRegistrationLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="fa fa-user modal-icon"></i>
                <h4 class="modal-title">User Registration</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.agent.store') }}" autocomplete="off" class="form-horizontal form-label-left">
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
                                <i>email</i>
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
                        <div class="col-md-6">
                            <div class="has-warning">
                                <input type="text" id="id_number" name="id_number" required="required" placeholder="First Name" class="form-control input-lg">
                                <i>ID Number</i>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="has-warning">
                                <input type="text" id="kra_pin" name="kra_pin" required="required" placeholder="Last Name" class="form-control input-lg">
                                <i>kra_pin</i>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="has-warning">
                                <select name="tier" data-placeholder="Choose a tier..." class="chosen-select"  tabindex="2">
                                    <option></option>
                                    @foreach($tiers as $tier)
                                        <option value="{{$tier->id}}">{{$tier->name}} ({{$tier->amount}})</option>
                                    @endforeach()
                                </select>
                                <i>tier</i>
                            </div>
                        </div>
                    </div>
                    <br>

                    <hr>

                    <div class="text-center">
                        <button type="submit" class="btn btn-block btn-outline btn-lg btn-success mt-4">{{ __('Save') }}</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

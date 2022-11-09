<div class="modal inmodal" id="categoryUserRegistration" tabindex="-1" role="dialog" aria-labelledby="tagRegistrationLabel" aria-hidden="true">
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
                        <div class="col-lg-12">
                            <div class="has-warning">
                                <select name="category" class="select2_category form-control input-lg {{ $errors->has('category') ? ' is-invalid' : '' }}">
                                    <option selected value="{{$category->id}}">{{$category->name}}</option>
                                </select>
                                <i>category</i>
                            </div>
                        </div>
                    </div>

                    <br />

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="has-warning">
                                <select name="user" class="select2_category_user form-control input-lg {{ $errors->has('user') ? ' is-invalid' : '' }}">
                                    <option></option>
                                    @foreach($institutionUsers as $user)
                                        <option value="{{encrypt($user->id)}}">{{str_replace($institution->portal.' ', "", $user->name)}}</option>
                                    @endforeach()
                                </select>
                                <i>product category</i>
                            </div>
                        </div>
                    </div>

                    <br>
                    {{-- <div class="row">
                        <div class="col-lg-12">
                            <div class="has-warning">
                                <select name="user" data-placeholder="Choose a user..." class="chosen-select"  tabindex="2">
                                    <option></option>
                                    @foreach($institutionUsers as $user)
                                        <option value="{{encrypt($user->id)}}">{{str_replace($institution->portal.' ', "", $user->name)}}</option>
                                    @endforeach()
                                </select>
                                <i>user</i>
                            </div>
                        </div>
                    </div> --}}





                    {{-- <div class="row">
                        <div class="col-lg-12">
                            <div class="has-warning">
                                <select name="category" data-placeholder="Choose a category..." class="chosen-select"  tabindex="2">
                                    <option></option>
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                </select>
                                <i>category</i>
                            </div>
                        </div>
                    </div> --}}
                    {{-- <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="has-warning">
                                <select name="user" data-placeholder="Choose a user..." class="chosen-select"  tabindex="2">
                                    <option></option>
                                    @foreach($institutionUsers as $user)
                                        <option value="{{encrypt($user->id)}}">{{str_replace($institution->portal.' ', "", $user->name)}}</option>
                                    @endforeach()
                                </select>
                                <i>user</i>
                            </div>
                        </div>
                    </div> --}}
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

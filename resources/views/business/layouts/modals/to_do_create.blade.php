{{--<div class="modal inmodal" id="toDoRegistration" tabindex="-1" role="dialog" aria-labelledby="toDoRegistrationLabel" aria-hidden="true">--}}
<div class="modal inmodal fade" id="toDoRegistration" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="fa fa-list modal-icon"></i>
                <h4 class="modal-title">To-Do Registration</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('business.to.do.store',$institution->portal) }}" autocomplete="off" class="form-horizontal form-label-left">
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


                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="has-warning">
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                                <input type="text" id="name" name="name" required="required" placeholder="To Do" class="form-control input-lg {{ $errors->has('name') ? ' is-invalid' : '' }}">
                                <i>task</i>
                            </div>
                        </div>
                    </div>
                    <br>

                    <div class="row">

                        <div class="col-md-5">
                            <div class="has-warning" id="data_1">
                                @if ($errors->has('start_date'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('start_date') }}</strong>
                                    </span>
                                @endif
                                <div class="input-group date">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                    <input type="text" name="start_date" id="start_date" class="form-control input-lg {{ $errors->has('start_date') ? ' is-invalid' : '' }}" required>
                                </div>
                                <i>start date.</i>
                                <span id="inputSuccess2Status4" class="sr-only">(success)</span>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="has-warning" id="data_1">
                                @if ($errors->has('end_date'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('end_date') }}</strong>
                                    </span>
                                @endif
                                <div class="input-group date">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                    <input type="text" name="end_date" id="end_date" disabled="disabled" class="form-control input-lg {{ $errors->has('end_date') ? ' is-invalid' : '' }}">
                                </div>
                                <i>end date.</i>
                                <span id="inputSuccess2Status4" class="sr-only">(success)</span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="has-warning">
                                @if ($errors->has('is_end_date'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('is_end_date') }}</strong>
                                    </span>
                                @endif
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input name="is_end_date" id="is_end_date" type="checkbox" class="enableEndDate {{ $errors->has('is_end_date') ? ' is-invalid' : '' }}" />
                                    <i>end date</i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="has-warning">
                                @if ($errors->has('start_time'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('start_time') }}</strong>
                                    </span>
                                @endif
                                <div class="input-group clockpicker" data-autoclose="true">
                                    <span class="input-group-addon">
                                    <span class="fa fa-clock-o"></span>
                                    </span>
                                    <input type="text" name="start_time" data-mask="99:99" id="start_time" class="form-control input-lg {{ $errors->has('start_time') ? ' is-invalid' : '' }}" required>
                                </div>
                                <i>start time.</i>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="has-warning" id="data_1">
                                @if ($errors->has('end_time'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('end_time') }}</strong>
                                    </span>
                                @endif
                                <div class="input-group clockpicker" data-autoclose="true">
                                    <span class="input-group-addon">
                                    <span class="fa fa-clock-o"></span>
                                    </span>
                                    <input type="text" name="end_time" disabled data-mask="99:99" id="end_time" class="form-control input-lg {{ $errors->has('end_time') ? ' is-invalid' : '' }}" value="09:30">
                                </div>
                                <i>end time.</i>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="has-warning">
                                @if ($errors->has('is_end_time'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('is_end_time') }}</strong>
                                    </span>
                                @endif
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input name="is_end_time" id="is_end_time" type="checkbox" class="enableEndTime {{ $errors->has('is_end_time') ? ' is-invalid' : '' }}" />
                                    <i>end time.</i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="has-warning">
                                @if ($errors->has('notes'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('notes') }}</strong>
                                    </span>
                                @endif
                                <textarea id="notes" rows="5" name="notes" class="resizable_textarea form-control input-lg {{ $errors->has('notes') ? ' is-invalid' : '' }}" required="required" placeholder="Notes..."></textarea>
                            </div>
                        </div>
                    </div>
                    <br>


                    @isset($category)
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="has-warning">
                                    @if ($errors->has('is_category'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('is_category') }}</strong>
                                    </span>
                                    @endif
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input name="is_category" type="checkbox" class="js-switch_2 {{ $errors->has('is_category') ? ' is-invalid' : '' }}" checked />
                                        <br>
                                        <i>Check if it belongs to a Account.</i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="has-warning">
                                    @if ($errors->has('category'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                    @endif
                                    <select name="category" data-placeholder="Choose an category..." class="chosen-select form-control input-lg {{ $errors->has('category') ? ' is-invalid' : '' }}">
                                        <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                    </select>
                                    <i>What category does the to do belong to</i>
                                </div>
                            </div>
                        </div>
                        <br>
                    @endisset

                    <br>
                    <hr>
                    <br>


                    <div class="text-center">
                        <button type="submit" class="btn btn-block btn-outline btn-lg btn-success mt-4">{{ __('Save') }}</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

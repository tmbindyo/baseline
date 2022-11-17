<div class="modal inmodal" id="toDoEdit" tabindex="-1" role="dialog" aria-labelledby="toDoEditLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="fa fa-list modal-icon"></i>
                <h4 class="modal-title">Edit To-Do</h4>
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

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="has-warning">
                                    <input type="text" id="edit-task" name="edittask" required="required" placeholder="Task" class="form-control input-lg">
                                    <i>task</i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="has-warning" id="data_1">
                                @if ($errors->has('edit-start_date'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('edit-start_date') }}</strong>
                                    </span>
                                @endif
                                <div class="input-group date">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                    <input type="text" name="edit-start_date" id="edit-start_date" class="form-control input-lg {{ $errors->has('edit-start_date') ? ' is-invalid' : '' }}" required>
                                </div>
                                <i>start date.</i>
                                <span id="inputSuccess2Status4" class="sr-only">(success)</span>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="has-warning" id="data_1">
                                @if ($errors->has('edit-end_date'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('edit-end_date') }}</strong>
                                    </span>
                                @endif
                                <div class="input-group date">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                    <input type="text" name="edit-end_date" id="edit-end_date" disabled="disabled" class="form-control input-lg {{ $errors->has('edit-end_date') ? ' is-invalid' : '' }}">
                                </div>
                                <i>end date.</i>
                                <span id="inputSuccess2Status4" class="sr-only">(success)</span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="has-warning">
                                @if ($errors->has('edit-is_end_date'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('edit-is_end_date') }}</strong>
                                    </span>
                                @endif
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input name="edit-is_end_date" id="edit-is_end_date" type="checkbox" class="enableEndDate {{ $errors->has('edit-is_end_date') ? ' is-invalid' : '' }}" />
                                    <i>end date</i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-md-5">
                            <div class="has-warning">
                                @if ($errors->has('edit-start_time'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('edit-start_time') }}</strong>
                                    </span>
                                @endif
                                <div class="input-group clockpicker" data-autoclose="true">
                                    <span class="input-group-addon">
                                    <span class="fa fa-clock-o"></span>
                                    </span>
                                    <input type="text" name="edit-start_time" data-mask="99:99" id="edit-start_time" class="form-control input-lg {{ $errors->has('edit-start_time') ? ' is-invalid' : '' }}" required>
                                </div>
                                <i>start time.</i>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="has-warning" id="data_1">
                                @if ($errors->has('edit-end_time'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('edit-end_time') }}</strong>
                                    </span>
                                @endif
                                <div class="input-group clockpicker" data-autoclose="true">
                                    <span class="input-group-addon">
                                    <span class="fa fa-clock-o"></span>
                                    </span>
                                    <input type="text" name="edit-end_time" disabled data-mask="99:99" id="edit-end_time" class="form-control input-lg {{ $errors->has('edit-end_time') ? ' is-invalid' : '' }}" value="09:30">
                                </div>
                                <i>end time.</i>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="has-warning">
                                @if ($errors->has('edit-is_end_time'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('edit-is_end_time') }}</strong>
                                    </span>
                                @endif
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input name="edit-is_end_time" id="edit-is_end_time" type="checkbox" class="enableEndTime {{ $errors->has('edit-is_end_time') ? ' is-invalid' : '' }}" />
                                    <i>end time.</i>
                                </div>
                            </div>
                        </div>
                    </div>


                    <br>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="has-warning">
                                    <textarea id="edit-notes" rows="5" name="edit-notes" class="resizable_textarea form-control input-lg" required="required" placeholder="Notes..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ln_solid"></div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-block btn-outline btn-lg btn-success mt-4">{{ __('Save') }}</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

@extends('layouts.app', ['title' => __('Order Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Add Order')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Order Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('order.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('order.store') }}" autocomplete="off">
                            @csrf
                            
                            <h6 class="heading-small text-muted mb-4">{{ __('Order information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-description">{{ __('Description') }}</label>
                                    <input type="text" name="description" id="input-description" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="{{ __('Description') }}" value="{{ old('description') }}" required>

                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('phylum_class') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-phylum_class">{{ __('Order type:') }}</label>
                                    <select name="phylum_class" class="form-control form-control-alternative {{ $errors->has('phylum_class') ? ' is-invalid' : '' }}" value="{{ old('phylum_class') }}" required>

                                        @foreach($phylum_classes as $phylum_class)
                                            <option value="{{ $phylum_class->id }}">{{ $phylum_class->name }}</option>
                                        @endforeach

                                    </select>
                                    @if ($errors->has('phylum_class'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phylum_class') }}</strong>
                                        </span>
                                    @endif
                                </div> 
                                

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection
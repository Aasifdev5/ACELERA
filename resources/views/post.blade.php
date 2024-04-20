@extends('master')
@section('title')
 {{ __('Crear Proyecto') }}
@endsection
@section('content')

    <div class="container" style="margin-bottom: 50px">
        <div class="row">
            <div class="col-md-10 col-xs-12">

                <form action="{{ url('ProjectStore') }}" enctype="multipart/form-data" id="startCampaignForm" class="form-horizontal" method="post">
                    @if (Session::has('success'))
                            <div class="alert alert-success" style="background-color: green;">
                                <p style="color: #fff;">{{ session::get('success') }}</p>
                            </div>
                        @endif
                        @if (Session::has('fail'))
                            <div class="alert alert-danger" style="background-color: red;">
                                <p style="color: #fff;">{{ session::get('fail') }}</p>
                            </div>
                        @endif
                    @csrf

                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <i class="fa fa-info-circle"></i> {{ __(' Información Disponible de Función') }}
                        </div>
                    </div>
                    <div class="form-group  {{ $errors->has('category') ? 'has-error' : '' }}">
                        <label for="category" class="col-sm-4 control-label">{{ __('Categoría') }} <span
                                class="field-required">*</span></label>
                        <div class="col-sm-8">
                            <select class="form-control select2" name="category">
                                <option value="">{{ __('Selecciona una Categoría') }}</option>
                                @foreach ($category as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            {!! $errors->has('category') ? '<p class="help-block">' . $errors->first('category') . '</p>' : '' !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                        <label for="title" class="col-sm-4 control-label">{{ __('Título') }} <span
                                class="field-required">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="title" value="{{ old('title') }}"
                                name="title" placeholder="Title">
                            {!! $errors->has('title') ? '<p class="help-block">' . $errors->first('title') . '</p>' : '' !!}

                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('short_description') ? 'has-error' : '' }}">
                        <label for="short_description" class="col-sm-4 control-label">{{ __('Descripción Corta') }}</label>
                        <div class="col-sm-8">
                            <textarea name="short_description" class="form-control" rows="3">{{ old('short_description') }}</textarea>
                            {!! $errors->has('short_description')
                                ? '<p class="help-block">' . $errors->first('short_description') . '</p>'
                                : '' !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                        <label for="description" class="col-sm-3 control-label">{{ __('Descripción') }} <span
                                class="field-required">*</span></label>

                        <div class="col-sm-12">
                            <textarea name="description" class="form-control description" rows="8">{{ old('description') }}</textarea>
                            {!! $errors->has('description') ? '<p class="help-block">' . $errors->first('description') . '</p>' : '' !!}
                            <p class="text-info"> {{ __('Describe tu proyecto en detalle') }}</p>
                        </div>
                    </div>


                    <div class="alert alert-info">
                        <h3> <i class="fa fa-money"></i> {{ __('Obtendrás el 80% del Total Recaudado') }}</h3>
                    </div>
                    <div class="form-group {{ $errors->has('goal') ? 'has-error' : '' }}">
                        <label for="goal" class="col-sm-4 control-label">{{ __('Monto a recaudar') }} <span
                                class="field-required">*</span></label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="goal" value="{{ old('goal') }}"
                                name="goal" placeholder="Monto a recaudar">
                            {!! $errors->has('goal') ? '<p class="help-block">' . $errors->first('goal') . '</p>' : '' !!}
                        </div>
                    </div>

                    {{-- <div class="form-group {{ $errors->has('recommended_amount') ? 'has-error' : '' }}">
                        <label for="recommended_amount" class="col-sm-4 control-label">{{ __('Monto Recomendado') }}</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="recommended_amount"
                                value="{{ old('recommended_amount') }}" name="recommended_amount"
                                placeholder="Recommended Amount">
                            {!! $errors->has('recommended_amount')
                                ? '<p class="help-block">' . $errors->first('recommended_amount') . '</p>'
                                : '' !!}
                        </div>
                    </div> --}}


                    {{-- <div class="form-group {{ $errors->has('amount_prefilled') ? 'has-error' : '' }}">
                        <label for="amount_prefilled" class="col-sm-4 control-label">{{ __('Monto Precargado') }}</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="amount_prefilled"
                                value="{{ old('amount_prefilled') }}" name="amount_prefilled"
                                placeholder="Amount Prefilled">
                            {!! $errors->has('amount_prefilled')
                                ? '<p class="help-block">' . $errors->first('amount_prefilled') . '</p>'
                                : '' !!}
                            <p class="text-info"> {{ __('Texto de Información de Monto Precargado') }}</p>
                        </div>
                    </div> --}}

                    <div class="form-group {{ $errors->has('end_method') ? 'has-error' : '' }}">
                        <label for="end_method" class="col-sm-4 control-label">{{ __('Método de Finalización de Campaña') }}</label>
                        <div class="col-sm-8">
                            <label>
                                <input type="radio" name="end_method" value="goal_achieve"
                                    @if (!old('end_method') || old('end_method') == 'goal_achieve') checked="checked" @endif> {{ __('Después de Alcanzar la Meta') }}
                            </label> <br />

                            <label>
                                <input type="radio" name="end_method" value="end_date"
                                    @if (old('end_method') == 'end_date') checked="checked" @endif> {{ __('Después de la Fecha de Finalización') }}
                            </label> <br />

                            {!! $errors->has('end_method') ? '<p class="help-block">' . $errors->first('end_method') . '</p>' : '' !!}

                        </div>
                    </div>

                    <div class="custom-form-group mb-25">
                        <label for="image" class="text-lg-right text-black mb-2">
                            {{ __('Imagen') }} </label>
                        <div class="upload-img-box mb-25">
                            <img src="">
                            <input type="file" name="image" id="image" accept="image/*"
                                onchange="previewFile(this)">
                            <div class="upload-img-box-icon">
                                <i class="fa fa-camera"></i>
                                <p class="m-0">{{ __('Image') }}</p>
                            </div>
                        </div>
                        @if ($errors->has('image'))
                            <span class="text-danger"><i class="fas fa-exclamation-triangle"></i>
                                {{ $errors->first('image') }}</span>
                        @endif
                        <p>{{ __('Archivos de Imagen Aceptados') }}: PNG <br> {{ __('Tamaño Recomendado') }}: 60 x
                            60 (1MB)</p>
                    </div>



                    <div class="form-group {{ $errors->has('country_id') ? 'has-error' : '' }}">
                        <label for="country_id" class="col-sm-4 control-label">{{ __('Departamento') }} <span
                                class="field-required">*</span></label>
                        <div class="col-sm-8">
                            <select class="form-control select2" name="country_id">
                                <option value="">{{ __('Selecciona un departamento') }}</option>
                                <option value="Santa Cruz">Santa Cruz</option>
                                <option value="Beni">Beni</option>
                                <option value="La Paz">La Paz</option>
                                <option value="Oruro">Oruro</option>
                                <option value="Cochabamba">Cochabamba</option>
                                <option value="Potosi">Potosi</option>
                                <option value="Pando">Pando</option>
                                <option value="Chuquisaca">Chuquisaca</option>
                                <option value="Tarija">Tarija</option>
                            </select>

                            {!! $errors->has('country_id') ? '<p class="help-block">' . $errors->first('country_id') . '</p>' : '' !!}
                        </div>
                    </div>


                    <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                        <label for="address" class="col-sm-4 control-label">{{ __('Escribe tu dirección') }}</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="address" value="{{ old('address') }}"
                                name="address" placeholder="Escribe tu dirección">
                            {!! $errors->has('address') ? '<p class="help-block">' . $errors->first('address') . '</p>' : '' !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('start_date') ? 'has-error' : '' }}">
                        <label for="start_date" class="col-sm-4 control-label">{{ __('Fecha de Inicio') }}</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="start_date" value="{{ old('start_date') }}"
                                name="start_date" placeholder="Start Date">
                            {!! $errors->has('start_date') ? '<p class="help-block">' . $errors->first('start_date') . '</p>' : '' !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('end_date') ? 'has-error' : '' }}">
                        <label for="end_date" class="col-sm-4 control-label">{{ __('Fecha de Finalización') }}</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="end_date" value="{{ old('end_date') }}"
                                name="end_date" placeholder="End Date">
                            {!! $errors->has('end_date') ? '<p class="help-block">' . $errors->first('end_date') . '</p>' : '' !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            <button type="submit" class="btn btn-primary">{{ __('Enviar Nueva Campaña') }}</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection

@extends('master')
@section('title')
Edit Appointment
@endsection
@section('content')
<main>
    <div class="container mt-5 mb-5">
        <div class="text-center">
            <h1 class="main-title home">Editar cita </h1>
        </div>

    </div>
    <div class="container mt-5 mb-5 loginpanel">
        <form action="{{url('UpdateAppointment')}}" method="post" autocomplete="off">
            @if(Session::has('success'))
            <div class="alert alert-success" style="background-color: green;">
                <p style="color: #fff;">{{session::get('success')}}</p>
            </div>
            @endif
            @if(Session::has('fail'))
            <div class="alert alert-danger" style="background-color: red;">
                <p style="color: #fff;">{{session::get('fail')}}</p>
            </div>
            @endif
            @csrf
            <input type="hidden" name="id" value="{{$Appointment->id}}">
            <div class="form-row">
                <div class="form-group col">
                    <label class="">Estado</label>
                    <select name="status" id="" class="form-control">
                        <option value="">Por favor seleccione estado</option>
                        <option value="pending" @if($Appointment->status=="pending") selected @endif>Pendiente</option>
                        <option value="scheduled" @if($Appointment->status=="scheduled") selected @endif>Cronograma</option>
                        <option value="rejected" @if($Appointment->status=="rejected") selected @endif>Rechazar</option>


                    </select>
                    <span class="text-danger" style="color:red;">@error ('status'){{$message}}@enderror</span>

                </div>
            </div>


            <!---->
            <button type="submit" class="btn btn-primary btn-block">Actualizar</button>
        </form>


    </div>
</main>

@endsection

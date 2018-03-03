@extends('app')

@section('content')

<div class="card">
    <div class="card-body card-padding">
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <div class="card-header">
            <h2>Usuarios por zonas</h2>
            <br>


            <!--UBICACION-->
                <p class="c-black f-500 m-b-5 m-t-20">Informacion de ubicacion</p>
                <small>Ubicacion del usuario</small><br><br>
               

                <div class="row">
                  <div class="col-sm-12"> 
                            <small>Zonas</small><br><br>
                             @foreach($zone_types as $zonetype)
                             <label class="radio radio-inline m-r-20">
                                <input type="radio" class="zone_type" value="{{$zonetype->id}}" name="zone_type" checked>
                                <i class="input-helper"></i>
                                {{$zonetype->name_zone_type}}
                            </label>
                            @endforeach
                          
                  </div>
                 
                   
                   <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                    
                    <div class="col-sm-3">
                        <select name="departamento" id="departamento" class="chosen" data-placeholder="Departamento...">
                            <option></option>
                            @foreach($departments as $depart)
                                <option value="{{$depart-> id}}">{{$depart->name_department}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-3">
                        <select name="ciudad" id="ciudad" class="chosen" data-placeholder="Ciudad...">
                            <option></option>
                        </select>

                    </div>
                    <div id="preloader" style="display: none;" class="preloader pl-lg">
                                <svg class="pl-circular" viewBox="25 25 50 50">
                                    <circle class="plc-path" cx="50" cy="50" r="20" />
                                </svg>
                    </div>
                    
                </div>
        </div>

        <table id="table_list" class="table_list display table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                  <th>ID</th>
                  <th>USUARIO</th>
                  <th>IDENTIFICACION</th>
                  <th>DIRECCION</th>
                  <th>TELEFONO</th>
                  <th>TIPO</th>
                   <th>OPCIONES</th>
                </thead>
                 <tbody id="content_user_zones">
                </tbody>
              </table>
    </div>      
</div>

<!-- Register -->
 
@endsection


@section('footer')   

   <script src="{{ URL::asset('scripts/register_user.js') }}"></script>
   
@endsection  
























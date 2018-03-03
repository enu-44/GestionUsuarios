@extends('app')
@section('content')
<div class="card">
                        <div class="card-header">
                            <h2>Lista de usuarios registrados <small>Asegúrese de que el atributo de datos  esté establecido en el encabezado de una columna.</small></h2>
                           
                        </div>
                        <div class="card-header">
                         <table id="table_list" class="table_list display table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                              <th>ID</th>
                              <th>USUARIO</th>
                              <th>IDENTIFICACION</th>
                              <th>DIRECCION</th>
                              <th>TELEFONO</th>
                              <th>TIPO</th>
                              <th>REFERENTES</th>
                              <th>OPCIONES</th>
                            </thead>
                             <tbody>

                                @foreach($referentes as $user)
                                 @include('user.partials.list_user_partial')
                                @endforeach
                            </tbody>
                          </table>
                        </div>
                    </div>
                </div>
            </section>
@endsection

@section('footer')   
  <script src="{{ URL::asset('scripts/register_user.js') }}"></script>
@endsection  
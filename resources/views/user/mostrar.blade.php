   
@extends('app')
@section('content')
<div class="card">
        <div class="card-header">
            <h2>Agregar Usuarios</h2>
        </div>
        <div class="card-body card-padding">
            <div class="btn-demo">
                <a href="{{url('validado/user/register-user') }}" class="btn btn-primary btn-icon"><i class="zmdi zmdi-account-add"></i></a>
            </div>
        </div>
</div>



<div class="card">
    <div class="card-header">
        <h2>Lista de usuarios registrados <small>Asegúrese de que el atributo de datos  esté establecido en el encabezado de una columna.</small></h2>
        @if (Session::has('adduser'))
            <div class="alert alert-success">
                <strong>Whoops!</strong> Notificacion.<br><br>
                {{Session::get('adduser')}}
            </div>                 
        @endif

        @if (Session::has('deleteuser'))
            <div class="alert alert-danger">
                <strong>Whoops!</strong> Notificacion.<br><br>
                {{Session::get('deleteuser')}}
            </div>
        @endif

        @if (Session::has('updateuser'))
            <div class="alert alert-success">
                <strong>Whoops!</strong> Notificacion.<br><br>
                {{Session::get('updateuser')}}
            </div>
        @endif
    </div>

                        <!--<table id="data-table-command" class="table table-striped table-vmiddle">
                            <thead>
                                <tr>
                                    <th data-column-id="id" data-type="numeric">ID</th>
                                    <th data-column-id="usuario" data-order="asc">USUARIO</th>
                                    <th data-column-id="identificacion" >IDENTIFICACION</th>
                                    <th data-column-id="direccion" >DIRECCION</th>
                                    <th data-column-id="telefono" >TELEFONO</th>
                                    <th data-column-id="tipo" >TIPO</th>
                                    <th data-column-id="count" >REFERENTES</th>

                                    <th data-column-id="commands" data-formatter="commands" data-sortable="false">OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}} {{$user->last_name}}</td>
                                    <td>{{$user->identificacion}} </td>
                                    <td>{{$user->direccion}} </td>
                                    <td>{{$user->phone1}} </td>
                                    <td>{{$user->name_user_type}} </td>
                                    <td>{{Auth::user()->vericateCountHaveReferentes($user->id)}} </td>
                                </tr>
                                @endforeach

                              
                            </tbody>
                        </table>-->

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

                                @foreach($users as $user)
                                 @include('user.partials.list_user_partial')
                                @endforeach

                              
                            </tbody>
                          </table>

                        </div>




</div>


@endsection


@section('footer')   


  <script src="{{ URL::asset('scripts/register_user.js') }}"></script>
  <script type="text/javascript">
            $(document).ready(function(){


/*
                //Basic Example
                $("#data-table-basic").bootgrid({
                    css: {
                        icon: 'zmdi icon',
                        iconColumns: 'zmdi-view-module',
                        iconDown: 'zmdi-expand-more',
                        iconRefresh: 'zmdi-refresh',
                        iconUp: 'zmdi-expand-less'
                    },
                });
                
                //Selection
                $("#data-table-selection").bootgrid({
                    css: {
                        icon: 'zmdi icon',
                        iconColumns: 'zmdi-view-module',
                        iconDown: 'zmdi-expand-more',
                        iconRefresh: 'zmdi-refresh',
                        iconUp: 'zmdi-expand-less'
                    },
                    selection: true,
                    multiSelect: true,
                    rowSelect: true,
                    keepSelection: true
                });
                
                //Command Buttons
                $("#data-table-command").bootgrid({
                    css: {
                        icon: 'zmdi icon',
                        iconColumns: 'zmdi-view-module',
                        iconDown: 'zmdi-expand-more',
                        iconRefresh: 'zmdi-refresh',
                        iconUp: 'zmdi-expand-less'
                    },
                    formatters: {
                        "commands": function(column, row) {

                            return "<div class=\"form-inline\"> <div class=\"form-group\">  <a href=\"/validado/user/view-referentes/" + row.id + "\" class=\"btn btn-warning btn-icon waves-effect waves-circle waves-float\"><span class=\"zmdi zmdi-eye\"></span></a> </div><div class=\"form-group\"> <form class=\"mb-2\" role=\"form\" method=\"POST\" action=\"{{ url('/validado/user/edit-user') }}\"> <input type=\"hidden\" id=\"_token\" name=\"_token\" value=\"{{ csrf_token() }}\"><input type=\"hidden\" id=\"id\" name=\"id\" value=\"" + row.id + "\"><button  type=\"submit\" class=\"btn btn-info btn-icon waves-effect waves-circle\" data-row-id=\"" + row.id + "\"><span class=\"zmdi zmdi-edit\"></span></button> " + 
                                "</form></div><div class=\"form-group\"><form class=\"mb-2\" role=\"form\" method=\"POST\" action=\"{{ url('/validado/user/delete-user') }}\"> <input type=\"hidden\" id=\"_token\" name=\"_token\" value=\"{{ csrf_token() }}\"><input type=\"hidden\" id=\"id\" name=\"id\" value=\"" + row.id + "\"> " + 
                                "<button type=\"submit\" class=\"btn btn-danger btn-icon waves-effect waves-circle waves-float\" data-row-id=\"" + row.id + "\"><span class=\"zmdi zmdi-delete\"></span></button></form></div></div>";
                          


                        }
                    }
                });*/
            });
            function alertpersonality(id){

               // alert("hola: "+id);

            }

        </script>


        @if (Session::has('adduser'))    
        <script type="text/javascript">
            $(document).ready(function(){
              load("success","{{Session::get('adduser')}}");
            });
        </script>
        @endif

        @if (Session::has('updateuser'))
          <script type="text/javascript">
            $(document).ready(function(){
              load("success","{{Session::get('updateuser')}}");
            });
        </script>  
        @endif

         @if (Session::has('deleteuser'))
          <script type="text/javascript">
            $(document).ready(function(){
              load("success"," {{Session::get('deleteuser')}}");
            });
        </script>  
        @endif

@endsection  

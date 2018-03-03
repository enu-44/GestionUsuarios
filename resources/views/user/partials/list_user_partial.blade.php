<tr>
    <td>{{$user->id}}</td>
    <td>{{$user->name}} {{$user->last_name}}</td>
    <td>{{$user->identificacion}} </td>
    <td>{{$user->direccion}} </td>
    <td>{{$user->phone1}} </td>
    <td>{{$user->name_user_type}} </td>
    <td>{{Auth::user()->vericateCountHaveReferentes($user->id)}} </td>
    <td>
        <div class="form-inline">
            <div class="form-group">  
                <a href="/validado/user/view-referentes/{{$user->id}}" class="btn btn-warning btn-icon waves-effect waves-circle waves-float">
                    <span class="zmdi zmdi-eye"></span>
                </a> 
            </div>
            <div class="form-group"> 
                <form class="mb-2" role="form"  method="POST" action="{{ url('/validado/user/edit-user') }}"> 
                    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" id="id" name="id" value="{{$user->id}}" >
                    <button  type="submit" class="btn btn-info btn-icon waves-effect waves-circle">
                        <span class="zmdi zmdi-edit"></span>
                    </button>
                </form>
            </div>
            <div class="form-group">
                <form class="mb-2" role="form"  method="POST" action="{{ url('/validado/user/delete-user') }}"> 
                    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" id="id" name="id" value="{{$user->id}}">  
                    <button type="submit" onclick="confirmFunction('eliminar')" class="delete_user btn btn-danger btn-icon waves-effect waves-circle waves-float">
                        <span class="zmdi zmdi-delete"></span>
                    </button>
                </form>
            </div>
        </div>
    </td>
</tr>
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
        <form  role="form" method="POST" action="{{ url('/validado/user/update-user') }}">
            <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" id="id" name="id" value="{{ $user_selected->id }}">
           <div class="card-header">
                <h2>Actualizar Usuario</h2>
            </div>
            @include('user.partials.form_user_update')
        </form>
    </div>      
</div>

<!-- Register -->
 
@endsection
@section('footer')   

   <script src="{{ URL::asset('scripts/register_user.js') }}"></script>
   <script type="text/javascript">

  $('.date-picker').datetimepicker({
    format: 'YYYY-MM-DD'
  });

   </script>
@endsection  

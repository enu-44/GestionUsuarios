@extends('layouts.master_login')
@section('content')

<!-- Register -->
<div class="l-block toggled" id="l-register">

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

      

			<form  role="form" method="POST" action="/auth/register">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="lb-header palette-Blue bg">
                    <i class="zmdi zmdi-account-circle"></i>
                   Crear una cuenta
                </div>

                <div class="lb-body">
                    <div class="form-group fg-float">
                        <div class="fg-line">
                            <input type="text" name="name" value="{{ old('name') }}"  class="input-sm form-control fg-input">
                            <label class="fg-label">Nombre</label>
                        </div>
                    </div>

                    <div class="form-group fg-float">
                        <div class="fg-line">
                            <input type="text" name="last_name" value="{{ old('last_name') }}"  class="input-sm form-control fg-input">
                            <label class="fg-label">Apellido</label>
                        </div>
                    </div>

                    <div class="form-group fg-float">
                        <div class="fg-line">
                            <input type="text" name="identificacion" value="{{ old('identificacion') }}"  class="input-sm form-control fg-input">
                            <label class="fg-label">Identificacion</label>
                        </div>
                    </div>

                    <div class="form-group fg-float">
                        <div class="fg-line">
                            <input type="email"  name="email" value="{{ old('email') }}" class="input-sm form-control fg-input">
                            <label class="fg-label">Email Address</label>
                        </div>
                    </div>

                    <div class="form-group fg-float">
                        <div class="fg-line">
                            <input type="password" name="password" class="input-sm form-control fg-input">
                            <label class="fg-label">Password</label>
                        </div>
                    </div>


					<div class="form-group fg-float">
                        <div class="fg-line">
                            <input type="password" name="password_confirmation" class="input-sm form-control fg-input">
                            <label class="fg-label">Confirm Password</label>
                        </div>
                    </div>
<!--
                    <div class="checkbox m-b-30">
                        <label>
                            <input type="checkbox" value="">
                            <i class="input-helper"></i>
                            Accept the license agreement
                        </label>
                    </div>-->

                    <button type="submit" class="btn palette-Blue bg">Crear Cuenta</button>

                    <div class="m-t-30">
                        <a href="/" data-bg="teal" class="palette-Blue text d-block m-b-5" >Ya tengo una cuenta?</a>

                      <!--  <a data-block="#l-forget-password" data-bg="purple" href="" class="palette-Blue text">Forgot password?</a>-->
                    </div>
                </div>
			</form>
</div>

            
@endsection
@section('footer')   

<script type="text/javascript">
   	$(document).ready(function($){
        
        	//  $('#dgdfg').click();
			$( ".login" ).css( "background-color","#42a5f5" );  
    	}); 
</script>


@endsection  


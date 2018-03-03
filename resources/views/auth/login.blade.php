@extends('layouts.master_login')

@section('content')

<!-- Login -->
<div class="l-block toggled" id="l-login">
                <div class="lb-header palette-Teal bg">
                    <i class="zmdi zmdi-account-circle"></i>
                Iniciar Sesion
                </div>

                <div class="lb-body">

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

					 


           @if(Session::has('verificacion'))
             

               <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                         <strong>Notificacion </strong> {{Session::get('verificacion')}}
                </div>
          @endif

            @if(Session::has('confirmado'))
        
               <div class="alert alert-info alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  <strong>Notificacion </strong>  {{Session::get('confirmado')}}
                </div>

          @endif




					<form role="form" method="POST" action="/auth/login">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
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

						<div class="checkbox m-b-30">
							<label>
								<input type="checkbox" name="remember" >
								<i class="input-helper"></i>
								Recordarme
							</label> 
						</div>

						<button type="submit" class="btn palette-Teal bg">Iniciar Sesion</button>

						<!--	<a href="/password/email">Forgot Your Password?</a>-->

						<div class="m-t-20">
							<a href="/auth/register" class="palette-Teal text d-block m-b-5" >Crear una cuenta</a>
						<!-- <a data-block="#l-forget-password" data-bg="purple" href="" class="palette-Teal text">Forgot password?</a>-->
						</div>
						
					</form>
                </div>
         </div>
@endsection

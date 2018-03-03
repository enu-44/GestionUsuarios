<div class="lb-body">
                <p class=" c-black f-500 m-b-5 m-t-20">Informacion Basica</p><br>
                <div class="row">
                        <!--File 1-->
                        <div class="col-sm-3">
                            <div class="input-group form-group fg-float">
                                 <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                                <div class="fg-line">
                                    <input type="text" name="name" value="{{ old('name') }}"  class="input-sm form-control fg-input">
                                    <label class="fg-label">Nombre</label>
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-3">
                            <div class="input-group form-group fg-float">
                                 <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                                <div class="fg-line">
                                    <input type="text" name="last_name" value="{{ old('last_name') }}"  class="input-sm form-control fg-input">
                                    <label class="fg-label">Apellido</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="input-group form-group fg-float">
                                 <span class="input-group-addon"><i class="zmdi zmdi-accounts"></i></span>
                                <div class="fg-line">
                                    <input type="text" name="identificacion" value="{{ old('identificacion') }}"  class="input-sm form-control fg-input">
                                    <label class="fg-label">Identificacion</label>
                                </div>
                            </div>         
                        </div>

                        <div class="col-sm-3">
                            <div class="input-group form-group fg-float">
                                 <span class="input-group-addon"><i class="zmdi zmdi-pin"></i></span>
                                <div class="fg-line">
                                    <input type="text" name="direccion" value="{{ old('direccion') }}"  class="input-sm form-control fg-input">
                                    <label class="fg-label">Direccion</label>
                                </div>
                            </div>         
                        </div>

                        <div class="col-sm-3">
                                    <div class="input-group form-group fg-float">
                                            <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
                                            <div class="dtp-container fg-line">
                                            <input type='text' name="fecha_nacimiento" class="form-control date-picker" >
                                            <label class="fg-label">Fecha Nacimiento</label>
                                        </div>
                                    </div>
                        </div>


                        <div class="col-sm-3">
                            <div class="input-group form-group fg-float">
                                <span class="input-group-addon"><i class="zmdi zmdi-layers"></i></span>
                                <div class="fg-line">
                                    <input type="text" name="profesion" value="{{ old('profesion') }}"  class="input-sm form-control fg-input">
                                    <label class="fg-label">Profesion</label>
                                </div>
                            </div>         
                        </div>
                        <div class="col-sm-3">
                            <select name="user_type_id" id="user_type_id" class="chosen" data-placeholder="Tipo Usuario...">
                                <option></option>
                            
                                @foreach($usertypes as $type)
                                    <option value="{{$type-> id}}">{{$type->name_user_type}}</option>
                                @endforeach
                            </select>
                        </div>


                     



                </div>  

                <!--REFERENTES-->
                <p class="c-black f-500 m-b-5 m-t-20">Informacion de referencia</p>
                <small>Seleccione la persona por la cual se encuentra referenciada el usuarioa registrar</small>

                <div class="row">
                    <div class="col-sm-4">
                        <select name="referente_id" class="chosen" data-placeholder="Escoja el referente...">
                            <option></option>
                            @foreach($users as $user)
                                <option value="{{$user-> id}}">{{$user->name}} {{$user->last_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


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
                           <!-- <label class="radio radio-inline m-r-20">
                                <input type="radio" class="zone_type" value="urbana" name="zone_type" checked>
                                <i class="input-helper"></i>
                                Urbano
                            </label>

                            <label class="radio radio-inline m-r-20">
                                <input type="radio" class="zone_type" value="rural" name="zone_type" >
                                <i class="input-helper"></i>
                                Rural
                            </label>-->
                    </div>
                    <br> <br>
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
                    <div class="col-sm-3">
                        <select name="zona" id="zona" class="chosen" data-placeholder="Zona...">
                            <option></option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <select name="sector" id="sector" class="chosen" data-placeholder="Sector...">
                            <option></option>
                        </select>
                    </div>
                </div>


                 <!--INFORMACION DE CONTACTO-->
                <p class="c-black f-500 m-b-5 m-t-20">Informacion de contacto</p>
                <small>Informacion de contacto del usuario</small><br><br>

                <div class="row">
                     <!--File 1-->
                         <div class="col-sm-3">
                            <div class="input-group form-group fg-float">
                                <span class="input-group-addon"><i class="zmdi zmdi-local-phone"></i></span>
                                <div class="fg-line">
                                    <input type="text" name="phone1" value="{{ old('phone1') }}"  class="input-sm form-control fg-input">
                                    <label class="fg-label">Telefono 1</label>
                                </div>
                            </div>         
                        </div>



                        <div class="col-sm-3">
                            <div class="input-group form-group fg-float">
                                <span class="input-group-addon"><i class="zmdi zmdi-local-phone"></i></span>
                                <div class="fg-line">
                                    <input type="text" name="phone2" value="{{ old('phone2') }}"  class="input-sm form-control fg-input">
                                    <label class="fg-label">Telefono 2</label>
                                </div>
                            </div>         
                        </div>
                </div>


                <!--INFORMACION ADICIONAL-->
                <p class="c-black f-500 m-b-5 m-t-20">Informacion Adicional</p>
                <small>Informacion adicional del usuario</small><br><br>

                <div class="row">

                        <div class="col-sm-3">
                            <div class="input-group form-group checkbox m-b-30">
                                <span class="input-group-addon"><i class="zmdi  zmdi-directions-car"></i></span>
                                <label>
                                    <input name="have_vehicle"  type="checkbox">
                                    <i class="input-helper"></i>
                                    Tiene Vehiculo ?
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="input-group form-group fg-float">
                                <span class="input-group-addon"><i class="zmdi zmdi-format-clear-all"></i></span>
                                <div class="fg-line">
                                    <input type="text" name="vehicle_type" value="{{ old('vehicle_type') }}"  class="input-sm form-control fg-input">
                                    <label class="fg-label">Tipo Vehiculo</label>
                                </div>
                            </div>         
                        </div>

                        <div class="col-sm-3">
                            <div class="input-group form-group fg-float">
                                <span class="input-group-addon"><i class="zmdi zmdi-format-clear-all"></i></span>
                                <div class="fg-line">
                                    <input type="text" name="vehicle_plate" value="{{ old('vehicle_plate') }}"  class="input-sm form-control fg-input">
                                    <label class="fg-label">Placa Vehiculo</label>
                                </div>
                            </div>         
                        </div>

                </div>


                <!--INFORMACION DE CREDENCIALES-->

                <p class="c-black f-500 m-b-5 m-t-20">Informacion de credenciales</p>
                <small>Informacion de credenciales de acceso del usuario</small><br><br>

                <div class="row">
                  <div class="col-sm-3">
                            <div class="form-group fg-float">
                                <div class="fg-line">
                                    <input type="email"  name="email" value="{{ old('email') }}" class="input-sm form-control fg-input">
                                    <label class="fg-label">Email Address</label>
                                </div>
                            </div>
                        </div>


                        <!--File 2-->
                        <div class="col-sm-4">
                            <div class="form-group fg-float">
                                <div class="fg-line">
                                    <input type="password" name="password" class="input-sm form-control fg-input">
                                    <label class="fg-label">Password</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group fg-float">
                                <div class="fg-line">
                                    <input type="password" name="password_confirmation" class="input-sm form-control fg-input">
                                    <label class="fg-label">Confirm Password</label>
                                </div>
                            </div>
                        </div>
                </div>

                      
                <button type="submit" class="btn palette-Blue bg">Crear Cuenta</button>
                    

            </div>

 var domain= document.location.origin;
$(document).ready(function(){
    // Carga();

        if ($("#user_type_id").length > 0) {
	            getCredential();
    			$("select#user_type_id").change(getCredential);
	    }    
   
    if ($("#departamento").length > 0) {
     getCities();
     $("select#departamento").change(getCities);
     }


    loadDataTables();

    confirmDelete();

});


function loadDataTables(argument) {
	if ($(".table_list").length > 0) {
	$('.table_list').DataTable(
                    {
                            //destroy: true,
                            dom: 'Bfrtip',
                            order: [[ 2, "desc" ]],
                            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todo"]],
                            paging: true,
                              buttons: [
                                  'copy', 'csv', 'excel', 'print','pageLength','colvis',
                                   {
                                    extend: 'pdf',
                                    message: 'Reporte de predios.'
                                    //download: 'open'
                            }],
                            language: {
                             "decimal":        "",
                            "emptyTable":     "No data available in table",
                            "info":           "mostrando del  _START_ hasta _END_ de _TOTAL_ usuarios",
                            "infoEmpty":      "Mostrando 0 hasta 0 de 0 entradas",
                            "infoFiltered":   "(filtered from _MAX_ total entries)",
                            "infoPostFix":    "",
                            "thousands":      ",",
                            "lengthMenu":     "Mostrar _MENU_ registros",
                            "loadingRecords": "Cargando...",
                            "processing":     "Procesando...",
                            "search":         "Search:",
                            "zeroRecords":    "No se encontraron registros coincidentes",
                            "paginate": {
                                "first":      "<",
                                "last":       ">",
                                "next":       ">>",
                                "previous":   "<<"
                            },
                            "aria": {
                                "sortAscending":  ": activar para ordenar la columna ascendente",
                                "sortDescending": ": activar para ordenar la columna descendente"
                            }
                        }
                    });
	}
}


function getCredential(){
  var usertype=$("#user_type_id").val();
 /// alert("cambio");

}




function getCities(){
    
    if( $('#departamento').val()!=''){
		var departamento =  $('#departamento').val();
   
	     //alert(orientacion);
	    var dataString = { 
	              departamento : departamento
	    };
	      
	    var token = $("#_token").val();
	    var route=domain+"/validado/user/ciudades-by-department";

	    $.ajax({
	            headers: {'X-CSRF-TOKEN': token},
	            type: "POST",
	            url: route,
	            data: dataString,
	            dataType: "json",
	            success: function(data){   
	            	$("#ciudad").empty();

	            	var cities=data.cities;
	            	$(cities).each(function(key,cities){
	            		 $("#ciudad").append("<option value='"+cities.id+"'>"+cities.name_city+"</option>");
	            	});

	            	//Actualizar select
	            	$('#ciudad').trigger("chosen:updated");


	            	if ($("#ciudad_id").length > 0) {
	                    $('#ciudad').val($('#ciudad_id').val());
	            	 	$('#ciudad').trigger("chosen:updated");
	                }

	            	
	            	//$('#ciudad').trigger("chosen:updated");

	                getZones();
    				$("select#ciudad").change(getZones);


    				getUsersByTipeZones();
    				$("select#ciudad").change(getUsersByTipeZones);
	             
	            },
	            error: function(xhr, status, error) {
	              alert(error);
	              //console.log(xhr);
	            },
	    });
	} 
  }

function getUsersByTipeZones(){
	if( $('#ciudad').val()!='' && $(".table_list").length > 0){

		

		$('#preloader').slideDown('slow');
		//alert("hola");

		$(".table_list").dataTable().fnDestroy();
        $('#content_user_zones').empty();

		var ciudad =  $('#ciudad').val();
		var zone_type =  $('input:radio[name=zone_type]:checked').val();
	    var dataString = { 
	              ciudad : ciudad,
	              zone_type:zone_type
	    };
	      
	    var token = $("#_token").val();
	    var route=domain+"/validado/user/query-users-by-zone-by-city/"+zone_type+"/"+ciudad;

	    $.ajax({
	            type: "GET",
	            url: route,
	            data: null,
	            dataType: "json",
	            success: function(data){   
	            	//alert("Correcto");
	            
	            var users= data.users;
	            $('#preloader').slideUp('slow');


	            if(users.length<=0){
	            	 load("warning","No se encontraron resultados");
	            }else{
	            	 load("success","Se encontraron "+users.length+" resultados");
	            }

	            var type= "eliminar";

	            $(users).each(function(key,users){
	            		$('.table_list').append('<tr>'+
	            			'<td>'+users.id+'</td>'+
	            			'<td>'+users.name+' '+users.last_name+'</td>'+
	            			'<td>'+users.identificacion+'</td>'+
	            			'<td>'+users.direccion+'</td>'+
	            			'<td>'+users.phone1+'</td>'+
	            			'<td>'+users.name_user_type+'</td>'+
	            			'<td>'+
	            			'<div class="form-inline"> '+
	            			'<div class="form-group"> '+ 
	            			'<a href="'+domain+'/validado/user/view-referentes/'+users.id+'" class="btn btn-warning btn-icon waves-effect waves-circle waves-float"><span class="zmdi zmdi-eye"></span></a> '+
	            			'</div>'+
	            			'<div class="form-group"> '+
	            			'<form class="mb-2" role="form" method="POST" action="'+domain+'/validado/user/edit-user"> '+
	            			'<input type="hidden" id="_token_edit" value="'+token+'" name="_token"><input type="hidden" value="'+users.id+'" id="id" name="id" ><button  type="submit" class="btn btn-info btn-icon waves-effect waves-circle" ><span class="zmdi zmdi-edit"></span></button> </form></div>'+
	            			'<div class="form-group">'+
	            			'<form class="mb-2" role="form"  method="POST" action="'+domain+'/validado/user/delete-user"> '+
	            			'<input type="hidden" value="'+token+'" id="_token_delete" name="_token" ><input type="hidden" id="id" value="'+users.id+'" name="id" ><button type="submit"  onclick="confirmFunctionDelete()" class="delete_user btn btn-danger btn-icon waves-effect waves-circle waves-float" ><span class="zmdi zmdi-delete"></span></button></form></div>'+
	            			'</div></td></tr>');
	           	});

	           	loadDataTables();
	            

               


               

	             
	            },
	            error: function(xhr, status, error) {
	              alert(error);
	              //console.log(xhr);
	            },
	    });

		/*
		if ($("#tbody").length > 0) {
		 	$("#tbody").append('<tr><td>11</td>'+
                                    '<td>Enuar Muñoz</td>'+
                                    '<td>1234567</td>'+
                                    '<td>calle</td>'+
                                    '<td>234453454543</td>'+
                                    '<td>Lider </td>'+
                                    '<td>10 </td>'+
                                '</tr>');

		 	loadPropertiesTable();
		}
		*/
	}
}


//Properties Tables
function loadPropertiesTable(){

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

                            return "<div class=\"form-inline\"> <div class=\"form-group\">  <a href=\"/validado/user/view-referentes/" + row.id + "\" class=\"btn btn-icon command-delete waves-effect waves-circle\"><span class=\"zmdi zmdi-eye\"></span></a> </div><div class=\"form-group\"> <form class=\"mb-2\" role=\"form\" method=\"POST\" action=\"{{ url('/validado/user/edit-user') }}\"> <input type=\"hidden\" id=\"_token\" name=\"_token\" value=\"{{ csrf_token() }}\"><input type=\"hidden\" id=\"id\" name=\"id\" value=\"" + row.id + "\"><button  type=\"submit\" class=\"btn btn-icon command-edit waves-effect waves-circle\" data-row-id=\"" + row.id + "\"><span class=\"zmdi zmdi-edit\"></span></button> " + 
                                "</form></div><div class=\"form-group\"><form class=\"mb-2\" role=\"form\" method=\"POST\" action=\"{{ url('/validado/user/delete-user') }}\"> <input type=\"hidden\" id=\"_token\" name=\"_token\" value=\"{{ csrf_token() }}\"><input type=\"hidden\" id=\"id\" name=\"id\" value=\"" + row.id + "\"> " + 
                                "<button type=\"submit\" class=\"btn btn-icon command-delete waves-effect waves-circle\" data-row-id=\"" + row.id + "\"><span class=\"zmdi zmdi-delete\"></span></button></form></div></div>";
                           /* return "<form  role=\"form\" method=\"POST\" action=\"{{ url('/validado/user/update-user') }}\"> <input type=\"hidden\" id=\"_token\" name=\"_token\" value=\"{{ csrf_token() }}\"><button OnClick=\"alertpersonality(" + row.id + ");\" type=\"button\" class=\"btn btn-icon command-edit waves-effect waves-circle\" data-row-id=\"" + row.id + "\"><span class=\"zmdi zmdi-edit\"></span></button> " + 
                                "<button type=\"button\" class=\"btn btn-icon command-delete waves-effect waves-circle\" data-row-id=\"" + row.id + "\"><span class=\"zmdi zmdi-delete\"></span></button></form>";*/
                        }
                    }
                });
}


function getZones(){

 if( $('#ciudad').val()!=''){
		var ciudad =  $('#ciudad').val();
		var zone_type =  $('input:radio[name=zone_type]:checked').val();
	    var dataString = { 
	              ciudad : ciudad,
	              zone_type:zone_type
	    };
	      
	    var token = $("#_token").val();
	    var route=domain+"/validado/user/zonas-by-ciudad";

	    $.ajax({
	            headers: {'X-CSRF-TOKEN': token},
	            type: "POST",
	            url: route,
	            data: dataString,
	            dataType: "json",
	            success: function(data){   

	            	$("#zona").empty();

	            	var zona=data.zones;
	            	$(zona).each(function(key,zona){
	            		 $("#zona").append("<option value='"+zona.id+"'>"+zona.name_zone+"</option>");
	            	});

	            	//Actualizar select
	            	$('#zona').trigger("chosen:updated");

	            	if ($("#zone_id").length > 0) {
	                    $('#zona').val($('#zone_id').val());
	            	 	$('#zona').trigger("chosen:updated");
	                }

	            	//$("#zona").val($('#ciudad_id').val());




	                getSectors();
    				$("select#zona").change(getSectors);
	             
	            },
	            error: function(xhr, status, error) {
	              alert(error);
	              //console.log(xhr);
	            },
	    });
	}
}


function getSectors(){
 	if( $('#zona').val()!=''){
 		if($('#zona').val()!=null){
 			var zone =  $('#zona').val();
		var zone_type =  $('input:radio[name=zone_type]:checked').val();
	    var dataString = { 
	              zone : zone,
	              zone_type:zone_type
	    };
	      
	    var token = $("#_token").val();
	    var route=domain+"/validado/user/sectores-by-zona";

	    $.ajax({
	            headers: {'X-CSRF-TOKEN': token},
	            type: "POST",
	            url: route,
	            data: dataString,
	            dataType: "json",
	            success: function(data){   

	            	$("#sector").empty();

	            	var sectors=data.sectors;
	            	$(sectors).each(function(key,sectors){
	            		 $("#sector").append("<option value='"+sectors.id+"'>"+sectors.name_sector+"</option>");
	            	});

	            	//Actualizar select
	            	$('#sector').trigger("chosen:updated");

	            	if ($("#sector_id").length > 0) {
	                    $('#sector').val($('#sector_id').val());
	            	 	$('#sector').trigger("chosen:updated");
	                }

	               

	              
	             
	            },
	            error: function(xhr, status, error) {
	              alert(error);
	              //console.log(xhr);
	            },
	    });

 		}
	}
}




$('input[type=radio][name=zone_type]').change(function() {
	 // var zone_type =  $('input:radio[name=zone_type]:checked').val();
	  ///alert(zone_type);
      $("#zona").empty();
      $("#sector").empty();

      $('#zona').trigger("chosen:updated");
      $('#sector').trigger("chosen:updated");

      getZones();

      getUsersByTipeZones();


});





$('input[type=checkbox][name=have_vehicle]').change(function() {

	if ($('#have_vehicle').is(":checked"))
	{
		//true
	}else{
		//false
		//$('#vehicle_type').empty();
		//$('#vehicle_plate').empty();

		$('#vehicle_type').removeAttr('value');
		$('#vehicle_plate').removeAttr('value');
	}
});




//Function Notify
/*-----------------------------------------------------------------------------------*/
function notify(from, align, icon, type, animIn, animOut, mensaje){
        var domain= document.location.origin;
        $.growl({
            icon: icon,
            title: "Notificacion",
            message: mensaje,
            url: ''
        },{
            element: 'body',
            type: type,
            allow_dismiss: true,
            placement: {
                from: from,
                align: align
            },
            offset: {
                x: 30,
                y: 30
            },
            spacing: 10,
            z_index: 1031,
            delay: 4500,
            timer: 1000,
            url_target: '_blank',
            mouse_over: false,
            animate: {
                enter: animIn,
                exit: animOut
            },
            icon_type: 'class',
            template: '<div data-growl="container" class="alert" role="alert">' +
            '<button type="button" class="close" data-growl="dismiss">' +
            '<span aria-hidden="true">&times;</span>' +
            '<span class="sr-only">Close</span>' +
            '</button>' +
            '<span data-growl="icon"></span>' +
            '<strong><span data-growl="title"></span> </strong>' +
            '<span data-growl="message"></span>' +
            '<a href="#"  id="aqui" data-growl="url"></a>' +
            '</div>'
        });
    };




      function load(nType,mensaje){
        var nFrom = "top";
            var nAlign = "right";
            var nIcons = "zmdi zmdi-notifications-active zmdi-hc-fw";
            var nType = nType;
            var nAnimIn = "animated flipInX";
            var nAnimOut = "animated flipOutX";
         
            var mensaje=mensaje;
           // notify_messaje();
            notify(nFrom, nAlign, nIcons, nType, nAnimIn, nAnimOut, mensaje);
    }





//Function Alert Dialogs Delete
/*-----------------------------------------------------------------------------------*/

function confirmDelete(){
 var deleter = {

        linkSelector : "a#delete-btn",

        init: function() {
            $(this.linkSelector).on('click', {self:this}, this.handleClick);
        },

        handleClick: function(event) {
            event.preventDefault();

            var self = event.data.self;
            var link = $(this);

            swal({
                title: "Confirmar eliminación",
                text: "¿Estás seguro de eliminar esta categoría?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Si, eliminar!",
                closeOnConfirm: true
            },
            function(isConfirm){
                if(isConfirm){
                    window.location = link.attr('href');
                }
                else{
                    swal("cancelled", "Category deletion Cancelled", "error");
                }
            });

        },
    };

    deleter.init();
}


function archiveFunction() {
event.preventDefault(); // prevent form submit
var form = event.target.form; // storing the form
        swal({
  title: "Are you sure?",
  text: "But you will still be able to retrieve this file.",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes, archive it!",
  cancelButtonText: "No, cancel please!",
  closeOnConfirm: false,
  closeOnCancel: false
},
function(isConfirm){
  if (isConfirm) {
    form.submit();          // submitting the form when user press yes
  } else {
    swal("Cancelled", "Your imaginary file is safe :)", "error");
  }
});
}


function confirmFunctionDelete(){


	event.preventDefault(); // prevent form submit
	var form = event.target.form; // storing the form

	
	swal({
	  title: "¿Estás seguro?",
	  text: "Desea eliminar la informacion de este usuario.",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonColor: "#DD6B55",
	  confirmButtonText: "Si, eliminar!",
	  cancelButtonText: "No, cancelar!",
	  closeOnConfirm: false,
	  closeOnCancel: false
	},
	function(isConfirm){
	  if (isConfirm) {
	    $( ".delete_user" ).trigger( "click" );     // submitting the form when user press yes
	  } else {
	    swal("Cancelled", "No se elimino !", "error");
	  }
	});
}

function confirmFunction(type) {

	/* var x = confirm("Are you sure you want to delete?");
                    if (x) {
                        return true;
                    }
                    else {
                        return false;
                    }*/
	event.preventDefault(); // prevent form submit
	var form = event.target.form; // storing the form
	        swal({
	  title: "¿Estás seguro?",
	  text: "Desea "+type+" la informacion de este usuario.",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonColor: "#DD6B55",
	  confirmButtonText: "Si, "+type+"!",
	  cancelButtonText: "No, cancelar!",
	  closeOnConfirm: false,
	  closeOnCancel: false
	},
	function(isConfirm){
	  if (isConfirm) {
	     $( ".delete_user" ).trigger( "click" );        // submitting the form when user press yes
	  } else {
	    swal("Cancelled", "No se "+type+" !", "error");
	  }
	});
}

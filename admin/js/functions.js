$(document).ready(function(){

//--------------------- SELECCIONAR FOTO PRODUCTO ---------------------
    $("#foto").on("change",function(){
    	var uploadFoto = document.getElementById("foto").value;
        var foto       = document.getElementById("foto").files;
        var nav = window.URL || window.webkitURL;
        var contactAlert = document.getElementById('form_alert');
        
            if(uploadFoto !='')
            {
                var type = foto[0].type;
                var name = foto[0].name;
                if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png')
                {
                    contactAlert.innerHTML = '<p class="errorArchivo">El archivo no es válido.</p>';                        
                    $("#img").remove();
                    $(".delPhoto").addClass('notBlock');
                    $('#foto').val('');
                    return false;
                }else{  
                        contactAlert.innerHTML='';
                        $("#img").remove();
                        $(".delPhoto").removeClass('notBlock');
                        var objeto_url = nav.createObjectURL(this.files[0]);
                        $(".prevPhoto").append("<img id='img' src="+objeto_url+">");
                        $(".upimg label").remove();
                        
                    }
              }else{
              	alert("No selecciono foto");
                $("#img").remove();
              }              
    });

    $('.delPhoto').click(function(){
    	$('#foto').val('');
    	$(".delPhoto").addClass('notBlock');
    	$("#img").remove();
    	if($("#foto_actual") && $("#foto_remove")){
    		$("#foto_remove").val('img_producto.png');
    	}
    });
	
//Modal form Del Product
	$('.del_product').click(function(e){

		e.preventDefault();
		var producto = $(this).attr('product');
		var action = 'infoProducto';

		$.ajax({
			url:'ajax.php',
			type: 'POST',
			async: true,
			data: {action:action,producto:producto},

			success: function(response){
				//console.log(response);

				if(response != 'error'){
					var info = JSON.parse(response);

					///////////////////////////////////////////
					$('.bodyModal').html('<form action="" method="post" name="form_del_product" id="form_del_product" onsubmit="event.preventDefault(); delProduct();">'+
											'<h1><i class="fas fa-archive" style="font-size: 45pt;"></i><br><br>Eliminar Producto</h1>'+

											'<p>¿Está seguro de eliminar el siguiente registro?</p>'+
											'<br><h2 class="nameProducto">'+info.producto+'</h2><br>'+
											'<input type="hidden" name="producto_id" id="producto_id" value="'+info.id+'" required>'+
											'<input type="hidden" name="action" value="delProduct" required>'+
											'<div class="alert alertAddProduct"></div>'+

											'<a href"#" class="btn_cancel closeModal" onclick="closeModal();"><i class="fas fa-ban"></i> Cerrar</a>'+
											'<button type="submit" class="btn_ok"><i class="fas fa-trash-alt"></i> Eliminar </button>'+
										'</form>');
				}
			},

			error: function(error){
				console.log(error);
			/////////////////////////
			}
		});
		

		$('.modal').fadeIn();
		/////////////////////////////
	});

//Modal view QR
	$('.view_qr').click(function(e){

		e.preventDefault();
		var qr = $(this).attr('rqid');

		$('.bodyModal').html(	'<div>'+
								'<img src="img/uploads/QR/'+qr+'.jpg"/><br>'+
								'<a href"#" class="btn_cancel closeModal" onclick="closeModal();"><i class="fas fa-ban"></i> Cerrar</a>'+
								'</div>'
								);

		$('.modal').fadeIn();
		/////////////////////////////
	});

});
/////////END ONLOAD/////////////////


//<<<<<<<</INICIO FUNCIONES/>>>>>>>>>>//
	function getUrl(){
		var loc = window.location;
		var pathName = loc.pathname.substring(0 , loc.pathname.lastIndexOf('/') + 1);
		return loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length));

	}

/////////////BOTON ELIMINAR PRODUCTO/////////////
	function delProduct(){
		var pr = $('#producto_id').val();
		$('.alertAddProduct').html('');

		$.ajax({
			url:'ajax.php',
			type: 'POST',
			async: true,
			data: $('#form_del_product').serialize(),

			success: function(response){
				
				if(response == 'error'){

					//si hay error, alert de error
					$('.alertAddProduct').html('<p style="color: red;">Error al eliminar el producto</p>');
				}else{
					//obtengo los valores del JSON
					$('.row'+pr).remove();
					$('#form_del_product .btn_ok').remove();
					//alert indicando q salio todo bien
					$('.alertAddProduct').html('<p>Producto eliminado correctamente</p>');			
				}
				
			},

			error: function(error){
				console.log(error);
			}
		});
	}

/////////////BOTON CERRAR//////////////
	function closeModal(){
		
		$('.alertAddProduct').html('');
		$('#txtCantidad').val('');
		$('#txtPrecio').val('');
		$('.modal').fadeOut();
	}

//<<<<<<<</FINAL FUNCIONES/>>>>>>>>>>//

<script>
			

	$(document).ready(function() {
		
	    table = $('#dataTable').DataTable({ 
	
	        "processing": true, 
	        "serverSide": true, // Procesa los datos del lado del servidor
	        "order": [], // Orden inicial. Ej => "order": [[2, 'asc']],
	
	        // Carga el contenido de la tabla mediante Ajax
	        "ajax": {
	            "url": baseurl + $('[name="datatables_ruta"]').val(),
	            "type": "POST"
	        },
	        	
	        // Definir las propiedades de inicialización de las columnas
	        "columnDefs": [
		        { 
		            "targets": $('[name="datatables_targets"]').val(), 
		            "orderable": false, // no ordenable	
		        },
	        ],
	        "displayLength": 25, // Cantidad de filas que muestra inicialmente
            "lengthMenu": [[25, 50, 100, 200], [25, 50, 100, 200]],
            "searchDelay": 300,        
            "dom": '<"H"lfr>t<"F"ip>',
		    language: {
		        processing:     "Procesando...",
		        search:         "Buscar:",
		        lengthMenu:    " _MENU_ ",
		        info:           "Mostrando _START_ a _END_ de _TOTAL_ registros",
		        infoEmpty:      "Mostrando 0 a 0 de 0 registros",
		        infoFiltered:   "(filtrados de _MAX_ en total)",
		        infoPostFix:    "",
		        loadingRecords: "Cargando...",
		        zeroRecords:    "No se hallaron registros",
		        emptyTable:     "No se hallaron registros",
		        paginate: {
		            first:      "Primera Pag",
		            previous:   "<i class='glyphicon glyphicon-backward'></i>",
		            next:       "<i class='glyphicon glyphicon-forward'></i>",
		            last:       "Ultima pag"
		        }
		    }       
          	
	    });					
	});	
    
    
   /*
      search: busca con datatables del lado del servidor
    */
   function search()
   {  
      $('#form_search .search').each(function(){
           var col = $(this).attr('id');
           table.columns(col).search($('#form_search #' + col).val());
      });  
      
      table.draw()  
   }
       
   $("#table_filter").css("display","none");  // Ocultar la búsqueda global
</script>
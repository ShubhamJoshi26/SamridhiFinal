  <!-- <script src="assets/bundles/libscripts.bundle.js"></script> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<!-- Plugin Js -->

<script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script>

<script src="{{URL::asset('assets/bundles/apexcharts.bundle.js')}}"></script>
<script src="{{URL::asset('assets/bundles/dataTables.bundle.js')}}"></script>  
<script src="{{URL::asset('assets/bundles/dropify.bundle.js')}}"></script>  
<script src="{{URL::asset('assets/plugin/cropper/cropper-init.js')}}"></script>  
<script src="{{URL::asset('assets/plugin/cropper/cropper.min.js')}}"></script>  

<!-- Jquery Page Js -->
<script src="{{URL::asset('assets/js/template.js')}}"></script>
<script src="{{URL::asset('assets/js/bootstrap.js')}}"></script>
<script src="{{URL::asset('assets/js/uploader.js')}}"></script>
<script src="{{URL::asset('assets/js/custom.js')}}"></script>
<script src="{{URL::asset('assets/js/page/index.js')}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1Jr7axGGkwvHRnNfoOzoVRFV3yOPHJEU&amp;callback=myMap"></script> 
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script> 

<script>
    $('#myDataTable')
    .addClass( 'nowrap')
    .dataTable( {
        responsive: true,
        columnDefs: [
            { targets: [-1, -3], className: 'dt-body-right' }
        ]
    });
</script>
<script>
		$(document).ready(function () {
			$('#image-uploadify').imageuploadify();
		})
	</script>
<script>
        $(document).ready(function() {
        //Ch-editer
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
            //Datatable
            $('#myCartTable')
            .addClass( 'nowrap' )
            .dataTable( {
                responsive: true,
                columnDefs: [
                    { targets: [-1, -3], className: 'dt-body-right' }
                ]
            });
            $('.deleterow').on('click',function(){
            var tablename = $(this).closest('table').DataTable();  
            tablename
                    .row( $(this)
                    .parents('tr') )
                    .remove()
                    .draw();

            } );
           //Multiselect
           $('#optgroup').multiSelect({ selectableOptgroup: true });
        });

        $(function() {
            $('.dropify').dropify();

            var drEvent = $('#dropify-event').dropify();
            drEvent.on('dropify.beforeClear', function(event, element) {
                return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
            });

            drEvent.on('dropify.afterClear', function(event, element) {
                alert('File deleted');
            });

            $('.dropify-fr').dropify({
                messages: {
                    default: 'Glissez-dÃ©posez un fichier ici ou cliquez',
                    replace: 'Glissez-dÃ©posez un fichier ou cliquez pour remplacer',
                    remove: 'Supprimer',
                    error: 'DÃ©solÃ©, le fichier trop volumineux'
                }
            });
        });
        var path = "{{ url('productautocomplete') }}";
  
    $('#product_name').autocomplete({
        source: function( request, response ) { 
        $.ajax({
          url: path,
          data: {query: request.term},
          success: function(data) {
            // console.log(data);
            response(data);
          }
        });
      },
      select: function (event, ui) {
           $('#product_name').val(ui.item.label);
           $('#product_id').val(ui.item.value);
           $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
           $.ajax({
            url:'/inventory/checkExistInventory',
            type:'post',
            data:{id:ui.item.value},
            success:function(suc)
            {
                if(suc=='Already Exist')
                {
                    alert("This Product's Inventory Already Exist");
                    window.location.reload();
                }

            }
           })
           return false;
        }
        });
            
    </script>
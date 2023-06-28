@section('scripts')
   <!-- BEGIN PAGE LEVEL SCRIPTS -->
   <script src="{{ asset('admin') }}/plugins/table/datatable/datatables.js"></script>
   <script src="{{asset('admin') }}/assets/js/scrollspyNav.js"></script>
   <script src="{{asset('admin') }}/assets/js/scrollspyNav.js"></script>
   <script src="{{asset('admin') }}/plugins/sweetalerts/sweetalert2.min.js"></script>
   <script src="{{asset('admin') }}/plugins/sweetalerts/custom-sweetalert.js"></script>
   <script src="{{asset('admin') }}/assets/js/forms/bootstrap_validation/bs_validation_script.js"></script>

		<script>
			$(document).ready(function(){
					$('[name=region_id]').change(function(){
						let region_id = $(this).val();
						$.ajax({
							url:`/api/regions/${region_id}/cities`,
							headers: {
            'Accept-Language':$('meta[name=language]').attr('value')
       },
							beforeSend:function(){
								$(':input').attr('disabled','disabled');
								$('.btn').attr('disabled','disabled');
							},
							dataType:'JSON',
							success:function(res){
								$(':input').removeAttr('disabled');
								$('.btn').removeAttr('disabled');
								let cities = res.data;
								$('[name=city_id]').html('');
									for(let i=0;i<cities.length;i++){
													let city = cities[i];
													$('[name=city_id]').append('<option value="'+city.key+'">'+city.name+'</option>');
									}
							}

						});
					});
			});
		</script>

   <script>
      var table =  $('#default-ordering').DataTable( {
           "oLanguage": {
               "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>' },
               "sInfo": "Showing page _PAGE_ of _PAGES_",
               "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
               "sSearchPlaceholder": "{{trans('messages.Search_now')}}",
              "sLengthMenu": "{{trans('messages.search_results')}} :  _MENU_",
           },
           "order": [[ 3, "desc" ]],
           "stripeClasses": [],
           "lengthMenu": [7, 10, 20, 50],
           "pageLength": 7,
           drawCallback: function () { $('.dataTables_paginate > .pagination').addClass(' pagination-style-13 pagination-bordered mb-5'); }
     // Event listener to the two range filtering inputs to redraw on input
       } );
        // Event listener to the two range filtering inputs to redraw on input
        $('#min_salary, #max_salary').keyup( function() { table.draw(); } );
        $('#min_obligation, #max_obligation').keyup( function() { table.draw(); } );

   </script>
   <!-- END PAGE LEVEL SCRIPTS -->

   <!------ BEGIN SWEET ALERT-------->

   <script>

        $('.warning.confirm').on('click', function () {
            var id = $(this).attr('data');
            console.log(id);
            var swal_text = " {{trans('messages.delete')}}  " + $(this).attr('data_name') + '؟';
            var swal_title = "{{trans('messages.Are_you_sure_you_want_to_delete?')}}";

            swal({
                title: swal_title,
                text: swal_text,
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-warning",
                confirmButtonText: "{{trans('messages.yes')}}",
                cancelButtonText: "{{trans('messages.close')}}",
                closeOnConfirm: false,
                padding: "2em"
                }).then(function(result) {
                if (result.value) {
                    window.location.href = "{{ url('/') }}" + "/dashboard/users/delete/"+id;

                    swal(
                    "{{trans('messages.delete_success')}}"
                    )
                }
                });
        });
    </script>
   <!------ End SWEET ALERT---------->

    <!----------- Begin show password------------>
    <script>
        $('#show1').on('click', function(){
           var passInput=$("#password");
           if(passInput.attr('type')==='password')
             {
               passInput.attr('type','text');
           }else{
              passInput.attr('type','password');
           }
       });
       $('#show2').on('click', function(){
           var passInput=$("#password_confirmation");
           if(passInput.attr('type')==='password')
             {
               passInput.attr('type','text');
           }else{
              passInput.attr('type','password');
           }
       });
    </script>
    <!----------- End show password------------>

    <script>
        $('#searchButton').on('click',function()
        {
            var type = $('.type').val();
            var search = $('#input-search').val();
            //send ajax
            $.ajax({
                url : 'users/filter/' +type+ '/' +search,
                type : 'get',
                success: function(data){
                    console.log(type,search);


                },
                error: function(jqXhr, textStatus, errorMessage){
                    alert(errorMessage);
                }
            });
        });
    </script>

    <!--------- Begin range salary----------->
    <script>
         /* Custom filtering function which will search data in column four between two values */
         $.fn.dataTable.ext.search.push(
            function( settings, data, dataIndex ) {

                var min = parseInt( $('#min_salary').val(), 10 );
                var max = parseInt( $('#max_salary').val(), 10 );
                var age = parseFloat( data[5] ) || 0; // use data for the age column

                if ( ( isNaN( min ) && isNaN( max ) ) ||
                     ( isNaN( min ) && age <= max ) ||
                     ( min <= age   && isNaN( max ) ) ||
                     ( min <= age   && age <= max ) )
                {
                    return true;
                }
                return false;
            }
        );
    </script>
    <!--------- End range salary----------->
     <!--------- Begin range obligation----------->
     <script>
        /* Custom filtering function which will search data in column four between two values */
        $.fn.dataTable.ext.search.push(
           function( settings, data, dataIndex ) {
               var min = parseInt( $('#min_obligation').val(), 10 );
               var max = parseInt( $('#max_obligation').val(), 10 );
               var age = parseFloat( data[6] ) || 0; // use data for the age column

               if ( ( isNaN( min ) && isNaN( max ) ) ||
                    ( isNaN( min ) && age <= max ) ||
                    ( min <= age   && isNaN( max ) ) ||
                    ( min <= age   && age <= max ) )
               {
                   return true;
               }
               return false;
           }
       );
   </script>
   <!--------- End range obligation----------->


   @endsection

@section('scripts')
   <!-- BEGIN PAGE LEVEL SCRIPTS -->
   <script src="{{ asset('admin') }}/plugins/table/datatable/datatables.js"></script>
   <script src="{{asset('admin') }}/assets/js/scrollspyNav.js"></script>
   <script src="{{asset('admin') }}/assets/js/scrollspyNav.js"></script>
   <script src="{{asset('admin') }}/plugins/sweetalerts/sweetalert2.min.js"></script>
   <script src="{{asset('admin') }}/plugins/sweetalerts/custom-sweetalert.js"></script>
    <script src="{{asset('admin') }}/plugins/editors/markdown/simplemde.min.js"></script>
    <script src="{{asset('admin') }}/plugins/editors/markdown/custom-markdown.js"></script>


   <script>
       $('#default-ordering').DataTable( {
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
       } );
   </script>
   <!-- END PAGE LEVEL SCRIPTS -->

   <!---- Begin activate script-------->
   <script>
        function Active(state, id){
            $.ajax({
                url: 'product-features/active/'+id,
                type: 'GET',
                datatype: 'json',
                success: function (data) {
                    console.log(state);
                    if(data == 1) {
                    swal("{{trans('messages.activate')}}")
                    }
                    if(data == 0) {
                    swal("{{trans('messages.unactivate')}}" )
                    }


                },

            });
        }

    </script>

   <!---- End activate script-------->

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
                    window.location.href = "{{ url('/') }}" + "/dashboard/product-features/delete/"+id;

                    swal(
                    "{{trans('messages.delete_success')}}"
                    )
                }
                });
        });
    </script>
   <!------ End SWEET ALERT---------->

   <!-------- Begin editor---------------->
    {{-- <script>
        new SimpleMDE({
    element: document.getElementById("editor7"),
    spellChecker: false,
    });
    new SimpleMDE({
    element: document.getElementById("editor8"),
    spellChecker: false,
    });
    </script> --}}
  <!-------- End editor---------------->





   @endsection

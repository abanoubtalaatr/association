@section('scripts')
   <!-- BEGIN PAGE LEVEL SCRIPTS -->
   <script src="{{asset('admin') }}/assets/js/scrollspyNav.js"></script>
   <script src="{{asset('admin') }}/assets/js/scrollspyNav.js"></script>
   <script src="{{asset('admin') }}/plugins/editors/markdown/simplemde.min.js"></script>
   <script src="{{asset('admin') }}/plugins/editors/markdown/custom-markdown.js"></script>
   <script src="{{asset('admin') }}/assets/js/scrollspyNav.js"></script>
   <script src="{{asset('admin') }}/plugins/file-upload/file-upload-with-preview.min.js"></script>

   <!-- END PAGE LEVEL SCRIPTS -->




    <!-------- Begin image---------------->
    <script>
								$("input[type='file']").on("change", function () {
									if(this.files[0].size > 1024000) {
											alert("@lang('site.max_size_allowed_is_1_mb')");
											$(this).val('');
											return;
									}

									var validExtensions = ["jpg","jpeg","png"];
									let is_valid = 0;
									for(ext in validExtensions){
										if(this.files[0].name.toLowerCase().indexOf(validExtensions[ext])!=-1){
											is_valid=1;
											break;
										}
									}

									if(is_valid==0){
										alert("@lang('site.only_these_formats_are_allowed') : "+validExtensions.join(', '));
										$(this).val('');
									}


								});



    </script>

@endsection

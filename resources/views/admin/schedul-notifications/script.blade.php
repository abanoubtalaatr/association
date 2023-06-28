@section('scripts')
   <!-- BEGIN PAGE LEVEL SCRIPTS -->
   <script src="{{ asset('admin') }}/plugins/table/datatable/datatables.js"></script>
   <script src="{{asset('admin') }}/assets/js/scrollspyNav.js"></script>
   <script src="{{asset('admin') }}/plugins/sweetalerts/sweetalert2.min.js"></script>
   <script src="{{asset('admin') }}/plugins/sweetalerts/custom-sweetalert.js"></script>
    <script src="{{asset('admin') }}/plugins/editors/markdown/simplemde.min.js"></script>
    <script src="{{asset('admin') }}/plugins/editors/markdown/custom-markdown.js"></script>
    <script src="{{asset('admin') }}/plugins/highlight/highlight.pack.js"></script>
    <script src="{{asset('admin') }}/plugins/flatpickr/flatpickr.js"></script>
    <script src="{{asset('admin') }}/plugins/noUiSlider/nouislider.min.js"></script>
    <script src="{{asset('admin') }}/plugins/flatpickr/custom-flatpickr.js"></script>
    <script src="{{asset('admin') }}/plugins/noUiSlider/custom-nouiSlider.js"></script>
    <script src="{{asset('admin') }}/plugins/bootstrap-range-Slider/bootstrap-rangeSlider.js"></script>
    <script src="{{asset('admin') }}/plugins/select2/select2.min.js"></script>
    <script src="{{asset('admin') }}/plugins/select2/custom-select2.js"></script>


<script>

$(document).ready(function() {

var select = $('select[multiple]');
var options = select.find('option');

var div = $('<div />').addClass('selectMultiple');
var active = $('<div />');
var list = $('<ul />');
var placeholder = select.data('placeholder');

var span = $('<span />').text(placeholder).appendTo(active);

options.each(function() {
    var text = $(this).text();
    if($(this).is(':selected')) {
        active.append($('<a />').html('<em>' + text + '</em><i></i>'));
        span.addClass('hide');
    } else {
        list.append($('<li />').html(text));
    }
});

active.append($('<div />').addClass('arrow'));
div.append(active).append(list);

select.wrap(div);

$(document).on('click', '.selectMultiple ul li', function(e) {
    var select = $(this).parent().parent();
    var li = $(this);
    if(!select.hasClass('clicked')) {
        select.addClass('clicked');
        li.prev().addClass('beforeRemove');
        li.next().addClass('afterRemove');
        li.addClass('remove');
        var a = $('<a />').addClass('notShown').html('<em>' + li.text() + '</em><i></i>').hide().appendTo(select.children('div'));
        a.slideDown(1, function() {
            setTimeout(function() {
                a.addClass('shown');
                select.children('div').children('span').addClass('hide');
                select.find('option:contains(' + li.text() + ')').prop('selected', true);
            }, 1);
        });
        setTimeout(function() {
            if(li.prev().is(':last-child')) {
                li.prev().removeClass('beforeRemove');
            }
            if(li.next().is(':first-child')) {
                li.next().removeClass('afterRemove');
            }
            setTimeout(function() {
                li.prev().removeClass('beforeRemove');
                li.next().removeClass('afterRemove');
            }, 1);

            li.slideUp(1, function() {
                li.remove();
                select.removeClass('clicked');
            });
        }, 1);
    }
});

$('#select_all_span').click(function(){
	if($('[name=all_users]').val()==1){
		$('[name=all_users]').val(0);
		$('.selectMultiple').show();
		$('#select_all_span').text("@lang('site.select_all')");
		$('#users-error').show();
		$('#all_users_selected').hide();
	}else{
		$('[name=all_users]').val(1);
		$('.selectMultiple').hide();
		$('#select_all_span').text("@lang('site.deselect_all')");
		$('#users-error').hide();
		$('#all_users_selected').show();
	}
});


$(document).on('click', '.selectMultiple > div a', function(e) {
    var select = $(this).parent().parent();
    var self = $(this);
    self.removeClass().addClass('remove');
    select.addClass('open');
    setTimeout(function() {
        self.addClass('disappear');
        setTimeout(function() {
            self.animate({
                width: 0,
                height: 0,
                padding: 0,
                margin: 0
            }, 1, function() {
                var li = $('<li />').text(self.children('em').text()).addClass('notShown').appendTo(select.find('ul'));
                li.slideDown(1, function() {
                    li.addClass('show');
                    setTimeout(function() {
                        select.find('option:contains(' + self.children('em').text() + ')').prop('selected', false);
                        if(!select.find('option:selected').length) {
                            select.children('div').children('span').removeClass('hide');
                        }
                        li.removeClass();
                    }, 1);
                });
                self.remove();
            })
        }, 1);
    }, 1);
});

$(document).on('click', '.selectMultiple > div span', function(e) {
    $(this).parent().parent().toggleClass('open');
});


$(document).click(function(e){

    // if the target of the click isn't the container nor a descendant of the container
    if (!$(".selectMultiple").is(e.target) && $(".selectMultiple").has(e.target).length === 0){
        $(".selectMultiple").removeClass('open');
    }
});


});


									function Active(state, id){
            $.ajax({
                url: 'schedul-notifications/active/'+id,
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
                    window.location.href = "{{ url('/') }}" + "/dashboard/schedul-notifications/delete/"+id;

                    swal(
                    "{{trans('messages.delete_success')}}"
                    )
                }
                });
        });
    </script>
   <!------ End SWEET ALERT---------->

   <!-------- Begin editor---------------->
   <script>
       new SimpleMDE({
    element: document.getElementById("demo1"),
    spellChecker: false,
    });
   </script>
   <!-------- End editor---------------->
   <!-------- Begin date time---------------->
    <script>
       var f1 = flatpickr(document.getElementById('basicFlatpickr'));
       var f4 = flatpickr(document.getElementById('timeFlatpickr'), {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        defaultDate: "13:45"
     });

    </script>
   <!-------- End date time---------------->
   <!-------- Begin select2---------------->
   <script>
            $(".tagging").select2({
                tags: true
            });

   </script>
   <!-------- End select2---------------->



   @endsection

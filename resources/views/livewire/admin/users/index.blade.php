<main class="main-content">
    <!--head-->
    <x-admin.head/>
    <!--table-->
    <div class="border-div">
        <div class="b-btm flex-div-2">
            <h4>{{$page_title}}</h4>
            {{-- <a style='text-align:center' href='{{route('user.create_ad')}}' class="button btn-red big">@lang('site.create_ad')</a> --}}
        </div>
        <div class="table-page-wrap">

            <div class="row">
                <div class="form-group col-3">
                    <label for="status-select">@lang('validation.attributes.username')</label>
                    <input wire:model='username' type="text" class="form-control contact-input">
                </div>

                <div class="form-group col-3">
                    <label for="status-select">@lang('validation.attributes.email')</label>
                    <input wire:model='email' type="text" class="form-control contact-input">
                </div>
                <div class="form-group col-3">
                    <label for="status-select">@lang('site.courses')</label>
                    <select wire:model='course' id='status-select' class="form-control  contact-input">
                        <option value>@lang('site.courses')</option>
                        @foreach($courses as $course)
                            <option value="{{$course->id}}">{{$course->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-3">
                    <label for="status-select">@lang('site.trainers')</label>

                    <button  class="btn btn-primary d-block" type="button"  wire:click="export" wire:loading.attr="disabled" wire:target="export">@lang('site.export_trainers')</button>
                    <span wire:loading wire:target="export" class="spinner-border spinner-border-sm" role="status"
                          aria-hidden="true"></span>
                </div>
            </div>

            @if(count($records))
                <table class="table-page table">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">@lang('validation.attributes.username')</th>
                        <th class="text-center">@lang('validation.attributes.email')</th>
                        <td class="text-center">@lang('validation.attributes.mobile_number')</td>
                        <td class="text-center">@lang('validation.attributes.total_training_hours')</td>
                        <td class="text-center">@lang('validation.attributes.created_at')</td>
                        <th>@lang('site.actions')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($records as $record)
                        <tr>

                            <td class="text-center">{{ $rowNumber++ }}</td>
                            <td class='text-center'>{{$record->username}}</td>
                            <td class='text-center'>{{$record->email}}</td>
                            <td class='text-center'>{{$record->mobile}}</td>
                            <td class="text-center">{{$record->total_training_hours}}</td>
                            <td class='text-center'>{{$record->created_at}}</td>


                            <td>
                                <div class="actions">
                                    <a href='{{route('admin.users.edit',$record->id)}}' class="no-btn"><i
                                            class="far fa-edit blue"></i></a>
                                    <a href='{{route('admin.user_courses',$record->id)}}' class="no-btn" title="courses"><i
                                            class="far fa-eye blue"></i></a>
                                </div>
                            </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>

                {{$records->links()}}
            @else
                <div class="row" style='margin-top:10px'>
                    <div class="alert alert-warning">@lang('site.no_data_to_display')</div>
                </div>
            @endif
        </div>
    </div>
</main>

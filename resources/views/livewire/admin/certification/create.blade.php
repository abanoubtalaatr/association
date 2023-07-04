<main class="main-content">
    <!--head-->
    <x-admin.head/>
    <!--campaign-->
    <div class="border-div">
        <div class="b-btm">
            <h4>{{$page_title}}</h4>
        </div>
        <div class="edit-c">
            <form wire:submit.prevent='store'>
                <div class="row my-2">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="courseSelect">{{trans('site.select_course')}}</label>
                            <select class="form-control" id="courseSelect" wire:model="form.course_id">
                                <option value="">{{trans('site.select_course')}}</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }} </option>
                                @endforeach
                            </select>
                            @error('form.course_id') <p class="text-danger">{{$message}}</p> @enderror
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="row">

                    <div class="col-6">
                        <input
                            wire:model='form.position_x_barcode'
                            class="@error('form.position_x_barcode') is-invalid @enderror form-control contact-input"
                            type="number" placeholder="@lang('validation.attributes.position_x_barcode')"/>
                        @error('form.position_x_barcode') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>


                    <div class="col-6">
                        <input
                            wire:model='form.position_y_barcode'
                            class="@error('form.position_y_barcode') is-invalid @enderror form-control contact-input"
                            type="number" placeholder="@lang('validation.attributes.position_y_barcode')"/>
                        @error('form.position_y_barcode') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>

                </div>

                <div class="row">
                    <div class="col-6">
                        <input
                            wire:model='form.position_x_person_name'
                            class="@error('form.position_x_person_name') is-invalid @enderror form-control contact-input"
                            type="number" placeholder="@lang('validation.attributes.position_x_person_name')"/>
                        @error('form.position_x_person_name') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>


                    <div class="col-6">
                        <input
                            wire:model='form.position_y_person_name'
                            class="@error('form.position_y_person_name') is-invalid @enderror form-control contact-input"
                            type="number" placeholder="@lang('validation.attributes.position_y_person_name')"/>
                        @error('form.position_y_person_name') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>

                </div>
                <div class="row">
                    <div class="col-6">
                        <label>@lang('site.name_of_color')</label>
                        <input
                            wire:model='form.name_of_color'
                            class="@error('form.name_of_color') is-invalid @enderror form-control contact-input"
                            type="color" placeholder="@lang('validation.attributes.color_of_name')"/>
                        @error('form.name_of_color') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>


                    <div class="col-6">
                        <input
                            wire:model='form.font_of_name'
                            class="@error('form.font_of_name') is-invalid @enderror form-control contact-input"
                            type="number" placeholder="@lang('validation.attributes.font_of_name')"/>
                        @error('form.font_of_name') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>

                </div>

                <div class="row">
                    <div class="col-6">

                        <input
                            wire:model='form.barcode_width'
                            class="@error('form.barcode_width') is-invalid @enderror form-control contact-input"
                            type="number" placeholder="@lang('validation.attributes.barcode_width')"/>
                        @error('form.barcode_width') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>


                    <div class="col-6">
                        <input
                            wire:model='form.barcode_height'
                            class="@error('form.barcode_height') is-invalid @enderror form-control contact-input"
                            type="number" placeholder="@lang('validation.attributes.barcode_height')"/>
                        @error('form.barcode_height') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>

                </div>


                <div class="row">
                    <div class="custom-file-upload">
                        @if($file)
                            <img style='max-width:100%' src="{{ $file ? asset($file->path()) : ($certification ? $certification->file : '') }}" alt="">
                        @else
                            @isset($certification)
                                <img style='max-width:100%' src="{{$certification->file}}" alt="">
                            @endisset
                        @endif
                        <img src="{{asset('frontAssets')}}/imgs/wallet/upload.svg" alt="">
                        <span>@lang('validation.attributes.certification')</span>
                        <input wire:model='file' class='form-control @error('file') is-invalid @enderror' type="file"/>
                        @error('file') <p class="text-danger">{{$message}}</p> @enderror
                    </div>
                </div>

                <div class="btns text-center">
                    <button type="button" wire:click="previewCertification" class="button btn btn-primary big">@lang('site.preview')</button>
                    <button type='submit' class="button btn-red big my-5">@lang('site.save')</button>
                </div>

            </form>
        </div>
    </div>
</main>
@push('scripts')
    <script>
        Livewire.on('pdfGenerated', function (pdfUrl) {
            window.open(pdfUrl, '_blank');
        });
    </script>
@endpush

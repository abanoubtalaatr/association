<main class="main-content" xmlns="http://www.w3.org/1999/html">
    <!--head-->
    <x-admin.head/>
    <!--campaign-->
    @if (\Illuminate\Support\Facades\Session::has('import-error'))
        <div class="alert alert-danger">
            {{ \Illuminate\Support\Facades\Session::get('import-error') }}
        </div>
    @endif
    @if(isset($message))
        <div class="alert alert-info">{{$message}}</div>
    @endif
    <div class=" d-flex gap-4    mt-5 align-items-center">
        <div>

            <div class="mb-3">
                <label for="csvFile" class="form-label">{{ trans('site.users_for_course') }}</label>
                <input type="file" class="form-control" id="csvFile" wire:model="csvFile">
                @error('csvFile') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="d-grid gap-2">
                <button class="btn btn-primary" type="button" wire:click="import()" wire:loading.attr="disabled"
                        wire:target="import">
                    <span wire:loading wire:target="import" class="spinner-border spinner-border-sm" role="status"
                          aria-hidden="true"></span>
                    {{ trans('site.users_for_course') }}
                </button>
            </div>
        </div>
        <div>
            <button id="print-btn" wire:click="printCertifications" class="btn btn-danger" wire:loading.attr="disabled">
                <span>{{trans('site.print_certifications')}}</span>
                <span wire:loading wire:target="printCertifications" class="spinner-border spinner-border-sm"
                      role="status"
                      aria-hidden="true"></span>
            </button>
        </div>
        {{--        <div>third</div>--}}
    </div>
    <hr>
    <div class="border-div">
        <div class="b-btm">
            <h4>{{$page_title}}</h4>
        </div>
        <div class="edit-c">
            <form wire:submit.prevent='store'>
                <div class="row">

                    <div class="row">
                        <div class="col-6">
                            <input
                                wire:model='form.training_hours'
                                class="@error('form.training_hours') is-invalid @enderror form-control contact-input"
                                type="text" placeholder="@lang('validation.attributes.training_hours')"/>
                            @error('form.training_hours') <p class="text-danger">{{$message}}</p> @enderror
                            <hr/>
                        </div>

                        <div class="col-6">
                            <div class="contact-group date" data-provide="datepicker">
                                <label>@lang('validation.attributes.valid_to')</label>
                                <input wire:model='form.valid_to'
                                       class="@error('form.valid_to') is-invalid @enderror form-control" type='date'
                                       placeholder="@lang('validation.attributes.valid_to')">
                                @error('form.valid_to') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                            <hr>
                        </div>
                    </div>
                    <div class="col-12">
                        <input
                            wire:model='form.name'
                            class="@error('form.name') is-invalid @enderror form-control contact-input"
                            type="text" placeholder="@lang('validation.attributes.name')"/>
                        @error('form.name') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>


                    <div class="col-12">
    <textarea wire:model='form.description'
              class="@error('form.description') is-invalid @enderror form-control contact-input"
              placeholder="@lang('validation.attributes.description')">
    </textarea>
                        @error('form.description') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="contact-group date" data-provide="datepicker">
                        <label>@lang('validation.attributes.date')</label>
                        <input wire:model='form.date'
                               class="@error('form.date') is-invalid @enderror form-control" type='date'
                               placeholder="@lang('validation.attributes.date')">
                        @error('form.date') <p class="text-danger">{{$message}}</p> @enderror
                    </div>
                </div>
                <div class="btns text-center my-2">
                    <button type='submit' class="button btn-red big">@lang('site.save')</button>
                </div>

            </form>
        </div>
    </div>

    <table class="table-page table">
        <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">@lang('site.trainer_name')</th>
            <th class="text-center">@lang('validation.attributes.email')</th>
            <td class="text-center">@lang('validation.attributes.mobile_number')</td>
            <th>@lang('site.attend_course')</th>
            <th>@lang('site.pass_course')</th>
            <th>@lang('site.actions')</th>

        </tr>
        </thead>
        <tbody>
        @foreach($records as $record)
            <tr>
                <td>{{$loop->index +1}}</td>
                <td class='text-center'>{{$record->first_name .' '. $record->last_name}}</td>
                <td class='text-center'>{{$record->email}}</td>
                <td class='text-center'>{{$record->mobile}}</td>
                <td>
                    <div class="">
                        <div class="form-check" wire:key="attend-{{ $record->id }}">
                            <input class="form-check-input" type="checkbox" value="{{ $record->id }}"
                                   @if($record->pivot->attend_course && $record->pivot->attend_course == 1) checked
                                   @endif wire:click="attendCourseTrainer({{$record->id}})">
                        </div>
                    </div>
                </td>
                <td>
                    <div class="">
                        <div class="form-check" wire:key="pass-{{ $record->id }}">
                            <input class="form-check-input" type="checkbox" value="{{ $record->id }}"
                                   @if($record->pivot->pass_course && $record->pivot->pass_course == 1) checked
                                   @endif wire:click="passCourseTrainer({{$record->id}})">
                        </div>
                    </div>
                </td>
                <td>
                    <button class="no-btn" wire:click='deleteItem({{$record->id}})'><i class="fas fa-trash red"></i>
                    </button>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
</main>
<style>
    #spinner {
        display: none;
    }

    #print-btn.loading #spinner {
        display: inline-block;
        margin-left: 5px;
    }

    #print-btn.loading span {
        display: none;
    }
</style>
@push('scripts')
    <script>
        Livewire.on('reloadComponent', () => {
            Livewire.reload();
        });
    </script>
@endpush

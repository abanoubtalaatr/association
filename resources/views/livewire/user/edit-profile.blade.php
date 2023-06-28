@section('content')
<main class="main-content">
    <!--head-->
    <x-user.head/>
    <!--profile-->
    <div class="border-div">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="profile-head"><img src="{{auth('users')->user()->avatar_url}}" alt="">
                <h5>{{auth('users')->user()->name}}</h5>
                <p>{{auth('users')->user()->email}}</p>
            </div>
            <div class="profile-det">
                {{-- {!! dd($this->form) !!} --}}
                <div class="row">
                    <div class="col-md-6">
                        <input wire:model='form.username' class="form-control contact-input" type="text" placeholder="@lang('validation.attributes.username')">
                    </div>
                    <div class="col-md-6">
                        <input wire:model='form.address' class="form-control contact-input" type="text" placeholder="@lang('validation.attributes.address')"/>
                    </div>
                    <div class="col-md-6">
                        <input wire:model='form.email' class="form-control contact-input" type="text" placeholder="@lang('validation.attributes.email')">
                    </div>
                    <div class="col-md-6">
                        <input wire:model='form.mobile' class="form-control contact-input" type="text" placeholder="@lang('validation.attributes.mobile')">
                    </div>
                </div>
                <div class="text-center">
                    <button type='submit' class="button btn-red big">@lang('site.edit_profile')</button>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>

@endsection

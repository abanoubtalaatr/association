@extends('layouts.admin')
@section('content')
 <main class="main-content">
    <!--head-->
   <x-admin.head/>
    <!--table-->
    <div class="border-div">
    <div class="b-btm">
        <h4>@lang('site.control_ad_status')</h4>
    </div>
    <div class="row">
        <div class="col-lg-7">
            <div class="box-det mt-30">
                <div class="task-head">
                    <h5>{{$ad->title}}</h5>
                </div>
                <div class="task-body">
                    <div class="ad-details">
                        <form action="{{route('admin.ads.update',$ad)}}" method='POST'>
                            @csrf
                            <div class="form-group">
                                <label for="">@lang('site.status')</label>
                                <select name="new_status" class="form-control">
                                    @foreach($statuses as $status)
                                        <option {{$ad->status == $status? 'SELECTED' : ''}} value="{{$status}}">{{__('site.'.$status)}}</option>
                                    @endforeach
                                </select>
                                @error('new_status') <p class="text-danger">{{$message}}</p>@enderror
                            </div>

                            <button class="btn btn-success" type='submit'>@lang('site.save')</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>
@endsection


@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- <link rel="stylesheet" href="{{asset('frontAssets/css/multiselect.css')}}"> --}}
    <style>
        .whats-p{
        /* background: url('whats-app-b.png'); */
        width: 100%;
        float: right;
        padding-bottom: 15px;
      }
      .w-det{
        background: rgb(0, 0, 0,.05);
        border-radius:5px ;
        overflow: hidden;
      }
      .chat{
        background: #dbf8c7;
        /* margin: 10px 25px 3px 0px; */
        padding: 10px;
        background: #DCF8C6;

        width: 100%;

        display: block;
        border-radius: 5px;
        position: relative;
        box-shadow: 0px 2px 1px rgb(0 0 0 / 20%);
      }
      .chat p,.chat h5,.chat h4{color: rgb(89, 89, 89);text-decoration: none;}
      .chat a{text-decoration: none;}
      .chat .bubble-arrow.alt {
        position: absolute;
        bottom: 20px;
        left: auto;
        right: 4px;
        float: right;
        top: 0;
      }
      .chat .bubble-arrow:after {
        content: "";
        position: absolute;
        border-top: 15px solid #DCF8C6;
        transform: scaleX(-1);
        border-left: 15px solid transparent;
        border-radius: 4px 0 0 0px;
        width: 0;

      }
      .chat a{color: #4285f3;}
      .chat img{max-width: 100%;}
    </style>
@endpush


@extends('layouts.app')

@section('content')

<div class="row">
        <div class="col-sm-12 col-md-8">
            @if($congress->img)
                <img src="{{ asset('img/' . $congress->img) }}" style="display: block; width: 100%;">
            @endif
            <div style="margin-bottom: 30px;"></div>
           
            <div id="description" style="padding-bottom: 20px;">{!! $congress->descrizione !!}</div>
        </div>
        <div class="col-sm-12 col-md-4">
            <ul class="product-list list-group" style="padding-left: 0; list-style: none;">
                
                <li class="list-group-item"><strong>@lang('global.congress.fields.ind-sede')</strong><br>
                    <p>{{$congress->ind_sede}}</p></li>
                <li class="list-group-item"><strong>@lang('global.congress.fields.data-inizio')</strong><br>
                    <p style="margin: 10px 10px 0;">{{ $congress->data_inizio }}</p>
                </li>
                <li class="list-group-item"><strong>@lang('global.congress.fields.data-fine')</strong><br>
                    <p style="margin: 10px 10px 0;">{{$congress->data_fine}}</p>
                </li>
               
            </ul>
            
                <a href="#" class="btn btn-primary">Iscriviti</a>

        </div>
    </div>

@endsection
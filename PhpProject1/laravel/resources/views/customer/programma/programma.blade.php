@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')

<div class="mdl-card">
    <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">Programma</h2>
    </div>
    <div class="mdl-card__supporting-text">
        @if (count($days) > 0)
        <div id="accordion">
            @foreach($days as $day)
            <div class="card">
                <div class="card-header" id="card-{{$day->id}}">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#day-{{$day->id}}" aria-expanded="true" aria-controls="day-{{$day->id}}">
                            {{$day->nome}}
                        </button>
                    </h5>
                </div>
                <div id="day-{{$day->id}}" class="collapse" aria-labelledby="card-{{$day->id}}" data-parent="#accordion">
                    <div class="card-body">
                        {!! $day->descrizione !!}
                        <br>
                        <ul>
                            @if (count($day->sala) > 0)
                                @foreach($day->sala as $row)
                                <li>
                                    <strong>{{$row->nome}}</strong>
                                    @if(count($row->evento) > 0)
                                    <ul>
                                        @foreach($row->evento as $evento)
                                        <li>
                                            <strong>{{$evento->intervallo_orario}}</strong>
                                            {{$evento->nome}}
                                        </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </li>
                                @endforeach
                            @else
                                <li>@lang('global.app_no_entries_in_table')</li>
                            @endif                            
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach        
        </div>
        @endif
    </div>
</div>
@endsection
@section('javascript')
<script>
$('.collapse').collapse({
    toggle: false;
});    
</script>
@endsection
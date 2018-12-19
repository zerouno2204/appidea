@extends('layouts.app')

@section('content')


<div class="mdl-card" style="width: 100%;">
    <div class="mdl-card__title">
        <h2 class="page-title">@lang('global.congress.title')  @lang('global.app_edit')</h2>
    </div>
    <div class="mdl-card__supporting-text">

        {!! Form::model($congress, ['method' => 'PUT', 'route' => ['admin.congresses.update', $congress->id], 'files' => true,]) !!}


        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--12-col">
                {!! Form::label('nome', trans('global.congress.fields.nome').'', ['class' => 'control-label']) !!}
                {!! Form::text('nome', old('nome'), ['class' => 'form-control', 'placeholder' => '']) !!}
                <p class="help-block"></p>
                @if($errors->has('nome'))
                <p class="help-block">
                    {{ $errors->first('nome') }}
                </p>
                @endif
            </div>

            <div class="mdl-cell mdl-cell--12-col">
                {!! Form::label('descrizione', trans('global.congress.fields.descrizione').'', ['class' => 'control-label']) !!}
                {!! Form::textarea('descrizione', old('descrizione'), ['class' => 'form-control editor', 'placeholder' => '']) !!}
                <p class="help-block"></p>
                @if($errors->has('descrizione'))
                <p class="help-block">
                    {{ $errors->first('descrizione') }}
                </p>
                @endif
            </div>
        </div>
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--4-col-desktop">
                {!! Form::label('data_inizio', trans('global.congress.fields.data-inizio').'', ['class' => 'control-label']) !!}
                {!! Form::text('data_inizio', old('data_inizio'), ['class' => 'form-control date', 'placeholder' => '']) !!}
                <p class="help-block"></p>
                @if($errors->has('data_inizio'))
                <p class="help-block">
                    {{ $errors->first('data_inizio') }}
                </p>
                @endif
            </div>

            <div class="mdl-cell mdl-cell--4-col-desktop">
                {!! Form::label('data_fine', trans('global.congress.fields.data-fine').'', ['class' => 'control-label']) !!}
                {!! Form::text('data_fine', old('data_fine'), ['class' => 'form-control date', 'placeholder' => '']) !!}
                <p class="help-block"></p>
                @if($errors->has('data_fine'))
                <p class="help-block">
                    {{ $errors->first('data_fine') }}
                </p>
                @endif
            </div>

            <div class="mdl-cell mdl-cell--4-col-desktop">
               <label class="control-label">@lang('global.speakers-congress.fields.id-speaker')</label>
                <select name='realtori[]' multiple class="form-control select2">
                   @if(isset($relatori))
                        @foreach($relatori as $row)
                            <option value="{{$row->id}}" @if(old('relatori[]') || $congress_relatori->contains('id_speaker_id', $row->id)  ) selected @endif >{{$row->nome}} {{$row->cognome}}</option>
                        @endforeach
                    @endif
                </select>
                <p class="help-block"></p>
                @if($errors->has('relatori'))
                <p class="help-block">
                    {{ $errors->first('relatori') }}
                </p>
                @endif
            </div>
        </div>
        
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--6-col-desktop">
                @foreach($congress_hotel as $row)
                       @foreach($hotels as $hotel)
                            @if($row->id_hotel_id == $hotel->id)
                                <h3>{{$hotel->nome}}</h3>
                                @foreach($congress_room as $row)
                                    @foreach($rooms as $room)
                                        @if( ($room->id == $row->id_room) && ( $room->id_hotel_id == $hotel->id ) )
                                        <p>Titolo: {{$room->nome}}</p>
                                        <p>Prezzo: {{$room->prezzo}} €</p>
                                        <p>Posti Letto: {{$room->p_letto}}</p>
                                        <p>Prenotate: {{$row->qty}}</p>
                                        @endif
                                    @endforeach
                                @endforeach
                            @endif
                       @endforeach
                @endforeach
            </div>
        </div>

        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--6-col-desktop">
                <div class="form-group">
                    <label class="control-label">@lang('global.hotels.title')</label>
                    <select name="hotels[]" id="hotel-select" multiple class="form-control">
                        @if(isset($hotels))
                            @foreach($hotels as $hotel)
                                <option value="{{$hotel->id}}">{{$hotel->nome}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="mdl-cell mdl-cell--6-col-desktop">
                <div class="mdl-grid"  id="room-column"></div>
            </div>
        </div>

        <div class="mdl-grid">  
            <div class="mdl-cell mdl-cell--12-col">
                {!! Form::label('descr_sede', trans('global.congress.fields.descr-sede').'', ['class' => 'control-label']) !!}
                {!! Form::textarea('descr_sede', old('descr_sede'), ['class' => 'form-control editor', 'placeholder' => '']) !!}
                <p class="help-block"></p>
                @if($errors->has('descr_sede'))
                <p class="help-block">
                    {{ $errors->first('descr_sede') }}
                </p>
                @endif
            </div>
        </div>            
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--4-col-desktop">
                {!! Form::label('ind_sede', trans('global.congress.fields.ind-sede').'', ['class' => 'control-label']) !!}
                {!! Form::text('ind_sede', old('ind_sede'), ['class' => 'form-control', 'placeholder' => '']) !!}
                <p class="help-block"></p>
                @if($errors->has('ind_sede'))
                <p class="help-block">
                    {{ $errors->first('ind_sede') }}
                </p>
                @endif
            </div>
            <div class="mdl-cell mdl-cell--4-col-desktop">
                {!! Form::label('cap_sede', trans('global.congress.fields.cap-sede').'', ['class' => 'control-label']) !!}
                {!! Form::text('cap_sede', old('cap_sede'), ['class' => 'form-control', 'placeholder' => '']) !!}
                <p class="help-block"></p>
                @if($errors->has('cap_sede'))
                <p class="help-block">
                    {{ $errors->first('cap_sede') }}
                </p>
                @endif
            </div>
            <div class="mdl-cell mdl-cell--4-col-desktop">
                <label class="control-label">Email Referente</label>
                <input type="email" name="email_referente" value="{{$congress->email_referente}}" class="form-control">
            </div>
        </div>
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--6-col-desktop">
                {!! Form::label('id_citta_sede_id', trans('global.congress.fields.id-citta-sede').'', ['class' => 'control-label']) !!}
                {!! Form::select('id_citta_sede_id', $id_citta_sedes, old('id_citta_sede_id'), ['class' => 'form-control select2']) !!}
                <p class="help-block"></p>
                @if($errors->has('id_citta_sede_id'))
                <p class="help-block">
                    {{ $errors->first('id_citta_sede_id') }}
                </p>
                @endif
            </div>

            <div class="mdl-cell mdl-cell--6-col-desktop">
                {!! Form::label('id_prov_sede_id', trans('global.congress.fields.id-prov-sede').'', ['class' => 'control-label']) !!}
                {!! Form::select('id_prov_sede_id', $id_prov_sedes, old('id_prov_sede_id'), ['class' => 'form-control select2']) !!}
                <p class="help-block"></p>
                @if($errors->has('id_prov_sede_id'))
                <p class="help-block">
                    {{ $errors->first('id_prov_sede_id') }}
                </p>
                @endif
            </div>
        </div>
        
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--6-col">
                {!! Form::label('img', trans('global.congress.fields.img').'', ['class' => 'control-label']) !!}
                {!! Form::hidden('img', old('img')) !!}
                @if ($congress->img)
                <a href="{{ asset(env('UPLOAD_PATH').'/' . $congress->img) }}" target="_blank">Download file</a>
                @endif
                {!! Form::file('img', ['class' => 'form-control']) !!}
                {!! Form::hidden('img_max_size', 20) !!}
                <p class="help-block"></p>
                @if($errors->has('img'))
                <p class="help-block">
                    {{ $errors->first('img') }}
                </p>
                @endif
            </div>
            <div class="mdl-cell mdl-cell--6-col">
                {!! Form::label('pdf', trans('global.congress.fields.pdf').'', ['class' => 'control-label']) !!}
                {!! Form::hidden('pdf', old('pdf')) !!}
                @if ($congress->pdf)
                <a href="{{ asset(env('UPLOAD_PATH').'/' . $congress->pdf) }}" target="_blank">Download file</a>
                @endif
                {!! Form::file('pdf', ['class' => 'form-control']) !!}
                {!! Form::hidden('pdf_max_size', 5) !!}
                <p class="help-block"></p>
                @if($errors->has('pdf'))
                <p class="help-block">
                    {{ $errors->first('pdf') }}
                </p>
                @endif
            </div>
        </div>

        {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}



    </div>
</div>


@stop

@section('javascript')
@parent

<script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
<script src="//cdn.ckeditor.com/4.5.4/full/ckeditor.js"></script>
<script>
$('.editor').each(function () {
    CKEDITOR.replace($(this).attr('id'), {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
    });
});
</script>
<script>
    $(function () {
        moment.updateLocale('{{ App::getLocale() }}', {
            week: {dow: 1} // Monday is the first day of the week
        });

        $('.date').datetimepicker({
            format: "{{ config('app.date_format_moment') }}",
            locale: "{{ App::getLocale() }}",
        });

    });
</script>
<script>
    $(document).ready(function () {
        $('#hotel-select').multiselect({
            nonSeleectedText: 'Select Hotel',
            buttonWidth: '400px;',
            onChange: function (option, checked) {
                var selected = this.$select.val();
                //console.log(selected.length);
                var i = 0;
                if (selected.length > 0) {

                    $.ajax({
                        url: "{{url('/admin/ajax-get-rooms')}}",
                        method: "POST",
                        data: {_token: '{{csrf_token()}}', selected: selected},
                        success: function (data)
                        {
                            console.log(data);
                            $('#room-column').html('');
                            $.each(data, function (data, item) {
                                $('#room-column').append("<div class='mdl-cell mdl-cell--4-col-desktop'>" +
                                        "<p>" + item.nome + "<p>" +
                                        "<input type='hidden'  value='" + item.id + "'></div>" +
                                        "<div class='mdl-cell mdl-cell--8-col-desktop'><div class='mdl-grid' id='hotel-" + i + "'></div></div>");

                                $.each(item.rooms, function (item, rooms) {
                                    console.log(rooms);
                                    $('#hotel-' + i).append("<div class='mdl-cell--6-col-desktop form-check'>" +
                                            "<input type='checkbox' value='" + rooms.id + "' name='rooms[]' class='form-check-input' id='exampleCheck1'>" +
                                            "<label style='float: right; max-width: 90px;' class='form-check-label' for='exampleCheck1'> Tipo: " + rooms.descrizione + " Prezzo: " + rooms.prezzo + "€ Posti: " + rooms.p_letto + "</label>" +
                                            "</div>" +
                                            "<div class='mdl-cell--2-col-desktop'></div>" +
                                            "<div class='mdl-cell--4-col-desktop form-group'>" +
                                            "<input type='number' name='qty-" + rooms.id + "' class='form-control' value='0' min='0'>" +
                                            "</div>");
                                });
                                i++
                            });

                        },
                        error: function (data) {
                            console.log(data);
                        }

                    });

                }

            }
        });
    });
</script>
@stop
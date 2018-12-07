@extends('layouts.app')

@section('content')

<div class="mdl-grid">
    <h2>{{$congress->nome}}</h2>
    <div class="mdl-cell mdl-cell--12-        col-phone mdl-cell--8-col-desktop">
        @if($congress->img)
        <img src="{{ asset('img/'. $congress->img) }}" style="display: block; width: 100%;">
        @endif
        <div style="margin-bottom: 30px;"></div>

        <div id="description" style="padding-bottom: 20px;">{!! $congress->descrizione !!}</div>
    </div>
    <div class="mdl-cell--12-col-phone mdl-cell--4-col-desktop">
        <ul class="product-list list-group" style="padding-left: 0; list-style: none;">

            <li class="list-group-item"><strong>@lang('global.congress.fields.ind-sede')</strong><br>
                <p>{{$congress->ind_sede}}</p></li>
            <li class="list-group-item"><strong>@lang('global.congress.fields.data-inizio')</strong><br>
                <p style="margin: 10px 10px 0;">{{ $congress->data_inizio }}</p>
            </li>
            <li class="list-group-item"><strong>@lang('global.congress.fields.data-fine')</strong><br>
                <p style="margin: 10px 10px 0;">{{$congress->data_fine}}</p>
            </li>
            <li class="list-group-item">
                <a href="{{url('/admin/customer/registration/'.$congress->id)}}" class="mdl-button mdl-js-button mdl-button--primary" style="width: 100%; border: 1px solid;">Iscriviti</a>
            </li>
            <li class="list-group-item">
                <div id="map"></div>
            </li>

        </ul>       
    </div>
</div>
<script>
    // Initialize and add the map
    function initMap() {
        // The location of Uluru
        var congress = <?php echo json_encode($congress) ?>;
        //console.log(congress.lat);
        var uluru = {lat: parseFloat(congress.lat), lng: parseFloat(congress.lng)};
        // The map, centered at Uluru
        var map = new google.maps.Map(
                document.getElementById('map'), {zoom: 18, center: uluru, disableDefaultUI: true});
        
        // The marker, positioned at Uluru
        var marker = new google.maps.Marker({position: uluru, map: map});
    }
</script>
<!--Load the API from the specified URL
* The async attribute allows the browser to render the page while the API loads
* The key parameter will contain your own API key (which is not needed for this tutorial)
* The callback parameter executes the initMap() function
-->
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCp20T5LN8Yk8dW4TaLj6KvTpdSF8L223I&callback=initMap">
</script>
@endsection
@extends('layouts.app')
@section('content')

    <br>
    <div class="inner">
        <div class="content">
            <header>
                <h1>Results :</h1>
                <form action="/search" method="get">
                    <div>
                        <input type="text" id="searchTextInput"  name="searchTextInput" style="float: right" />
                        <br>
                        <br>
                        <br>
                        <input type="submit" id="submitSearch" style="float: right" />
                    </div>
                </form>
                <br>
            </header>
            @foreach($houses as $house)
                <h4><strong>Name of House: {{$house->name}}</strong></h4> <br>
                <h4><strong>Number of rooms: {{$house->roomcount}}</strong></h4>
                <h4><strong>Number of beds: {{$house->bedcount}}</strong></h4>
                <h4><strong>Type of house: {{$house->type->name}}</strong></h4>
                <h4><strong>Location: {{$house->location->name}}</strong></h4>
                <h4><strong>Description: <p>{{$house->description}}</p></strong></h4>
                <img src="{{$house->image}}" width="300" height="300" alt="no image"> <hr><br> <br>
            @endforeach
        </div>
    </div>
@endsection

@extends('layouts.landing')

@section('title','Services')

@section('content')
    <h1>Services</h1>
    @component('_components.card')
        @slot('title', 'Service 1')
        @slot('content', 'Lorem ipsum dolor sit amet.')
    @endcomponent
    @component('_components.card')
        @slot('title', 'Service 2')
        @slot('content', 'Lorem ipsum dolor sit amet consectetur adipisicing elit')
    @endcomponent
    @component('_components.card')
        @slot('title', 'Service 3')
        @slot('content', 'Lorem ipsum dolor.')
    @endcomponent
    @component('_components.card')
        @slot('title', 'Sercice 4')
        @slot('content')
            <h4>Example</h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti odit sit deleniti quod maiores consectetur eius deserunt asperiores exercitationem, mollitia, commodi vero laudantium similique aut maxime nihil qui accusantium magni!</p>
        @endslot
    @endcomponent
@endsection
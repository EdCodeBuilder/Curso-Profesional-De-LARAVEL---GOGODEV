@extends('layouts.app')

@section('content')
<a href="{{ route('note.index') }}">Back</a>
    <form action="">
        <label >Title:</label>
        <input type="text"/>
        <label >Description:</label>
        <input type="text"/>
        <input type="submit" value="Create"/>
    </form>
@endsection

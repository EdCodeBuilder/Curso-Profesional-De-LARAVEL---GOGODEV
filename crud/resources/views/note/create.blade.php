@extends('layouts.app')

@section('content')
<a href="{{ route('note.index') }}">Back</a>
    <form method="POST" action="{{ route('note.store') }}">
        @csrf
        <label >Title:</label>
        <input type="text" name="title"/><br/>
        {{-- tambien podemos modificar el estilo segun la clase a partir de la directiva @error()
        por ejemplo: class="@error('title') danger @enderror" --}}
        @error('title')
            <p style="color: red;">{{ $message }}</p>
        @enderror
        <label >Description:</label>
        <input type="text" name="description"/>
        @error('description')
            <p style="color: red;">{{ $message }}</p>
        @enderror
        <input type="submit" value="Create"/>
    </form>
@endsection

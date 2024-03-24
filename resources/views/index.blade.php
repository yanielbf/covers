@extends('layouts.master')

@section('content')
    <div id="app"></div>
@endsection

@section('scripts')
    <script>
        window.model = {!! json_encode($model) !!};
        window.urlGlb = {!! json_encode($url) !!};
    </script>
    @vite('resources/js/app.js')
@endsection
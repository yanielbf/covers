@extends('layouts.master')

@section('content')
<div ref="page" class="bg-white">
    <div>
        <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if(Session::has('message') )
                <div class="bg-green-500 px-2 py-1 rounded-md text-white mb-5 ">
                    {{ Session::get('message') }}
                </div>
            @endif
            <h1 class="mb-5 text-3xl font-semibold">Covers creados</h1>
            @foreach ($files as $file)
                <div class="flex w-full justify-between mb-2">
                    <div>{{ $file }}</div>
                    <a class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded flex items-center mb-4 md:mb-0" href="{{ url('delete-covers', ['parametro' => $file]) }}">Eliminar</a>
                </div>
            @endforeach
        </main>
    </div>
</div>
@endsection

@section('scripts')
@endsection
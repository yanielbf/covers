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
            <h1 class="mb-5 text-3xl font-semibold">Modelos creados</h1>
            @foreach ($models as $model)
                <div class="flex w-full gap-3 mb-2">
                    <div>{{ $model->name }}</div>
                    <div>{{ $model->identifier }}</div>
                    <div>{{ $model->path_glb }}</div>
                </div>
            @endforeach
        </main>
    </div>
</div>
@endsection

@section('scripts')
@endsection
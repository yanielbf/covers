<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Covers</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Mulish:wght@200&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        @vite('resources/css/app.css')
    </head>
    <body>
        <nav class="bg-gray-800">
            <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
              <div class="relative flex h-16 items-center justify-between">
                <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                  <div>
                    <div class="flex space-x-4">
                      <a href="/customize/modelo-x" class="{{ Request::is('customize*') ? 'bg-gray-900' : '' }} text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Creador de cover</a>
                      <a href="/created-models" class="{{ Request::is('created-models') ? 'bg-gray-900' : '' }} text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Crear modelos</a>
                      <a href="/created-covers" class="{{ Request::is('created-covers') ? 'bg-gray-900' : '' }} text-white rounded-md px-3 py-2 text-sm font-medium">Covers creados</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </nav>
        <div class="mt-10">
            @yield('content')
        </div>
        @yield('scripts')
    </body>
</html>
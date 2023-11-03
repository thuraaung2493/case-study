<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'ADMIN' }}</title>

    @vite('resources/css/app.css')
</head>

<div class="flex h-screen">
    <div class="px-4 py-2 bg-indigo-600 lg:w-1/4">
        <svg xmlns="http://www.w3.org/2000/svg" class="inline w-8 h-8 text-white lg:hidden"
            fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <div class="hidden lg:block">
            <div class="my-2 mb-6">
                <h1 class="text-2xl font-bold text-white">Admin Dashboard</h1>
            </div>
            <ul>
                <li
                    class="mb-2 rounded @if (Route::is('clients')) bg-gray-800 shadow @endif hover:shadow hover:bg-gray-800">
                    <a href="/admin/clients"
                        class="inline-block w-full h-full px-3 py-2 font-bold text-white">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="inline-block w-6 h-6 mr-2 -mt-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Clients
                    </a>
                </li>
                <li
                    class="mb-2 @if (Route::is('loans')) bg-gray-800 shadow @endif rounded hover:shadow hover:bg-gray-800">
                    <a href="/admin/loans"
                        class="inline-block w-full h-full px-3 py-2 font-bold text-white">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="inline-block w-6 h-6 mr-2 -mt-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                                clip-rule="evenodd" />
                        </svg>
                        Loans
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="w-full px-4 py-2 bg-gray-200 lg:w-full">
        <div class="container mx-auto mt-12">
            {{ $slot }}
        </div>
    </div>
</div>
</body>

</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Monitoring</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link href="/css/app.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="antialiased">
<div class="container p-10 mx-auto">
    <div class="grid grid-cols-2 bg-white mb-6 border-2 p-6 rounded-md">
        <div class="flex flex-col items-center">
            <p class="text-lg font-semibold">Average Response Time:</p>
            <p class="text-5xl font-semibold text-green-500">{{round($averageTime,2)}} seconds</p>
        </div>
        <div class="flex flex-col items-center">
            <p class="text-lg font-semibold">Online:</p>
            <p class="text-5xl font-semibold text-green-500">{{round($online,2)}} %</p>
        </div>
    </div>

    <table class="border-collapse w-full">
        <thead>
        <tr>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                Url
            </th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                Response
            </th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                Response Time
            </th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                DNS
            </th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                Status
            </th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                Created at
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($logs as $log)
            <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                    <span
                        class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Url</span>
                    {{ config('monitor.url') }}
                </td>
                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                    <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Response</span>
                    {{$log->http_code}}
                </td>
                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                    <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Response Time</span>
                    {{round($log->duration_request,2)}}
                </td>
                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                    <span
                        class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">DNS</span>
                    {{round($log->duration_dns,8)}}
                </td>
                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                    <span
                        class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">DNS</span>
                    @if($log->available)
                        <span class="rounded bg-green-400 py-1 px-3 text-xs font-bold">active</span>
                    @else
                        <span class="rounded bg-red-400 py-1 px-3 text-xs font-bold">unreachable</span>
                    @endif
                </td>
                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                    <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Created at</span>
                    {{$log->created_at}}
                </td>


            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>

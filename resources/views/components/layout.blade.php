@props(['type' => null, 'title'])

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.js"></script>
    <script src="https://unpkg.com/html5-qrcode"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">


    <title>{{ $title }}</title>
</head>

<body class="{{ in_array($type, ['login', 'signup']) ? 'bg-gray-900' : 'bg-gray-100' }}">
    <div class="flex h-screen overflow-hidden {{ in_array($type, ['login']) ? 'items-center justify-center' : '' }}">
        @unless (in_array($type, ['login', 'signup']))
            <x-navbar></x-navbar>
        @endunless


        <!-- Main Content -->
        <main
            class="flex-1 p-6 {{ in_array($type, ['login', 'signup']) ? 'bg-gray-900' : 'bg-gray-100' }} overflow-y-auto"
            style="scrollbar-width:none; -ms-overflow-style:none;">
            @unless (in_array($type, ['login', 'signup', 'dashboard']))
                <br class="block md:hidden">
                <x-header>{{ $title }}</x-header>
            @endunless
            {{ $slot }}
            
        </main>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-notification />
</body>

</html>

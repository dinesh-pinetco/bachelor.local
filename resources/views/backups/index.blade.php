<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <main class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1>Backups</h1>
                </div>
                <div class="col-md-6 text-right">
                    <a href="{{ route('backups.create') }}" class="btn btn-primary">Create Backup</a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>File Name</th>
                                <th>Size</th>
                                <th>Last Modified</th>
                                <th>Download</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($files as $file)
                                <tr>
                                    <td>
                                        {{ $file['name'] }}
                                    </td>
                                    <td>{{ $file['size'] }} MB</td>
                                    <td>{{ $file['lastModified']->format('d.m.Y H:i') }}</td>
                                    <td>
                                        <a href="{{ $file['url'] }}" target="_blank">
                                            <button name="download" class="btn btn-primary">Download</button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Scripts -->
<script src="{{ asset('js/manifest.js') }}" defer></script>
<script src="{{ asset('js/vendor.js') }}" defer></script>
<script src="{{ asset('js/app.js') }}" defer></script>

</body>
</html>

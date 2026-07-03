<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Laravel App')</title>

    {{-- scripts --}}
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    {{-- styles --}}
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
    <header>
        <div class="d-grid gap-2 d-md-flex justify-content-center p-5 bg-gray">
            <h1>Task Managment</h1>
        </div>
    </header>

    <main class="container">
        <div>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="{{__('Add new task')}}" aria-label="{{__('Add new task')}}" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="button"  id="addNewTask">New Task </button>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2026 My Laravel App</p>
    </footer>
</body>
</html>

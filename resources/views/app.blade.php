<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Laravel App')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
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

    <main class="container" style="min-height: calc(100vh - 152px - 40px)">
        <div>
            <div class="input-group mb-3">
                <input type="text" name="title" class="form-control create-task" placeholder="{{__('Add new task')}}">
                <button class="btn btn-outline-secondary" type="button"  id="addNewTask">New Task</button>
            </div>
        </div>

        <div class="card border-0 shadow-sm overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-secondary text-uppercase fs-7 fw-semibold">
                        <tr>
                    <th scope="col" class="ps-4" style="width: 80px;">#</th>
                    <th scope="col">title</th>
                    <th scope="col" style="width: 150px;">is completed</th>
                    <th scope="col" class="text-end pe-4" style="width: 120px;">actions</th>
                    </tr>
                    </thead>
                    <tbody id="tableBody">
                        
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <footer class="d-flex justify-content-center">
        <p>&copy; Guy Michelevitz </p>
    </footer>
</body>
</html>

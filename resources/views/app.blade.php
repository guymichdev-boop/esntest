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
<body style="background-color: #f8f8f6;">
    <header class="container my-4">
        <div class="d-flex justify-content-center p-5 rounded-4 border" style=" border-color: #eaeaea !important;">
            <h1 class="display-6 fw-bold mb-0 text-dark" style="letter-spacing: -0.5px;">Task Management</h1>
        </div>
    </header>

    <main class="container" style="min-height: calc(100vh - 194px - 40px)">
        <div>
            <div class="input-group mb-4">
                <input type="text" name="title" class="form-control create-task" placeholder="{{__('Add new task')}}">
                <button class="btn btn-outline-secondary" type="button"  id="addNewTask">Add Task</button>
            </div>
            <span class="title-error text-danger" style="display: none"></span>
        </div>

        <div class="my-4">
            <div class="btn-group border rounded-pill p-1 bg-white shadow-sm" role="group">
                
                <input type="radio" class="btn-check" name="filter" id="filterAll" value="all" autocomplete="off" checked>
                <label class="btn btn-sm btn-light border-0 rounded-pill px-3 py-1.5" for="filterAll">
                    All
                </label>

                <input type="radio" class="btn-check" name="filter" id="filterNotComplete" value="0" autocomplete="off">
                <label class="btn btn-sm btn-light text-secondary border-0 rounded-pill px-3 py-1.5" for="filterNotComplete">
                    Not completed
                </label>

                <input type="radio" class="btn-check" name="filter" id="filterCompleted" value="1" autocomplete="off">
                <label class="btn btn-sm btn-light text-secondary border-0 rounded-pill px-3 py-1.5" for="filterCompleted">
                    completed
                </label>
                
            </div>
        </div>

        <div class="card border-0 shadow-sm overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-secondary text-uppercase fs-7 fw-semibold">
                        <tr>
                    <th scope="col" class="text-center" style="width: 80px;">#</th>
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

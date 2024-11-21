<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/v/dt/dt-2.1.8/datatables.min.css" rel="stylesheet">
</head>
<body>

    @include('layouts.header')

    <div class="container mx-auto py-8">
        @yield('content')
    </div>
    
    @include('layouts.footer')
    

    
       
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.datatables.net/v/dt/dt-2.1.8/datatables.min.js"></script>
    <script>
        new DataTable('#example', {
            search: {
                return: true
            }
        });
    </script>
    
</body>
</html>
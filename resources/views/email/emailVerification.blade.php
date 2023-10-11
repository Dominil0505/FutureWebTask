<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Komment jött</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <!-- Font-awesome link -->
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/a250413ada.js" crossorigin="anonymous"></script>
</head>

<body>

    <div class="card">
        <h5 class="card-header bg-dark text-white">FeatureWeb</h5>
        <div class="card-body">
            <h5 class="card-title">Email cím visszaigazolás</h5>
            <p class="card-text">Kattintson a gombra.</p>
            <a href="http://127.0.0.1:8000/account/verify/{{ $token }}" class="m-3 btn btn-primary">Email
                visszaigazolás</a>
        </div>
    </div>


</body>

</html>

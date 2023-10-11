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

    <!-- Font-awesome link -->
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/a250413ada.js" crossorigin="anonymous"></script>
</head>

<body>

        <div class="card">
            <h5 class="card-header bg-dark text-white">FeatureWeb</h5>
            <div class="card-body">
                <h5 class="card-title">Kedves felhasználó!</h5>
                <p class="card-text">Új komment érkezett a(z) {{ $postTitle }} poszthoz.</p>
                <p class="card-text">Komment tartalma: {{ $comment->content }}</p>
                <a href="{{ url('http://127.0.0.1:8000/posts/'.$postTitle) }}" class="btn btn-primary">Poszthoz</a>
            </div>
        </div>


</body>

</html>

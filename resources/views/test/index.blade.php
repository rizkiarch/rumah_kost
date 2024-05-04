<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="jumbotron text-center">
        <h1>Sangcahaya.id</h1>
        <p>Cara Kirim Notifikasi Whatsapp Pada Laravel Dengan Wablas Whatsapp Gateway</p>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-4">

                <form action="{{ route('test.store') }} " method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="number">No WA</label>
                        <input type="text" name="phone" class="form-control" id="number" placeholder="No WA">
                    </div>
                    <div class="form-group">
                        <label for="\">Pesan</label>
                        <textarea name="message"
                            class="form-control" cols="30" rows="5" placeholder="Pesan"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
    </div>

</body>

</html>

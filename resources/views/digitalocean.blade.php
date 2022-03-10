<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DigitalOcean Spaces File Upload</title>
</head>
<body>
    
    <form method="POST" action="/digitalocean" enctype="multipart/form-data">
		@csrf
        <input type="file" name="image">
        <button type="submit">Upload Image</button>
    </form>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
</body>
</html>
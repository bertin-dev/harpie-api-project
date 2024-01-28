<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
</head>
<body>
    Hi <br/>
    Change your password <a href="http://localhost:8000/reset/{{$data}}">click here</a><br/>
    resetcode : <strong>{{$data}}</strong>
</body>
</html>
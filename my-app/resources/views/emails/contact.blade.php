<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite(['/resorces/css/app.css', '/resources/js/app.js'])
  <title>Document</title>
</head>
<body>
  <h1>{{ $role === 'admin' ? 'お問い合わせ' : 'お問い合わせ内容' }}</h1>

  <p>Name: {{ $contact['name'] }}</p>
  <p>Email: {{ $contact['email'] }}</p>
  <p>Message: {{ $contact['message'] }}</p>
</body>
</html>
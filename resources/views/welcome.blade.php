<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Шифр двойной перестановки</title>
</head>

<body>
    <form action="/handler" method="POST">
        <input type="text" name="src" placeholder="Текст для шифрования/дешифрования">
        <button name="func" value="encrypt">Шифровать</button>
        <button name="func" value="decrypt">Дешифровать</button>
        @csrf
    </form>
</body>

</html>
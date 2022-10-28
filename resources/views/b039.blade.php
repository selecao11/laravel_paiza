<!DOCTYPE html>
<html>
    <head>b039
    </head>
    <body >
    <form action="/B039" method="POST">
   {{ csrf_field() }}
    </form>
    @isset($grapes)
    {{$grapes}}
    以下。。入力データ<br>
    @endisset<br><br>
</body>
</html>

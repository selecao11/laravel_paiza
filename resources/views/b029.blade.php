<!DOCTYPE html>
<html>
    <head>b029
    </head>
    <body >
    <form action="/B029" method="POST">
   {{ csrf_field() }}
    </form>
    Paiza プログラムスキルチェック <br>
    B029:地価の予想問題<br>
    @isset($grapes)
     平均値は{{$avg}}です。<br>
    @endisset<br><br>
    {{$message}}
    
</body>
</html>

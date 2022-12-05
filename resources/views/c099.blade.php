<!DOCTYPE html>
<html>
    <head>C099
    </head>
    <body >
    
    <form action="/C099" method="POST">
    <input name="count" type="text" value="">枚数<br>
    <input name="len" type="text" value="">長さ<br>    
    <input class="xxxxx" type="submit" value="Click Me!">
    {{ csrf_field() }}
</form>
これはいかん！！！

@error('title')
ERR {{$message }}<br>
count= {{$count}}<br>
len= {{$len}}<br>
@enderror

以下。。入力データ<br>
<br>
3 6<br>
2<br>
1<br>
@isset($area)
    {{$area}}
@endisset<br><br>

</body>
</html>

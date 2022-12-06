<!DOCTYPE html>
<html>
    <head>C099
    </head>
    <body >
    
    <form action="/C099" method="POST">
    <input name="count" type="text" value="{{old('count')}}">枚数<br>
    <input name="len" type="text" value="{{old('len')}}">長さ<br>    
    <input class="xxxxx" type="submit" value="Click Me!">
    {{ csrf_field() }}
</form>
@if ($errors->has('count'))
			  <span class="text-danger">{{$errors->first('count')}}<br></span>
@endif
@if ($errors->has('len'))
			  <span class="text-danger">{{$errors->first('len')}}<br></span>
@endif

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

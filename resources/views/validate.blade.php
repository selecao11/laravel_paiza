<!DOCTYPE html>
<html>
    <head>validate
    </head>
    <body >
    
    <form action="/validate" method="POST">
    <input name="count" type="text" value="{{old('count')}}">タイトル<br>
    <input name="len" type="text" value="{{old('len')}}">ボディ<br>    
    <input class="xxxxx" type="submit" value="Click Me!">
    {{ csrf_field() }}
</form>
validated<br>
@error('count')
  <li>{{$message}}</li>
@enderror
@error('len')
  <li>{{$message}}</li>
@enderror


</body>
</html>

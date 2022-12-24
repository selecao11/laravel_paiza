<!DOCTYPE html>
<html>
    <head>validate
    </head>
    <body >
    <form action="/validate" method="POST">
    <input name="title" type="text" value="{{old('title')}}">タイトル<br>
    <input class="xxxxx" type="submit" value="Click Me!">
    {{ csrf_field() }}
</form>
validated<br>
　17：46
@if ($errors->has('title'))
  <span class="text-danger">{{$errors->first('title')}}</span>
@endif

</body>
</html>

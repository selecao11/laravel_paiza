<!DOCTYPE html>
<html>
    <head>regular
    </head>
    <body >
    <form action="/regular" method="POST">
    <input name="title" type="text" value="{{old('title')}}">タイトル<br>
    <input class="xxxxx" type="submit" value="Click Me!">
    {{ csrf_field() }}
</form>
regular<br>
@if ($errors->has('title'))
  <span class="text-danger">{{$errors->first('title')}}</span>
@endif

</body>
</html>

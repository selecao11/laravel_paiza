<!DOCTYPE html>
<html>
    <head>b035
    </head>
    <body >
    <form action="/B035" method="POST">
   {{ csrf_field() }}
    </form>
以下。。入力データ<br>
aa 10<br>
bb 20<br>
cc 2<br>
aa 1:00 2<br>
bb 2:02 1<br>
cc 2:02 1<br>
cc 4:02 5<br>
<br>

    @isset($last_Month_total)
    <table border = "1">
        <tr>
            <td>
            <table border = "1">
            先月　順位
            <tr>
                    <td>
                        氏名
                    </td>
                    <td>
                        距離(km)
                    </td>
            </tr>
            @foreach($last_Month_total as $k=> $v)
                <tr>
                <td>
                        {{$k}}
                </td>
                <td>
                        {{$v}}
                </td>
                </tr>
            @endforeach
            </table>
            </td>
            <td>
            →
            </td>
            <td>
            <table border = "1">
            今月　実績
            <tr>
                <td>
                    氏名
                </td>
                <td>
                    距離(km)
                </td>
            </tr>
            @foreach($this_month_data as $line)
                <tr>
                @foreach($line as $k=>$v)
                <td>
                        {{$v}}
                </td>
                 @endforeach
                </tr>
            @endforeach
            </table>
            </td>
            <td>
            →
            </td>
            <td>
            <table border = "1">
            今月　順位
            <tr>
                <td>
                    氏名
                </td>
                <td>
                    距離(km)
                </td>
                <td>
                    変動
                </td>
            </tr>
           @foreach($comp_Top10 as  $line)
                <tr>
                @foreach($line as  $v)
                    <td>
                        {{$v}}
                    </td>
                @endforeach
                </tr>
            @endforeach
            </table>
        </td>
        </tr>
    </table>
    <table border = "1">
    @endisset<br><br>

</body>
</html>

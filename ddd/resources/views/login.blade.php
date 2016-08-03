<form action="login" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <table>
    <tr>
        <td>姓名</td>
        <td><input type="text" name="name"></td>
    </tr>
    <tr>
        <td>密码</td>
        <td><input type="password" name="pwd"/></td>
    </tr>
    <tr>
        <td><input type="submit" value="提交"/></td>
    </tr>
    </table>
</form>
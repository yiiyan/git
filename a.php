<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Document</title>
</head>
<body>
<table>
    <form action="b.php" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <tr>
            <td><input type="text" name="title"/></td>
            <td><input type="submit" value="提交"/></td>
        </tr>
    </form>
</table>
</body>
</html>
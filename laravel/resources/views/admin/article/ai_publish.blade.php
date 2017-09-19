<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <title>图片抓取</title>
</head>
<style type="text/css">
        #url{
                color:mediumvioletred;
                width:500px;
                height:30px;
        }
</style>
<body>
<form type="text" action="{{url('admin/article/ai_article')}}" action="get">
        <label>抓取图片：</label>
        <input id='url' type="text" name="url" placeholder="输入抓取页面网址">
        <input type="submit" value="action" style="width:60px;height: 36px">
</form>
</body>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>文章预览</title>

</head>
<body id="main">

<script>
    var storage = JSON.parse(localStorage.getItem("ueditor_preference"))
    document.querySelector("#main").innerHTML = storage.modu_article;
</script>
</body>
</html>
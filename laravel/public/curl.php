<?php  
    header('content-type:text/html;charset=utf-8');  
     set_time_limit(0);//抓取不受时间限制  
     if($_POST['Submit']=="开始抓取"){  
      $URL=$_POST['link'];  
      get_pic($URL);  
     }              
     function get_pic($pic_url) {  
      //获取图片二进制流  
      $data=CurlGet($pic_url);  
      //利用正则表达式得到图片链接  
      $pattern_src1 = '/<img.*?src\=\"(.*\.jpg).*?>/';//只匹配jpg格式的图片  
      $pattern_src2 = '/<img.*?src\=\"(.*\.bmp).*?>/';//只匹配bmp格式的图片  
      $pattern_src3 = '/<img.*?src\=\"(.*\.png).*?>/';//只匹配png格式的图片  
      $pattern_src4 = '/<img.*?src\=\"(.*\.gif).*?>/';//只匹配gif格式的图片  
      $num1 = preg_match_all($pattern_src1, $data, $match_src1);  
      $num2 = preg_match_all($pattern_src2, $data, $match_src2);  
      $num3 = preg_match_all($pattern_src3, $data, $match_src3);  
      $num4 = preg_match_all($pattern_src4, $data, $match_src4);  
      $arr_src1=$match_src1[1];//获得图片数组  
      $arr_src2=$match_src2[1];  
      $arr_src3=$match_src3[1];  
      $arr_src4=$match_src4[1];  
      echo '=============================================抓取开始=============================================<br />';  
      get_name1($arr_src1);  
      get_name1($arr_src2);  
      get_name1($arr_src3);  
      get_name1($arr_src4);  
      get_name2($arr_src1);  
      get_name2($arr_src2);  
      get_name2($arr_src3);  
      get_name2($arr_src4);  
       
      echo '=============================================抓取结束=============================================<br />';  
      return 0;  
     }  
       
     function get_name1($pic_arr){  
      //图片编号和类型  
      $pattern_type = '/.*\/(.*?)$/';  
       
      foreach($pic_arr as $pic_item){//循环取出每幅图的地址  
       $num = preg_match_all($pattern_type,$pic_item,$match_type);  
       //以流的形式保存图片  
       $write_fd = @fopen($match_type[1][0],"wb");  
       echo "图片网址：<a href='".$pic_item."' target='_blank'>".$pic_item."</a><br />";  
       @fwrite($write_fd, CurlGet($pic_item));  
       @fclose($write_fd);  
      }  
      return 0;  
     }  
      function get_name2($pic_arr){  
      //图片编号和类型  
      $pattern_type = '/.*\/(.*?)$/';  
       
      foreach($pic_arr as $pic_item){//循环取出每幅图的地址  
       $num = preg_match_all($pattern_type,$pic_item,$match_type);  
       //以流的形式保存图片  
       $write_fd = @fopen($match_type[1][0],"wb");  
       echo "图片网址：<a href='".$_POST['link'].$pic_item."' target='_blank'>".$_POST['link'].$pic_item."</a><br />";  
       @fwrite($write_fd, CurlGet($_POST['link'].$pic_item));  
       @fclose($write_fd);  
      }  
      return 0;  
     }  
     //抓取网页内容  
     function CurlGet($url){  
      $url=str_replace('&','&',$url);  
      $curl = curl_init();  
      curl_setopt($curl, CURLOPT_URL, $url);  
      curl_setopt($curl, CURLOPT_HEADER, false);  
       
      //curl_setopt($curl, CURLOPT_REFERER,$url);  
      curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; SeaPort/1.2; Windows NT 5.1; SV1; InfoPath.2)");  
      curl_setopt($curl, CURLOPT_COOKIEJAR, 'cookie.txt');  
      curl_setopt($curl, CURLOPT_COOKIEFILE, 'cookie.txt');  
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  
      curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 0);  
      $values = curl_exec($curl);  
      curl_close($curl);  
      return $values;  
     }      
    ?>  
    <html>  
     <head>  
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
      <title>网页图片抓取</title>  
     </head>  
     <body>  
      <form action="" method="post">  
       要抓取图片的网址：<input type="text" id="link" name="link" value="请在这里输入要抓取图片的网址" OnClick="this.value=''" size="100" /><br />  
       <input type="submit" id="Submit" name="Submit" value="开始抓取" />  
      </form>  
     </body>  
    </html> 
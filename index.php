<?php

  include 'db.class.php';
  $db = new db();
  $sql = "select * from img where isshow = 1 order by  rand() limit 34";
  $img_list = $db->get_all($sql);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="./wall2/css/page.css" rel="stylesheet" type="text/css" />
<title>中国数字科技馆</title>
</head>
<body>
<style>
    .position1 img{
  width:53px;   height:53px;
}
  .position2 img{
  width:137px;  height:137px;
}
  .position3 img{
  width:77px;   height:77px;
}
  .position4 img{
  width:62px;   height:62px;
}
  .position5 img{
  width:62px;   height:62px;
}
  .position6 img{
  width:62px;   height:62px;
}
  .position7 img{
  width:62px;   height:62px;
}
  .position8 img{
  width:79px;   height:79px;
}
  .position9 img{
  width:57px;   height:57px;
}
  .position10 img{
  width:57px;   height:57px;
}
  .position11 img{
  width:57px;   height:57px;
}
  .position12 img{
  width:57px;   height:57px;
}
  .position13 img{
  width:57px;   height:57px;
}
  .position14 img{
  width:57px;   height:57px;
}
  .position15 img{
  width:57px;   height:57px;
}
  .position16 img{
  width:37px;   height:37px;
}
  .position17 img{
  width:95px;   height:95px;
}
  .position18 img{
  width:95px;   height:95px;
}
  .position19 img{
  width:95px;   height:95px;
}
  .position20 img{
  width:95px;   height:95px;
}
  .position21 img{
  width:90px;   height:90px;
}
  .position22 img{
  width:82px;   height:82px;
}
  .position23 img{
  width:78px;   height:78px;
}
  .position24 img{
  width:64px;   height:64px;
}
  .position25 img{
  width:40px;   height:40px;
}
  .position26 img{
  width:40px;   height:40px;
}
  .position27 img{
  width:40px;   height:40px;
}
  .position28 img{
  width:40px;   height:40px;
}
  .position29 img{
  width:66px;   height:66px;
}
  .position30 img{
  width:82px;   height:82px;
}
  .position31 img{
  width:58px;   height:58px;
}
  .position32 img{
  width:58px;   height:58px;
}
  .position33 img{
  width:102px;  height:102px;
}
  .position34 img{
  width:97px;   height:97px;
}
</style>
<div class="wrap">

<?php
  if($img_list){
    $i=1;
    foreach ($img_list as $key => $value) {
      $n = explode(".", $value['path']);
?>
    <div class="position<?php echo $i;?>"><img src="./data/<?php echo $value['path']; ?>"  height="90%" width="90%"/></div>
<?php
    $i++;
    }
  }
 ?>
  
</div>
</body>
</html>

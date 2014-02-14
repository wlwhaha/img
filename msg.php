<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>上传照片</title>
	<script type="text/javascript" src="./js/jquery.js"></script>
	<link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>
	
	<div class="img_c"  id="img_c" >
		<p style=" color: #999999;
    cursor: pointer;
    text-align: center;height:300px;line-height:300px;">
			保存成功，审核通过后可显示到首页
		</p>
	</div>

	<a href="./img.php" class="btn_addPic" style="margin-top:10px;">
		<span>
			<em>+</em>再传一张
		</span>
	</a>

	<a href="javascript:void(0);" onclick="closewin" class="btn_addPic" style="margin-top:10px;">
		<span>
			<em>+</em>关闭页面
		</span>
	</a>
	<script>
		function closewin(){
			self.opener=null;
			self.close();
		}
	</script>
</body>
</html>
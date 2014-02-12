<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>上传照片</title>
	<script type="text/javascript" src="./js/jquery.js"></script>
	<link rel="stylesheet" type="text/css" href="./css/style.css">

	<script type="text/javascript" src="./js/farbtastic.js"></script>
<link rel="stylesheet" href="./css/farbtastic.css" type="text/css" />
<link type="text/css" rel="stylesheet" href="./css/jquery.dragval-1.0.css" />
<script src="./js/jquery-ui.min.js" type="text/javascript"></script>
<script src="./js/jquery.dragval-1.0-pack.js" type="text/javascript"></script>


</head>
<script  type="text/javascript">
	var canvas ;
	var ctx ;
	var i=3;

    function draw() {
        var img = new Image();
        img.src = "./upload/"+$('#imgurl').val();
        img.onload = function(){

			canvas.width = $('#img_b').width();

			var w =  canvas.width /img.width;

			canvas.height = img.height*w;

			var ptrn = ctx.createPattern(img,'no-repeat');
			//ctx.fillStyle = ptrn;
			ctx.drawImage(img,0,0,canvas.width,canvas.height);
        }
	}

	function myFunction(){

		 	canvas = document.getElementById('test');
			ctx = canvas.getContext('2d');


		    draw();

			ctx.font="40px Arial";
			//ctx.fillText("Hello World",10,50);

			ctx.lineWidth=10
			ctx.strokeStyle="red";

			 var pp=false;
			 //当鼠标按下时
			 $("#test").mousedown(function(e){
				ctx.lineWidth=$('#bisize').val()
				ctx.strokeStyle=$('#color').val()
			  	var mouseX = e.pageX - this.offsetLeft;
			  	var mouseY = e.pageY - this.offsetTop;
			   	pp=true;
			   	ctx.beginPath();
			   	ctx.moveTo(mouseX,mouseY); //起始位置
			 });

			 //当鼠标抬起时
			 $("#test").mouseup(function(e){
			   	pp=false;
			 });

			 //当鼠标移动时
			 $("#test").mousemove(function(e){
        			var mouseX = e.pageX - this.offsetLeft;
					var mouseY = e.pageY - this.offsetTop;
					if(pp){
						ctx.lineTo(mouseX,mouseY); //终止位置
						ctx.stroke();				//结束图形
					}
			 });

			$("#test").bind('touchstart touchmove touchend touchcancel', function ()
			{
				var touches = event.changedTouches, first = touches[0], type = "";

				switch (event.type)
				{
					case "touchstart": type = "mousedown"; break;
					case "touchmove": type = "mousemove"; break;
					case "touchend": type = "mouseup"; break;
					default: return;
				}

				var simulatedEvent = document.createEvent("MouseEvent");

				simulatedEvent.initMouseEvent(type, true, true, window, 1, first.screenX, first.screenY, first.clientX, first.clientY, false, false, false, false, 0/*left*/, null);
				first.target.dispatchEvent(simulatedEvent);
				event.preventDefault();
			});

	}
    $(function(){
        $('#text_btn').click(function(){

	    	$('#loading').show();
	    	$('#img_c').hide();
	    	$('#gj').hide();

        	$.post(
        		'upload.php',
        		{'data':canvas.toDataURL('image/jpeg')},
        		function(msg){
        			if(msg==1){
        				clock()
        			}else{
        				alert('保存失败')

        			}
        		}
        	);
        });
    });
</script>
<body style="width:100%">
<div id="loading" style=" display:none;position:fixed;left:50%; top:50%; padding-left:-18px; padding-top:-18px; width:36px; height:36px;"><img src="./images/loading.gif" width="36" height="36" alt=""></div>
<div id="gj" style="display:none;">
	<input type="hidden" id="color" name="color" value="#ef594d" />

	<div id="colorpicker"></div>
	<script type="text/javascript">
	$(document).ready(function() {
	$('#colorpicker').farbtastic('#color');
	});
	</script>
	<div style="clear:both"></div>

	<span>笔粗：</span>
	<div style="clear:both"></div>

	<div id="Slider" class="Dragval">
		<input type="text" id="bisize" style="display:none;" class="Output"   value="5" />
	</div>
	<script type="text/javascript">
	$(function() {
	$("#Slider").dragval({ step: 1, min: 1, max: 10, startValue: 5 });

	});
	</script>
	<div style="clear:both"></div>
	<div style="clear:both"></div>
	</div>
<div class="img_c"  id="img_c" style="display: none;">
	<div class="img_b" id='img_b'>
		<canvas id="test"></canvas>
	</div>
	<div class="btn_addPic" id="text_btn" style="width:98%;margin-bottom:3px;">
		<span>
			保存图片
		</span>
	</div>
</div>
<iframe id="upload_target" name="upload_target" src="./up.php" style="width:0;heigth:0;overflow:hidden;border:0;position: absolute; left:-500px;"></iframe>
<dl class="pic">
	<dt><img src="images/logo.png"></dt>
	<dd>感谢您参与中国数字科技馆的互动，点击下方添加图片按钮，用您的移动设备拍下喜欢的展品签字并保，待审核通过后会在大屏幕上显示，如果您的移动设备不支持直接拍照保存，请您先本地拍照在添加图片。</dd>
	
</dl>
<form action="./up.php" method="post" id="img_form"  enctype="multipart/form-data"target="upload_target" >
	<a href="javascript:void(0);" class="btn_addPic" style="margin-top:10px;">
		<span>
			<em>+</em><i id="addpic">添加图片</i>
			</span>
		<input onChange="up_img();" tabindex="3" title="支持jpg、jpeg、gif、png格式，文件小于5M" size="3" name="pic" class="filePrew" type="file">
	</a>
</form>
<div style="display:none;">
		<img id="tag_img" src=""  >	
	
</div>
<input type="hidden" id="imgurl" value=""/> 
<script>
	function up_img(){		
	$('#addpic').html('更换图片');

	    $('#img_form').submit();
	    $('#loading').show();
	    $('.pic').hide();
	}
	
	function closewin(){
self.opener=null;
self.close();
}

function clock(){
	i=i-1
	$('body').html('保存成功 审核通过后可显示到首页<br>'+"本窗口将在"+i+"秒后自动关闭!");
	if(i>0)setTimeout("clock();",1000);
	else closewin();
}
</script>

</body>
</html>
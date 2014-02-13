<?php
	ob_start();
	session_start();
	if(!$_SESSION['admin_log'])
        header("location:./login.php");

    $s = $_GET['s'] == 1?1:0;
    include 'db.class.php';
	$db = new db();
	$where = " isshow = {$s}";
	$sql = "select * from img where $where";
	$img_list = $db->get_all($sql);
 ?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta content="width=device-width,user-scalable=no" name="viewport">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <title></title>
        <script type="text/javascript" src="./bootstrap/js/jquery.js"></script>
        <script type="text/javascript" src="./bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css"/>
    </head>
    <body>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<div class="tabbable" id="tabs-582517">
					<ul class="nav nav-tabs">
						<li <?php if($s==0)echo 'class="active"'; ?> style="width:50%">
							<a href="./system.php?s=0" >未审核</a>
						</li>
						<li <?php if($s==1)echo 'class="active"'; ?> style="width:50%">
							<a href="./system.php?s=1" >已审核</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="panel-19408">
							<table class="table">
								<thead>
									<tr>
										<th width=10%>
											<input type="checkbox" name="" id="ckall">
											<?php if($s==0){?>
											<button class="btn btn-info" id="tgall" type="button">通过</button>
											<?php
											}?>
											<button class="btn btn-danger" id="delall"  type="button">删除</button>
										</th>
										<th>
											编号
										</th>
										<th width=60% style="text-align:center">
											缩略图
										</th>
										<th>
											操作
										</th>
									</tr>
								</thead>
								<tbody>
									<?php
										if($img_list){
											$i=1;
											foreach ($img_list as $key => $value) {
												 $n = explode(".", $value['path']);
									?>
											<tr <?php if($i%2==0)echo' class="success"'; ?>>
												<td>
													<input type="checkbox" class="ck" name="" value="<?php echo $value['id']; ?>" id="">
												</td>
												<td>
													<?php echo $value['id']; ?>
												</td>
												<td style="text-align:center">
													<img src="./data/<?php echo $n[0].'_thumb.jpg';?>" style="height:100px;" alt="">
												</td>
												<td>
													<?php if($s==0){?>
													<button class="btn btn-info" type="button" onclick="tongg(<?php echo $value['id'];?>,this)">通过</button>
													<?php
													}?>
													<button class="btn btn-danger" type="button"onclick="del(<?php echo $value['id'];?>,this)">删除</button>
												</td>
											</tr>
									<?php
											$i++;
											}
										}
									 ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
	function tongg(id,obj){
		$.post('./action.php?act=tongg', {'id':id}, function(data, textStatus, xhr) {
			if(data==0){
				alert('操作失败请重新操作');
				return;
			}
			rm(obj);

		});
	}

	function del(id,obj){
		if(!confirm('删除后不可恢复')){
			return;
		}

		$.post('./action.php?act=del', {'id':id}, function(data, textStatus, xhr) {
			if(data==0){
				alert('操作失败请重新操作');
				return;
			}
			rm(obj);

		});
	}

	function rm(obj){
		$(obj).parent().parent().remove();
	}

	$(function(){
		$('#ckall').click(function() {
			var flag = $(this).prop("checked");
			if(flag){
				$('.ck').prop("checked",'true')
			}else{
				$('.ck').prop("checked",false)
			}
		});

		$('#tgall').click(function(){
			var ids = "";
			$('.ck').each(function(index, val) {
				var flag = $(this).prop("checked");
				if(flag){
					ids +=$(this).val()+",";
				}
			});
			if(ids == "")
			{
				return
			}
			ids +="0";

			$.post('./action.php?act=tonggall', {'id':ids}, function(data, textStatus, xhr) {
				if(data==0){
					alert('操作失败请重新操作');
					return;
				}
				$('.ck').each(function(index, val) {
					var flag = $(this).prop("checked");
					if(flag){
						rm(this);
					}
				});

			});
		});


		$('#delall').click(function(){
			if(!confirm('删除后不可恢复')){
				return;
			}
			var ids = "";
			$('.ck').each(function(index, val) {
				var flag = $(this).prop("checked");
				if(flag){
					ids +=$(this).val()+",";
				}
			});
			if(ids == "")
			{
				return
			}
			ids +="0";

			$.post('./action.php?act=delall', {'id':ids}, function(data, textStatus, xhr) {
				if(data==0){
					alert('操作失败请重新操作');
					return;
				}
				$('.ck').each(function(index, val) {
					var flag = $(this).prop("checked");
					if(flag){
						rm(this);
					}
				});

			});
		});

	})
	</script>

	</body>
</html>

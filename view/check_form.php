<!-- CSS goes in the document HEAD or added to your external stylesheet -->
<style type="text/css">
table.hovertable {
	font-family: verdana,arial,sans-serif;
	font-size:11px;
	color:#333333;
	border-width: 1px;
	border-color: #999999;
	border-collapse: collapse;
}
table.hovertable th {
	background-color:#c3dde0;
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #a9c6c9;
}
table.hovertable tr {
	background-color:#d4e3e5;
}
table.hovertable td {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #a9c6c9;
}
</style>

<!-- Table goes in the document BODY-->
<form action="check.php" method="GET">
<table class="hovertable">
<tr>
	<th>想法id</th><th>想法名称</th><th>想法作者</th><th>详情简介</th><th>想法状态</th><th>管理员评价</th><th>操作</th>
</tr>

<?php
for ($i=0; $i<$pageSupport->current_records; $i++)
        {
            $name = $pageSupport->result[$i]["name"];
            $status_name= $pageSupport->result[$i]["status_name"];
            $user_name=$pageSupport->result[$i]["user_name"];
            $idea_ID= $pageSupport->result[$i]["idea_ID"];
            $reason=$pageSupport->result[$i]["reason"];
            //$idea_ID=$pageSupport->result[$i]['idea_ID'];
            
        //    $part=substr($content,0,400);
            //循环输出每条数据
            echo  "<tr onmouseover=\"this.style.backgroundColor='#ffff66';\" onmouseout=\"this.style.backgroundColor='#d4e3e5';\">
            <td>".$idea_ID."</td><td>".$user_name."</td><td>".$name."</td><td>"."</td><td>".$status_name."</td><td><input type=\"textarea\" textarea rows=\"3\" cols=\"20\" name=\"reason".$i."\"  value=".$reason." \/></td><td><select name=\"func".$i." \">
<option value=\"0\">待审核</option> 
<option value=\"1\">审核通过等待生产</option> 
<option value=\"2\">审核不通过</option>
            </td>
            </tr>";
         }
?>
</table>
<input type="submit" value="提交" />
</form>

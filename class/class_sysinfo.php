<?php
/******************
类名：sysinfo，功能，获取常用信息
1.获取用户ip
2.待定




********************/

class sysinfo 
{
	
	public static function getip(){
      	if(getenv('HTTP_CLIENT_IP')) { 
      		$onlineip = getenv('HTTP_CLIENT_IP');
      	} 
      	elseif(getenv('HTTP_X_FORWARDED_FOR')) { 
      		$onlineip = getenv('HTTP_X_FORWARDED_FOR');
      	} elseif(getenv('REMOTE_ADDR')) { 
      		$onlineip = getenv('REMOTE_ADDR');
      	} else { 
      		$onlineip = $HTTP_SERVER_VARS['REMOTE_ADDR'];
      	}
      	return $onlineip;
      }


}

?>
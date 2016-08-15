<?php
/**
 * 如何在终端输出带颜色的字体及php的pack
 * 参考：http://www.neatstudio.com/show-2568-1.shtml
 * shell下，输出字体颜色为绿色的Hello,world：echo -e "\033[32mHello,world\033[0m"
 * --------------------------------------------------------------------------
      \033[0m 关闭所有属性
      \033[1m 设置高亮度
      \033[4m 下划线
      \033[5m 闪烁
      \033[7m 反显
      \033[8m 消隐
      \033[30m 至 \33[37m 设置前景色
      \033[40m 至 \33[47m 设置背景色
      \033[nA 光标上移n行 
      \033[nB 光标下移n行
      \033[nC 光标右移n行
      \033[nD 光标左移n行
      \033[y;xH设置光标位置
      \033[2J 清屏
      \033[K 清除从光标到行尾的内容
      \033[s 保存光标位置 
      \033[u 恢复光标位置
      \033[?25l 隐藏光标
      \033[?25h 显示光标
      --------------------------------------------------------------------------
      各数字所代表的颜色如下：
      字背景颜色范围:40----49
      40:黑
      41:深红
      42:绿
      43:黄色
      44:蓝色
      45:紫色
      46:深绿
      47:白色
      字颜色:30-----------39
      30:黑
      31:红
      32:绿
      33:黄
      34:蓝色
      35:紫色
      36:深绿 
      37:白色
 */
function colorize($text, $status) {
	$out = "";
	switch ($status) {
		case "SUCCESS":
			$out = "[42m"; //Green background  
			break;
		case "FAILURE":
			$out = "[41m"; //Red background  
			break;
		case "WARNING":
			$out = "[43m"; //Yellow background  
			break;
		case "NOTE":
			$out = "[44m"; //Blue background  
			break;
		default:
			throw new Exception("Invalid status: " . $status);
	}
	return chr(27) . "$out" . "$text" . chr(27) . "[0m";
}

function colorfont($text, $status) {
	$out = "";
	switch ($status) {
		case "SUCCESS":
			$out = "[32m"; //Green background  
			break;
		case "FAILURE":
			$out = "[31m"; //Red background  
			break;
		case "WARNING":
			$out = "[33m"; //Yellow background  
			break;
		case "NOTE":
			$out = "[34m"; //Blue background  
			break;
		default:
			throw new Exception("Invalid status: " . $status);
	}
	return chr(27) . "$out" . "$text" . chr(27) . "[0m";
}

$content = "IC";
echo '字符:' . strlen($content) . "\n";
$packArr = array('s' => '有符号短整数 (16位，主机字节序)', 'S' => '无符号短整数 (16位，主机字节序)', 'c' => '有符号字符', 'C' => '无符号字符', 'I' => '无符号整数 (依赖机器大小及字节序)',
	'i' => '有符号整数 (依赖机器大小及字节序)', 'L' => '无符号长整数 (32位，主机字节序)', 'l' => '有符号长整数 (32位，主机字节序)', 'f' => '单精度浮点数 (依计算机的范围)',
	'd' => '双精度浮点数 (依计算机的范围)', 'n' => '无符号短整数 (16位, 大端字节序)', 'N' => '无符号长整数 (32位, 大端字节序)');
foreach ($packArr as $key => $value) {
	$content = pack($key, 0);   //cmd	
	echo 'pack-'.$key.':' . colorfont(strlen($content), 'NOTE') . '	' . colorfont($value, 'FAILURE') . "\n";
}
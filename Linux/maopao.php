<?php 
// 拿数组中相邻的元素进行比较  如果前一个数组元素的值要大于后一个元素的值那么就将两个元素的位置进行互换！
$arr=[1,3,6,2,43,23,12,25,18,4,6];
$length=count($arr);

for($i=0;$i<$length;$i++){
	for($j=0;$j<$i;$j++){
		if($arr[$j]>$arr[$i]){
			$temp=$arr[$j];
			$arr[$j]=$arr[$i];
			$arr[$i]=$temp;
		}
	}
}
echo '<pre>';
print_r($arr);

// 选择排序
// 假设当前第一个元素已经排序好，然后记住该元素的下标，拿着这个元素与后面的其他元素进行比较，如果比较之后发现后面的元素比当前元素还要小，记住当前的最小值为后面元素的下标。每一次遍历完数组都会发现一个最小元素的下标，最后进行一次交换。

$att=[1,3,6,2,43,23,12,25,18,4,6];

$length=count($att);
for($i=0;$i<$length;$i++){
	$min=$i;
	for($j=$i;$j<$length;$j++){
		if($arr[$min]>$arr[$j]){
			$min=$j;
		}
	}

	$temp=$att[$min];
	$att[$min]=$att[$i];
	$att[$i]=$temp;
}

print_r($att);
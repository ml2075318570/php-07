<?php
// 校验（客户端来的东西都不能信）

echo '123';
// 确保客户端提交了 ID
$id = $_GET['id'];

// 1. 读取已有数据
$json = file_get_contents('storage.json');
// 2. 反序列化
$songs = json_decode($json, true);
// 3. 遍历数组找到要删除的元素
foreach ($songs as $item) {
  if ($item['id'] === $id) {
    // 找到了要删除的数据
    // 4. 在数组中删除这个元素
    // 4.1. 找到这个数据在数组的下标
    $index = array_search($item, $songs);
    array_splice($songs, $index, 1);
    // 5. 将删除过后的数组序列化成 JSON 字符串
    $new_json = json_encode($songs);
    // 6. 持久化
    file_put_contents('storage.json', $new_json);
    break;
  }
}
// 跳转回去
header('Location: list.php');

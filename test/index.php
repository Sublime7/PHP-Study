<?php  
	$mysql_conf = array(
    'host'    => '127.0.0.1:3306', 
    'db'      => 'pm_dev', 
    'db_user' => 'root', 
    'db_pwd'  => '123456', 
    );

	$mysqli = @new mysqli($mysql_conf['host'], $mysql_conf['db_user'], $mysql_conf['db_pwd']);
	if ($mysqli->connect_errno) {
	    die("could not connect to the database:\n" . $mysqli->connect_error);//诊断连接错误
	}
	$mysqli->query("set names 'utf8';");//编码转化
	$select_db = $mysqli->select_db($mysql_conf['db']);

	if (!$select_db) {
	    die("could not connect to the db:\n" .  $mysqli->error);
	}

	$sql = "select * from admin_user where id = 1;";
	$res = $mysqli->query($sql);
	if (!$res) {
	    die("sql error:\n" . $mysqli->error);
	}
	while ($row = $res->fetch_assoc()) {
	    var_dump($row);
	}

	

	//连接本地的 Redis 服务
	$redis = new Redis();
	$redis->connect('127.0.0.1', 6379);
	echo "Connection to server successfully";
	//设置 redis 字符串数据
	$redis->set("tutorial-name", "Redis tutorial");
	// 获取存储的数据并输出
	echo "Stored string in redis:: " . $redis->get("tutorial-name");



	$res->free();
	$mysqli->close();
<?php
$servername = "localhost";
$username = "pl_podcasts";
$password = "podcasts";
$dbname="pl_podcasts";
$conn = NULL;

function get_db_conn() {
	global $servername;
	global $username;
	global $password;
	global $dbname;
	global $conn;
	if($conn == NULL) {
		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			/*
			echo "<!-- Connected successfully -->"; 
			echo "<!-- ";
			print_r($conn);
			echo " -->";
			*/
		} catch(PDOException $e) {
			echo "<!-- Connection failed: " . $e->getMessage() .  " -->";
			throw $e;
		}
	}
	
	return $conn;
}

function db_select_query($select, $from, $options=NULL) {
	$sqlline = "SELECT $select FROM $from";
	
	if($options!=NULL) {
		if($options['WHERE']!=NULL) {
			$sqlline .= " WHERE ".$options['WHERE'];
		}
		if($options['GROUP_BY']!=NULL) {
			$sqlline .= " GROUP BY ".$options['GROUP_BY'];
		}
		if($options['HAVING']!=NULL) {
			$sqlline .= " HAVING ".$options['HAVING'];
		}
		if($options['ORDER_BY']!=NULL) {
			$sqlline .= " ORDER BY ".$options['ORDER_BY'];
			if($options['ORDER']!=NULL && ($options['ORDER']=='ASC'||$options['ORDER']=='DESC')) {
				$sqlline .= " ".$options['ORDER'];
			}
		}
		if($options['LIMIT']!=NULL) {
			$sqlline .= " LIMIT ".$options['LIMIT'];
		}
		if($options['OFFSET']!=NULL) {
			$sqlline .= " OFFSET ".$options['OFFSET'];
		}
	}
	
	return $sqlline;
}
function simple_db_select($select, $from, $options=NULL) {
	$sqlline = db_select_query($select, $from, $options);
	
	try {
		$conn = get_db_conn();
		$stmt = $conn->prepare($sqlline); 
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		return $stmt->fetchAll();
	} catch(Exception $e) {
		throw $e;
	}
	return NULL;
}

function insert_podcast($data) {
	$conn = get_db_conn();
	try {
		$sql_txt = "INSERT INTO podcast (title, feed_url, link, author, image, local_image, subtitle, summary, description, folder, last_update, last_checked, ttl)";
		$sql_txt .= " VALUES (:title, :feed_url, :link, :author, :image, :local_image, :subtitle, :summary, :description, :folder, :last_update, :last_checked, :ttl)";
		$stmt = $conn->prepare($sql_txt); 
		$res = $stmt->execute($data);
		return $res;
	} catch(Exception $e) {
		echo "Error: " . $e->getMessage();
		return false;
	}
}
function update_podcast($idpdcst, $data) {
	$conn = get_db_conn();
	try {
		$sql_txt = "UPDATE podcast";
		$sql_txt .= " SET title=:title, feed_url=:feed_url, link=:link, author=:author, image=:image, local_image=:local_image, subtitle=:subtitle, summary=:summary, description=:description, folder=:folder, last_update=:last_update, last_checked=:last_checked, ttl=:ttl";
		$sql_txt .= " WHERE id=:idpdcst";
		$data['idpdcst'] = $idpdcst;
		$stmt = $conn->prepare($sql_txt); 
		$res = $stmt->execute($data);
		return $res;
	} catch(Exception $e) {
		echo "Error: " . $e->getMessage();
		return false;
	}
}
function delete_podcast($idpdcst) {
	$conn = get_db_conn();
	try {
		$sql_txt = "DELETE FROM podcast WHERE id=:idpdcst";
		$stmt = $conn->prepare($sql_txt);
		$stmt->bindParam(':idpdcst', $idpdcst, PDO::PARAM_INT);   
		$res = $stmt->execute();
		return $res;
	} catch(Exception $e) {
		echo "Error: " . $e->getMessage();
		return false;
	}
}
function insert_episode($idpdcst, $data) {
	$conn = get_db_conn();
	try {
		$sql_txt = "";
		$stmt = $conn->prepare($sql_txt); 
		$res = $stmt->execute($data);
		return $res;
	} catch(Exception $e) {
		echo "Error: " . $e->getMessage();
		return false;
	}
}
function update_episode($idpdcst, $idepsd, $data) {
	$conn = get_db_conn();
	try {
		$sql_txt = "";
		$stmt = $conn->prepare($sql_txt); 
		$res = $stmt->execute($data);
		return $res;
	} catch(Exception $e) {
		echo "Error: " . $e->getMessage();
		return false;
	}
}
function delete_episode($idpdcst, $idepsd) {
	$conn = get_db_conn();
	try {
		$sql_txt = "";
		$stmt = $conn->prepare($sql_txt); 
		$res = $stmt->execute($data);
		return $res;
	} catch(Exception $e) {
		echo "Error: " . $e->getMessage();
	}
}

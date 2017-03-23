<?php

Class Model_Interviews Extends Model_Base {
	
	public $id;
	public $id_user;
	public $ivtext;
	public $ivdatetime;
	
	public function fieldsTable(){
		return array(
			
			'id' => 'Id',
			'id_user' => 'User ID',
			'ivtext' => 'Title',
			'ivdatetime' => 'Date Create'

		);
	}

	public function getLastWithUsers($n){
		$sql = 'SELECT id_iv, ivtext, UNIX_TIMESTAMP(ivdatetime) as ivdatetime , users.id_user, firstname, lastname
                  FROM interviews
                  INNER JOIN users ON users.id_user = interviews.id_user ORDER BY id_iv DESC LIMIT '.$n;
		try{
			$db = $this->db;
			$stmt = $db->query($sql);
			//var_dump($sql);exit;
			$rows = $stmt->fetchAll();
			$this->dataResult = $rows;
		}catch(PDOException $e) {
			echo $e->getMessage();
			exit;
		}

		return $rows;
	}

    public function getForShow($id){

        $sqlSelectIV = 'SELECT *
                FROM interviews
                WHERE id_iv = ?'; //выбор опроса

		$sqlSelectIVOptions = 'SELECT ivoptions.id_option, ivoptions.opttext, COUNT(uservotes.id_option) AS vcount  FROM ivoptions
								LEFT JOIN uservotes ON uservotes.id_option = ivoptions.id_option WHERE ivoptions.id_iv = ?
								GROUP BY ivoptions.id_option'; //выбор вариантов ответа с их количеством

		$sqlSelectIVLikesCount = 'SELECT ivlikes.liketype, COUNT(ivlikes.id_like) AS lcount
								FROM ivlikes WHERE ivlikes.id_iv = ? GROUP BY ivlikes.liketype';

		$lastLikeTime = 'SELECT UNIX_TIMESTAMP(ivlikes.likedatetime) AS dt
				FROM ivlikes WHERE id_iv = ?  ORDER BY id_like DESC LIMIT 1';
		//$sqlSelectIVComments = '';

		$resultFinal = array();

		try{
			$db = $this->db;

			$options = array($id);

			$stmt = $db->prepare($sqlSelectIV);
			$stmt->execute($options);
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$resultFinal['iv'] = $stmt->fetchAll();

			$stmt = $db->prepare($sqlSelectIVOptions);
			$stmt->execute($options);
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$resultFinal['ivoptions'] = $stmt->fetchAll();

			$stmt = $db->prepare($sqlSelectIVLikesCount);
			$stmt->execute($options);
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$resultFinal['ivlikescount'] = $stmt->fetchAll();

			$stmt = $db->prepare($lastLikeTime);
			$stmt->execute($options);
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$r = $stmt->fetchAll();
			$resultFinal['lastliketime'] = $r[0]['dt'];

			//$this->dataResult = $iv;
		}catch(PDOException $e) {
			echo $e->getMessage();
			exit;
		}

		return $resultFinal;
    }
	
}
<?php
require_once 'database.php';

class Comment
{
	/*Properties
	comment_id
	restaurant_id
	username
	comment_time
	comment_content
	*/
	private static $commentid;
	private static $restaurantid;
	private static $username;
	private static $commenttime;
	private static $commentcontent;
	
	//Constructor
	public function __construct(){
		/*
		$this->commentid = $cid;
		$this->restaurantid = $rid;
		$this->username = $un;
		$this->commenttime = $ct;
		$this->commentcontent = $cc;
		*/
	}
	
	//getters
	public function getCommentId(){
		return $this->commentid;
	}
	
	public function getRestaurantId(){
		return $this->restaurantid;
	}
	
	public function getUserName(){
		return $this->username;
	}
	
	public function getCommentTime(){
		return $this->commenttime;
	}
	
	public function getCommentContent(){
		return $this->commentcontent;
	}
	
	//setters
	public function setCommentId($cid){
		$this->commentid = $cid;
	}
	
	public function setRestaurantId($rid){
		$this->restaurantid = $rid;
	}
	
	public function setUserName($un){
		$this->username = $un;
	}
	
	public function setCommentTime($ct){
		$this->commenttime = $ct;
	}
	
	public function setCommentContent($cc){
		$this->commentcontent = $cc;
	}
	
	//Get a comment from the comments table based on the comment id
	public function getAllComments($db, $rid){
		
		$query = "SELECT * FROM comments WHERE restaurant_id = :rid";
		$pdostm = $db->prepare($query);
		$pdostm->bindParam(':rid', $rid);
		$pdostm->execute();
		$comments = $pdostm->fetchAll(PDO::FETCH_OBJ);
		return $comments;
		
		/*
		foreach($comments as $c){
			$str .= '<div class="comment__username">' . $c->username . '</div>' .
			'<div class="comment__time">' . $c->commenttime . '</div>'.
			'<div class="comment__content">'.$c->commentcontent . '</div>';
		}
		return $str;*/
	}
	
	public function addComment($db, $rid, $nm, $cnt){
		//INSERT INTO comments (restaurant_id, username, comment_time, comment_content)
		//VALUES(8906757, 'Alex', UTC_TIMESTAMP(), 'Hello')
		
		$query = "INSERT INTO comments (restaurant_id, username, comment_time, comment_content)" .
		"VALUES(:rid, :nm, UTC_TIMESTAMP(), :cnt)";
		$pdostm = $db->prepare($query);
		$pdostm->bindParam(':rid', $rid);
		$pdostm->bindParam(':nm', $nm);
		$pdostm->bindParam(':cnt', $cnt);
		$count = $pdostm->execute();
		return $count;
	}
}


?>
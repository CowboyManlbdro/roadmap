<?php

function addUser ($db, $l, $pass,$h, $f, $i, $o, $org, $tel, $role, $act){
	$sql= "INSERT INTO users (mail,password,hash,f,i,o, organization, tel, role, activation) VALUES(:mail,:password,:hash,:f,:i,:o,:organization,:tel,:role,:activation)

	";

	$stmt=$db->prepare($sql);
	$stmt->bindValue(':mail',$l,PDO::PARAM_STR);
	$stmt->bindValue(':password',$pass,PDO::PARAM_STR);
	$stmt->bindValue(':hash',$h,PDO::PARAM_STR);
	$stmt->bindValue(':f',$f,PDO::PARAM_STR);
	$stmt->bindValue(':i',$i,PDO::PARAM_STR);
	$stmt->bindValue(':o',$o,PDO::PARAM_STR);
	$stmt->bindValue(':organization',$org,PDO::PARAM_STR);
	$stmt->bindValue(':tel',$tel,PDO::PARAM_STR);
	$stmt->bindValue(':role',$role,PDO::PARAM_STR);
	$stmt->bindValue(':activation',$act,PDO::PARAM_INT);

	$stmt->execute();
}


function UserUpdate ($db, $l, $pass, $f, $i, $o, $org, $tel){
	$sql= "UPDATE users SET password=:password, f=:f, i=:i, o=:o, organization=:organization, tel=:tel
		WHERE mail=:mail 
		";
	
		$stmt=$db->prepare($sql);
		$stmt->bindValue ('mail',$l, PDO::PARAM_STR);
		$stmt->bindValue(':password',$pass,PDO::PARAM_STR);
		$stmt->bindValue(':f',$f,PDO::PARAM_STR);
		$stmt->bindValue(':i',$i,PDO::PARAM_STR);
		$stmt->bindValue(':o',$o,PDO::PARAM_STR);
		$stmt->bindValue(':organization',$org,PDO::PARAM_STR);
		$stmt->bindValue(':tel',$tel,PDO::PARAM_STR);
		$stmt->execute();
	}

function LoginFree ($db,$l) {
	$db->query( "SET CHARSET utf8" );
	$sql = "SELECT id_u,mail FROM users
	WHERE mail='$l' 
	";
	$result=array();

	$stmt= $db->prepare($sql);

	$res=$stmt->execute();

	 while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
	 	$result[$row['id_u']]=$row;
	 }
if (!empty($result)){
	return false;
}
else {
	return true;
}

}


function IsProjectWorker ($db,$id,$l) {
	$db->query( "SET CHARSET utf8" );
	$sql = "SELECT id_p,mail FROM project_people
	WHERE id_project='$id' AND  mail='$l'
	";
	$result=array();

	$stmt= $db->prepare($sql);

	$res=$stmt->execute();

	 while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
	 	$result[$row['id_p']]=$row;
	 }
if (!empty($result)){
	return true;
}
else {
	return false;
}

}

function DelProjectWorker ($db, $id, $l){
	$sql= "DELETE FROM project_people WHERE mail='$l' AND id_project='$id' 
	
		";
	
		$stmt=$db->prepare($sql);
	
		$stmt->execute();
	}
	




function HashMail ($db,$hash,$mail) {
	$db->query( "SET CHARSET utf8" );
	$sql = "SELECT hash,mail FROM users
	WHERE mail='$mail' AND hash ='$hash'
	";
	$result=array();

	$stmt= $db->prepare($sql);

	$res=$stmt->execute();

	 while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
	 	$result[$row['id_u']]=$row;
	 }
if (!empty($result)){
	return true;
}
else {
	return false;
}

}


function getUser ($db,$login) {
	$db->query( "SET CHARSET utf8" );
	$sql = "SELECT * FROM users
	WHERE mail='$login'
	";
	$stmt= $db->prepare($sql);

	$res=$stmt->execute();

	$row=$stmt->fetch(PDO::FETCH_ASSOC); 

	 	$result=$row;


	 return $result;
}

function addProject ($db, $pr){
	$sql= "INSERT INTO projects (name) VALUES(:name)

	";

	$stmt=$db->prepare($sql);
	$stmt->bindValue(':name',$pr,PDO::PARAM_STR);
	$stmt->execute();
}

function addProjectSection ($db, $id, $sec){
	$sql= "INSERT INTO project_section (id_project,id_section,error,on_check,correctly,errors) VALUES(:id_project,:id_section,0,0,0,' ')

	";

	$stmt=$db->prepare($sql);
	$stmt->bindValue(':id_project',$id,PDO::PARAM_INT);
	$stmt->bindValue(':id_section',$sec,PDO::PARAM_INT);
	$stmt->execute();
}

function addProjectAdmin ($db, $idp, $mail){
	$sql= "INSERT INTO project_admins (id_project,mail) VALUES(:id_project,:mail)

	";

	$stmt=$db->prepare($sql);
	$stmt->bindValue(':id_project',$idp,PDO::PARAM_INT);
	$stmt->bindValue(':mail',$mail,PDO::PARAM_STR);
	$stmt->execute();
}

function addProjectPeople ($db, $idp, $mail){
	$sql= "INSERT INTO project_people (id_project,mail) VALUES(:id_project,:mail)

	";

	$stmt=$db->prepare($sql);
	$stmt->bindValue(':id_project',$idp,PDO::PARAM_INT);
	$stmt->bindValue(':mail',$mail,PDO::PARAM_STR);
	$stmt->execute();
}


function activateUser ($db, $mail){
$sql= "UPDATE users SET activation=1
    WHERE mail='$mail'
	";

	$stmt=$db->prepare($sql);

	$stmt->execute();
}


function addFile ($db, $nf, $ext, $pr, $loc, $sec, $dl){
	$db->query( "SET CHARSET utf8" );
	$sql= "INSERT INTO files (name_file,ext,project,location,section,date_load) VALUES(:name_file,:ext,:project,:location,:section,:date_load)

	";

	$stmt=$db->prepare($sql);
	$stmt->bindValue(':name_file',$nf,PDO::PARAM_STR);
	$stmt->bindValue(':ext',$ext,PDO::PARAM_STR);
	$stmt->bindValue(':project',$pr,PDO::PARAM_INT);
	$stmt->bindValue(':location',$loc,PDO::PARAM_STR);
	$stmt->bindValue(':section',$sec,PDO::PARAM_INT);
	$stmt->bindValue(':date_load',$dl,PDO::PARAM_STR);
	$stmt->execute();
}



function addNotification ($db, $pr, $sec, $text, $color){
	$db->query( "SET CHARSET utf8" );
	$sql= "INSERT INTO notifications (id_project,id_section,text,color) VALUES(:id_project,:id_section,:text,:color)

	";

	$stmt=$db->prepare($sql);
	$stmt->bindValue(':id_project',$pr,PDO::PARAM_INT);
	$stmt->bindValue(':id_section',$sec,PDO::PARAM_INT);
	$stmt->bindValue(':text',$text,PDO::PARAM_STR);
	$stmt->bindValue(':color',$color,PDO::PARAM_STR);
	$stmt->execute();
}

function getNotifications ($db,$id) {
	$db->query( "SET CHARSET utf8" );
	$sql = "SELECT * FROM notifications
	WHERE id_project=:id_project ORDER BY id_n DESC LIMIT 5
	";
	$result=array();
	$stmt = $db->prepare($sql);
	$stmt->bindValue ('id_project',$id, PDO::PARAM_INT);
	$stmt->execute();
	while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
	 	$result[$row['id_n']]=$row;
	 }

	 return $result;
}

function getProjectId ($db,$np) {
	$db->query( "SET CHARSET utf8" );
	$sql = "SELECT id_p FROM projects
	WHERE name=:name 
	";
	$stmt = $db->prepare($sql);
	$stmt->bindValue ('name',$np, PDO::PARAM_STR);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	return $row;
}


function getUserProject ($db,$mail) {
	$db->query( "SET CHARSET utf8" );
	$sql = "SELECT project_people.id_project,project_admins.id_project  FROM project_admins, project_people
	WHERE project_admins.mail=:mail OR project_people.mail=:mail
	";
	$stmt = $db->prepare($sql);
	$stmt->bindValue ('mail',$mail, PDO::PARAM_STR);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	return $row;
}

function getProjectsById ($db,$id) {
	$db->query( "SET CHARSET utf8" );
	$sql = "SELECT * FROM projects
	WHERE id_p=:id_p 
	";
	$result=array();
	$stmt = $db->prepare($sql);
	$stmt->bindValue ('id_p',$id, PDO::PARAM_INT);
	$stmt->execute();
	while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
	 	$result[$row['id_p']]=$row;
	 }

	 return $result;
}


function getFilesByProjectAndSection ($db,$id,$sec) {
	$db->query( "SET CHARSET utf8" );
	$sql = "SELECT * FROM files
	WHERE project=:project AND section=:section
	";
	$result=array();
	$stmt = $db->prepare($sql);
	$stmt->bindValue ('project',$id, PDO::PARAM_INT);
	$stmt->bindValue ('section',$sec, PDO::PARAM_STR);
	$stmt->execute();
	while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
	 	$result[$row['id_f']]=$row;
	 }

	 return $result;
}


function getFilesByProject ($db,$id) {
	$db->query( "SET CHARSET utf8" );
	$sql = "SELECT * FROM files
	WHERE project=:project
	";
	$result=array();
	$stmt = $db->prepare($sql);
	$stmt->bindValue ('project',$id, PDO::PARAM_INT);
	$stmt->execute();
	while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
	 	$result[$row['id_f']]=$row;
	 }

	 return $result;
}

function getProjectById ($db,$id) {
	$db->query( "SET CHARSET utf8" );
	$sql = "SELECT * FROM projects
	WHERE id_p=:id_p 
	";
	$stmt = $db->prepare($sql);
	$stmt->bindValue ('id_p',$id, PDO::PARAM_INT);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	return $row;
}


function getProjectAdmin ($db,$id) {
	$db->query( "SET CHARSET utf8" );
	$sql = "SELECT mail FROM project_admins
	WHERE id_project=:id_project 
	";
	$stmt = $db->prepare($sql);
	$stmt->bindValue ('id_project',$id, PDO::PARAM_INT);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	return $row;
}

function getProjectAdmin1 ($db,$id) {
	$db->query( "SET CHARSET utf8" );
	$sql = "SELECT mail,f,i,o,tel,activation FROM users
	WHERE mail = (SELECT mail FROM project_admins
	WHERE id_project=:id_project) 
	";
	$stmt = $db->prepare($sql);
	$stmt->bindValue ('id_project',$id, PDO::PARAM_INT);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	return $row;
}

function getUserInfo ($db,$mail) {
	$db->query( "SET CHARSET utf8" );
	$sql = "SELECT mail,f,i,o,tel,activation FROM users
	WHERE mail=:mail 
	";
	$stmt = $db->prepare($sql);
	$stmt->bindValue ('mail',$mail, PDO::PARAM_STR);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	return $row;
}

function getProjectWorker ($db,$id) {
	$db->query( "SET CHARSET utf8" );
	$sql = "SELECT mail FROM project_people
	WHERE id_project=:id_project
	";
	$result = array();
	$stmt = $db->prepare($sql);
	$stmt->bindValue ('id_project',$id, PDO::PARAM_INT);
	$stmt->execute();
	while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
		$result[$row['mail']]=$row;
	}

	return $result;
}


function getSectionGost ($db,$sec) {
	$db->query( "SET CHARSET utf8" );
	$sql = "SELECT id_g,nameGost,link FROM gost
	WHERE section=:section
	";
	$result = array();
	$stmt = $db->prepare($sql);
	$stmt->bindValue ('section',$sec, PDO::PARAM_INT);
	$stmt->execute();
	while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
		$result[$row['id_g']]=$row;
	}

	return $result;
}


function getSectionInfo ($db,$id, $sec) {
	$db->query( "SET CHARSET utf8" );
	$sql = "SELECT error,on_check,correctly,errors FROM project_section
	WHERE id_project=:id_project AND  id_section=:id_section
	";
	$stmt = $db->prepare($sql);
	$stmt->bindValue ('id_project',$id, PDO::PARAM_INT);
	$stmt->bindValue ('id_section',$sec, PDO::PARAM_INT);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	return $row;
}

function SectionCorrect ($db, $id, $sec){
	$sql= "UPDATE project_section SET error=0, on_check=0, correctly=1, errors=''
		WHERE id_project=:id_project AND  id_section=:id_section
		";
	
		$stmt=$db->prepare($sql);
		$stmt->bindValue ('id_project',$id, PDO::PARAM_INT);
		$stmt->bindValue ('id_section',$sec, PDO::PARAM_INT);
		$stmt->execute();
	}

	function SectionErrors ($db, $id, $sec, $error){
		$sql= "UPDATE project_section SET error=1, on_check=0, correctly=0, errors=:errors
			WHERE id_project=:id_project AND  id_section=:id_section
			";
		
			$stmt=$db->prepare($sql);
			$stmt->bindValue ('errors',$error, PDO::PARAM_STR);
			$stmt->bindValue ('id_project',$id, PDO::PARAM_INT);
			$stmt->bindValue ('id_section',$sec, PDO::PARAM_INT);
			$stmt->execute();
		}

	function SectionCheck ($db, $id, $sec){
			$sql= "UPDATE project_section SET error=0, on_check=1, correctly=0, errors=''
				WHERE id_project=:id_project AND  id_section=:id_section
				";
			
				$stmt=$db->prepare($sql);
				$stmt->bindValue ('id_project',$id, PDO::PARAM_INT);
				$stmt->bindValue ('id_section',$sec, PDO::PARAM_INT);
				$stmt->execute();
			}

function getFileById ($db,$id) {
	$db->query( "SET CHARSET utf8" );
	$sql = "SELECT * FROM files
	WHERE id_f=:id_f 
	";
	$stmt = $db->prepare($sql);
	$stmt->bindValue ('id_f',$id, PDO::PARAM_INT);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	return $row;
}

function getAllProjects ($db){
	$db->query( "SET CHARSET utf8" );

	$sql= "SELECT * FROM projects
	";

	$result=array();

	$stmt= $db->prepare($sql);

	$res=$stmt->execute();

	 while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
	 	$result[$row['id_p']]=$row;
	 }

	 return $result;
}



function isAdmin($db, $id, $mail){
      $sql= "SELECT * FROM project_admins
             WHERE id_project=:id_project AND mail=:mail 
      ";

      $stmt=$db->prepare($sql);

		$stmt->bindValue(':id_project',$id,PDO::PARAM_INT);
		$stmt->bindValue(':mail',$mail,PDO::PARAM_STR);

		$stmt->execute();

		$row= $stmt->fetch(PDO::FETCH_ASSOC);

		if(!empty($row)){
            return true;
		} else {
			return false;
		}
}


function isWorker($db, $id, $mail){
	$sql= "SELECT * FROM project_people
		   WHERE id_project=:id_project AND mail=:mail 
	";

	$stmt=$db->prepare($sql);

	  $stmt->bindValue(':id_project',$id,PDO::PARAM_INT);
	  $stmt->bindValue(':mail',$mail,PDO::PARAM_STR);

	  $stmt->execute();

	  $row= $stmt->fetch(PDO::FETCH_ASSOC);

	  if(!empty($row)){
		  return true;
	  } else {
		  return false;
	  }
}


function DelFile ($db, $id){
$sql= "DELETE FROM files WHERE id_f='$id' 

	";

	$stmt=$db->prepare($sql);

	$stmt->execute();
}


function DelProject ($db, $id){
$sql= "DELETE FROM projects WHERE id_p='$id' 

	";

	$stmt=$db->prepare($sql);

	$stmt->execute();
}


?>
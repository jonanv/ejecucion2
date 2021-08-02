<?php
class menuModel extends modelBase
{
	public function info_user()
	{
		$id = $_SESSION['id'];
		
		$select = $this->db->prepare('SELECT * FROM ejecutivoapoyo WHERE Email = :id');
		$select->bindParam(':id', $id);
		$select->execute();
		
		while($row = $select->fetch())
		{				
			$_SESSION['cargo'] = $row['Cargo'];
			$_SESSION['email'] = $row['Email'];		
			$_SESSION['estado'] = $row['estado'];	
		}
				
	}
}
?>
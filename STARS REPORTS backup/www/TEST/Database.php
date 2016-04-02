
<?php
/*Written by Nick Chandler 
June 18 2013
This was done by watching the php data base tutorials by phpacademy on YouTube
I am writing this for the purpose of reaching out to a Relational Data Base on Amazon
Web Services pulling in data and then placing it on the STAR's server's data base
I am working with Mike Hester on this
*/
class Database
{
	protected $link,$result,$numRows;
	
	public function __construct($server, $username,$password,$db)
		{
		$this->link=mysql_connect($server,$username,$password);
		if(!$this->link)
			{
			die('could not connect:' .mysql.error());
			}
			echo 'Connected to '.$server;
		mysql_select_db($db,$this->link);
		}
		
	public function disconnect()
		{
		mysql_close($this->link);
		echo 'DB is closed';
		}
	
	public function query($sql)
		{
		$this->result=mysql_query($sql, $this->link);
		$this->numRows=mysql_num_rows($this->result);
		}
	
	public function numRows()
		{
		//if we had the mysql_num_rows function in here
		return $this->numRows;
		
		}
	
	public function rows()
		{
		$rows=array();
		for($x=0;$x<$this->numRows();$x++)
			{
			$rows[]=mysql_fetch_assoc($this->result);
			}
			return $rows;  //This array holds all the info in the table
		}
}

?>
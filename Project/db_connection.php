<?php
class connection
{
	public $con= NULL;
	public $host="localhost";
	public $dbname="Games";
	public $username="root";
	public $password="";
    public function connection(){}
     public function connection1($hos,$dbname,$username,$password)
     {
		$this->host=$host;
		$this->dbname=$dbname;
		$this->username=$username;
		$this->password=$password;
    }
    public function connect()
	{
		$this->con=mysqli_connect($this->host,$this->username,$this->password, $this->dbname);
	     mysqli_query($this->con, "set charset utf8");
		if(!$this->con)
		{
			die("could not connect db :".mysqli_error());
		}
	}
	public function disconnect()
	{
		mysqli_close($this->con);
	}
	public function query($cmd)
	{
		return mysqli_query($this->con, $cmd);
	}
}
	$con = new connection();
?>
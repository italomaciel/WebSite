<?php

try{
$con = new PDO ("mysql:host=sql110.epizy.com;dbname=epiz_23877650_users","epiz_23877650","rpUw8uhlU1"); 
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
echo "error:".$e->getMessage(); 
}

?>
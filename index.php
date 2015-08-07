<?php
require 'SQLite3_DB_Helper.php';

$db = new Database();

$sql = "
DELETE FROM CONTACT_LIST;
INSERT INTO CONTACT_LIST (LNAME, FNAME, PHONE, EMAIL)
VALUES ('DELA CRUZ', 'JUAN', '123456789', 'JUANDELACRUZ@MAIL.COM');
INSERT INTO CONTACT_LIST (LNAME, FNAME, PHONE, EMAIL)
VALUES ('CLARA', 'MARIA', '987654321', 'MARIACLARA@MAIL.COM');
";

$result = $db->_exec($sql);
if(!$result){
	$db->_console_log($this->database->lastErrorMsg());
} else {
	$db->_console_log('Records created successfully.');
}

$sql = "
SELECT * FROM CONTACT_LIST;
";
$result = $db->_query($sql);
while($row = $result->fetchArray(SQLITE3_ASSOC) ){
	echo "ID = ". $row['ID'] . "\n";
	echo "LNAME = ". $row['LNAME'] . "<br/>";
	echo "FNAME = ". $row['FNAME'] ."<br/>";
	echo "PHONE = ". $row['PHONE'] ."<br/>";
	echo "EMAIL =  ".$row['EMAIL'] ."<br/><br/>";
}
$db->_console_log('Operation SELECT done successfully.');
?>
<?php
	require_once "./_connect.php";

	$pdo = new PDO(DSN, LOGIN, PASS);

	$statement = $pdo->query("SELECT firstname, lastname FROM friend");
	$friends = $statement->fetchAll(PDO::FETCH_ASSOC);

	echo "<ul>";
	foreach ($friends as $friend) {
		echo "<li>" . $friend["firstname"] . " " . $friend["lastname"] . "</li>";
	}
	echo "</ul>";

	echo "    <form action='' method='post'>" . PHP_EOL;
	echo "        <label for='firstname'>Firstname</label>" . PHP_EOL;
	echo "        <input type:'text' id='firstname' name='firstname' minlength='1' maxlength='45' required>" . PHP_EOL;
	echo "        <label for='lastname'>Lastname</label>" . PHP_EOL;
	echo "        <input type:'text' id='lastname' name='lastname' minlength='1' maxlength='45' required>" . PHP_EOL;
	echo "        <input type='submit' value='Will be there for youuuuu'>" . PHP_EOL;
	echo "    </form>". PHP_EOL;

	if (filter_has_var(INPUT_POST, 'firstname') && filter_has_var(INPUT_POST, 'lastname') ) {

		$firstname = trim($_POST['firstname']);
		$lastname = trim($_POST['lastname']);
		$statement = $pdo->prepare("INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)");
		$statement->bindValue(':firstname', $firstname, PDO::PARAM_STR);
		$statement->bindValue(':lastname', $lastname, PDO::PARAM_STR);

		$statement->execute();
		header("Location: /");
		exit();
	}

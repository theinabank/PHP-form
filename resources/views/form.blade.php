<!DOCTYPE html>
<html>
<head>
	<title>Form</title>
</head>
<body>
	<form action="/submit" method="post" enctype="multipart/form-data">
		{{ csrf_field() }}
		Vārds: <input type="text" name="name"><br>
		<i><?php if (isset($error['error_name'])) {
			echo htmlspecialchars($error['error_name']);
		}?></i><br>
		Uzvārds: <input type="text" name="surname"><br>
		<i><?php if (isset($error['error_surname'])) {
			echo htmlspecialchars($error['error_surname']);
		}?></i><br>
		Dzimšanas datums: <input type="date" name="date"><br>
		<i><?php if (isset($error['error_date'])) {
			echo htmlspecialchars($error['error_date']);
		}?></i><br>
		Bilde: <input type="file" name="file"><br>
		<i><?php if (isset($error['error_file'])) {
			echo htmlspecialchars($error['error_file']);
		}?></i><br>
		<input type="submit" name="submit" value="Apstiprināt">
	</form>
</body>
</html>
<!DOCTYPE html>
<html lang="en">

				<head>
								<meta charset="UTF-8">
								<meta name="viewport" content="width=device-width, initial-scale=1.0">
								<meta http-equiv="X-UA-Compatible" content="ie=edge">
								<title>Create</title>
				</head>

				<body>
								<form action="{{ route("proirities.store") }}" method="POST">
												@csrf
												<input name="name" placeholder="enter name" />
												<button type="submit">save</button>
								</form>
				</body>

</html>

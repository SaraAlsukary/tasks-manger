<!DOCTYPE html>
<html lang="en">

				<head>
								<meta charset="UTF-8">
								<meta name="viewport" content="width=device-width, initial-scale=1.0">
								<meta http-equiv="X-UA-Compatible" content="ie=edge">
								<title>Create</title>
				</head>

				<body>
								<form action="{{ route("teams.store") }}" method="POST">
												@csrf
												<input name="name" type="text" placeholder="enter name" />
												@error("name")
																{{ $message }}
												@enderror
												<input name="description" type="text" placeholder="enter description" />
												@error("description")
																{{ $message }}
												@enderror
												<button type="submit">save</button>
								</form>
				</body>

</html>

<!DOCTYPE html>
<html lang="en">

				<head>
								<meta charset="UTF-8">
								<meta name="viewport" content="width=device-width, initial-scale=1.0">
								<meta http-equiv="X-UA-Compatible" content="ie=edge">
								<title>Create</title>
				</head>

				<body>
								<form action="{{ route("proirities.update", $proirity->id) }}" method="POST">
												@method("PUT")
												@csrf
												<input value={{ $proirity->name }} name="name" placeholder="enter name" />
												<button type="submit">save</button>
								</form>
				</body>

</html>

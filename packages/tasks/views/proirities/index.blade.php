<!DOCTYPE html>
<html lang="en">

				<head>
								<meta charset="UTF-8">
								<meta name="viewport" content="width=device-width, initial-scale=1.0">
								<meta http-equiv="X-UA-Compatible" content="ie=edge">
								<title>Proirites</title>
				</head>

				<body>
								@if (session("message"))
												<div>{{ session("message") }}</div>
								@endif
								<h1>Proirites</h1>
								<button><a href="{{ url("/admin") }}">Home</a></button>

								<button><a href="{{ route("proirities.create") }}">Create</a></button>
								<table border="2">
												<tr>
																<td>id</td>
																<td>name</td>
																<td>actions</td>
												</tr>
												@foreach ($proirities as $proirity)
																<tr>
																				<td>{{ $proirity->id }}</td>
																				<td>{{ $proirity->name }}</td>
																				<td>
																								<button><a href="{{ route("proirities.show", $proirity) }}">Show</a></button>
																								<button><a href="{{ route("proirities.edit", $proirity) }}">Edit</a></button>
																								<form style="display:inline;" action="{{ route("proirities.destroy", $proirity->id) }}"
																												method="post">
																												@csrf
																												@method("DELETE")
																												<button type="submit">Delete</button>
																								</form>
																				</td>

																</tr>
												@endforeach
								</table>
				</body>

</html>

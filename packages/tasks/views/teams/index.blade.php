<!DOCTYPE html>
<html lang="en">

				<head>
								<meta charset="UTF-8">
								<meta name="viewport" content="width=device-width, initial-scale=1.0">
								<meta http-equiv="X-UA-Compatible" content="ie=edge">
								<title>Teams</title>
				</head>

				<body>
								@if (session("message"))
												<div>{{ session("message") }}</div>
								@endif
								<h1>Teams</h1>
								<button><a href="{{ url("/admin") }}">Home</a></button>

								<button><a href="{{ route("teams.create") }}">Create</a></button>
								<table border="2">
												<tr>
																<td>id</td>
																<td>name</td>
																<td>description</td>
																<td>actions</td>
												</tr>
												@foreach ($teams as $team)
																<tr>
																				<td>{{ $team->id }}</td>
																				<td>{{ $team->name }}</td>
																				<td>{{ $team->description }}</td>

																				<td>
																								<button><a href="{{ route("teams.show", $team) }}">Show</a></button>
																								<button><a href="{{ route("teams.edit", $team) }}">Edit</a></button>
																								<form style="display:inline;" action="{{ route("teams.destroy", $team->id) }}" method="post">
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

<!DOCTYPE html>
<html lang="en">

				<head>
								<meta charset="UTF-8">
								<meta name="viewport" content="width=device-width, initial-scale=1.0">
								<meta http-equiv="X-UA-Compatible" content="ie=edge">
								<title>Members</title>
				</head>

				<body>
								@if (session("message"))
												<div>{{ session("message") }}</div>
								@endif
								<h1>Members</h1>
								<button><a href="{{ url("/admin") }}">Home</a></button>

								<button><a href="{{ route("members.create") }}">Create</a></button>
								<table border="2">
												<tr>
																<td>id</td>
																<td>name</td>
																<td>email</td>
																<td>actions</td>
												</tr>
												@foreach ($members as $member)
																<tr>
																				<td>{{ $member->id }}</td>
																				<td>{{ $member->name }}</td>
																				<td>{{ $member->email }}</td>

																				<td>
																								<button><a href="{{ route("members.show", $member) }}">Show</a></button>
																								<button><a href="{{ route("members.edit", $member) }}">Edit</a></button>
																								<form style="display:inline;" action="{{ route("members.destroy", $member->id) }}"
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

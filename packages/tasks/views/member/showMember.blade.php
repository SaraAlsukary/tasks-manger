<!DOCTYPE html>
<html lang="en">

				<head>
								<meta charset="UTF-8">
								<meta name="viewport" content="width=device-width, initial-scale=1.0">
								<meta http-equiv="X-UA-Compatible" content="ie=edge">
								<title>Members</title>
				</head>

				<body>
								<h1>Members & Teams</h1>
								<div>{{ auth()->user()->name }}</div>
								<div>{{ $team->name }}</div>
								<div>{{ $team->description }}</div>
								<div>{{ $is_manger === true ? "You Are The Manger" : "You Are a Member" }}</div>

								<table border="2">
												<tr>
																<td>name</td>
																<td>is_manger</td>
												</tr>
												@foreach ($members as $member)
																<tr>
																				<td>{{ $member->name }}</td>
																				<td>{{ $member->pivot->is_manger ? "yes" : "no" }}</td>
																</tr>
												@endforeach
								</table>
				</body>

</html>

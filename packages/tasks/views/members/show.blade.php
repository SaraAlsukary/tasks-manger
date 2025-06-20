<!DOCTYPE html>
<html lang="en">

				<head>
								<meta charset="UTF-8">
								<meta name="viewport" content="width=device-width, initial-scale=1.0">
								<meta http-equiv="X-UA-Compatible" content="ie=edge">
								<title>Show Member</title>
				</head>

				<body>
								<h1>Show</h1>
								@if (session("message"))
												<div>{{ session("message") }}</div>
								@endif
								<p> name: {{ $member->name }}</p>
								<p> email: {{ $member->email }}</p>
								Teams :
								<table border="2">
												<tr>
																<td>
																				Team Name
																</td>
																<td>
																				Manger
																</td>
																<td>
																				action change is_manger
																</td>
												</tr>
												@foreach ($member->teams as $team)
																<tr>
																				<td>
																								{{ $team->name }}

																				</td>
																				<td>{{ $team->pivot->is_manger === 1 ? "yes" : "no" }}

																				</td>
																				<td>
																								<form style="display: block" action="{{ route("changeManger", [$team, $member]) }}" method="post">
																												@csrf
																												@method("patch")
																												<button>Change</button>
																								</form>
																				</td>
																</tr>
												@endforeach
				</body>

</html>

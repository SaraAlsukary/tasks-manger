<!DOCTYPE html>
<html lang="en">

				<head>
								<meta charset="UTF-8">
								<meta name="viewport" content="width=device-width, initial-scale=1.0">
								<meta http-equiv="X-UA-Compatible" content="ie=edge">
								<title>Show Member</title>
				</head>

				<body>
								<h1>Task</h1>

								<p>Name: {{ $task->title }}</p>
								<p>description: {{ $task->description }}</p>
								<p>statue: {{ $task->statue }}</p>
								<p>proitrity: {{ $task->proirity->name }}</p>
								<p>team: {{ $task->team->name }}</p>
								@if ($task->member)
												<td>member: {{ $task->member->name }}</td>
								@else
												<td>member: no member until now</td>
								@endif
								<form action="{{ route("tasks.addMember", $task) }}" method="post">
												@method("PATCH")
												@csrf
												<div> <label>Choose a member</label>
																<select name="user_id">
																				@foreach ($members as $member)
																								<option value="{{ $member->id }}">{{ $member->name }}</option>
																				@endforeach
																</select>
												</div>
												@error("user_id")
																{{ $message }}
												@enderror
												<button type="submit">Save</button>
								</form>
				</body>

</html>

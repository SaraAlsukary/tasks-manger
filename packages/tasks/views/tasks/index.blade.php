<!DOCTYPE html>
<html lang="en">

				<head>
								<meta charset="UTF-8">
								<meta name="viewport" content="width=device-width, initial-scale=1.0">
								<meta http-equiv="X-UA-Compatible" content="ie=edge">
								<title>Tasks</title>
				</head>

				<body>
								@if (session("message"))
												<div>{{ session("message") }}</div>
								@endif
								<h1>Tasks</h1>
								<h1 class="title"></h1>
								<p class="desc"></p>
								<button><a href="{{ url("/admin") }}">Home</a></button>

								<button><a href="{{ route("tasks.create") }}">Create</a></button>
								<table border="2">
												<tr>
																<td>id</td>
																<td>title</td>
																<td>description</td>
																<td>team</td>
																<td>member</td>
																<td>statue</td>
																<td>proirity</td>
																<td>actions</td>
												</tr>
												@foreach ($tasks as $task)
																<tr>
																				<td>{{ $task->id }}</td>
																				<td>{{ $task->title }}</td>
																				<td>{{ $task->description }}</td>
																				<td>{{ $task->team->name }}</td>
																				@if ($task->member)
																								<td>{{ $task->member->name }}</td>
																				@else
																								<td>no member until now</td>
																				@endif
																				<td>{{ $task->statue }}</td>
																				<td>{{ $task->proirity->name }}</td>

																				<td>
																								<button><a href="{{ route("tasks.show", $task) }}">Show</a></button>
																								<button><a href="{{ route("tasks.edit", $task) }}">Edit</a></button>
																								<form style="display:inline;" action="{{ route("tasks.destroy", $task->id) }}" method="post">
																												@csrf
																												@method("DELETE")
																												<button type="submit">Delete</button>
																								</form>
																				</td>

																</tr>
												@endforeach
								</table>
								<script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>
								<script>
												// Enable pusher logging - don't include this in production
												Pusher.logToConsole = true;

												var pusher = new Pusher('19b13ca4f26b6a947257', {
																cluster: 'ap2'
												});

												var channel = pusher.subscribe('my-channel');
												channel.bind('test.notification', function(data) {
																alert(JSON.stringify(data));
																document.querySelector('.desc').innerText = data.data.desc;
																document.querySelector('.title').innerText = data.data.title;
												});
								</script>
				</body>

</html>

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
								<h1 class="title"></h1>
								<p class="desc"></p>
								<table border="2">
												<tr>
																<td>name</td>
																<td>description</td>
																<td>actions</td>
												</tr>
												@foreach ($teams as $team)
																<tr>
																				<td>{{ $team->name }}</td>
																				<td>{{ $team->description }}</td>
																				<td><button><a href="{{ url("/home/teams", $team->id) }}">Show</a></button></td>
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
																document.querySelector('.title').innerText = data.data.title;
																document.querySelector('.desc').innerText = data.data.desc;
												});
								</script>
				</body>

</html>

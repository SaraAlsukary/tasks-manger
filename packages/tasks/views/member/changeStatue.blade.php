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
								<h1 class="title"></h1>
								<p class="desc"></p>
								<p>Name: {{ $task->title }}</p>
								<p>description: {{ $task->description }}</p>
								<p>statue: {{ $task->statue }}</p>
								<p>proitrity: {{ $task->proirity->name }}</p>
								<form action="{{ route("changeStatue", $task) }}" method="post">
												@csrf
												@method("patch")
												<select name="statue">

																<option value="completed">completed</option>
																<option value="uncompleted">uncompleted</option>
																<option value="working on">working on</option>
												</select>
												<button type="submit">Save</button>
								</form>
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

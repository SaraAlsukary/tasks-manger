<!DOCTYPE html>
<html lang="en">

				<head>
								<meta charset="UTF-8">
								<meta name="viewport" content="width=device-width, initial-scale=1.0">
								<meta http-equiv="X-UA-Compatible" content="ie=edge">
								<title>Member Page</title>
				</head>

				<body>
								<h1>Welcome Member!</h1>
								<h1 class="title"></h1>
								<p class="desc"></p>
								<button><a href="{{ url("/dashboard") }}">Dashboard</a></button>
								<button><a href="{{ url("/home/tasks") }}">Go See Tasks</a></button>
								<Button><a href="{{ url("/home/teams") }}">Your Teams</a></Button>
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

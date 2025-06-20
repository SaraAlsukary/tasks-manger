<!DOCTYPE html>
<html lang="en">

				<head>
								<meta charset="UTF-8">
								<meta name="viewport" content="width=device-width, initial-scale=1.0">
								<meta http-equiv="X-UA-Compatible" content="ie=edge">
								<title>Dashboard</title>
				</head>

				<body>
								<h1>Welcome Admin</h1>
								<h1 class="title"></h1>
								<p class="desc"></p>
								<button><a href="{{ url("/dashboard") }}">Dashboard</a></button>
								<button><a href="{{ url("/admin/tasks") }}">Tasks</a></button>
								<button><a href="{{ url("/admin/proirities") }}">Proirities</a></button>
								<button><a href="{{ url("/admin/members") }}">Members</a></button>
								<button><a href="{{ url("/admin/teams") }}">Teams</a></button>
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

<!DOCTYPE html>
<html lang="en">

				<head>
								<meta charset="UTF-8">
								<meta name="viewport" content="width=device-width, initial-scale=1.0">
								<meta http-equiv="X-UA-Compatible" content="ie=edge">
								<title>Create</title>
				</head>

				<body>
								<form action="{{ route("tasks.update", $task->id) }}" method="POST">
												@method("put")
												@csrf
												<div>
																<input value="{{ $task->title }}" name="title" type="text" placeholder="enter title" />
												</div>
												@error("title")
																{{ $message }}
												@enderror
												<div>
																<input value="{{ $task->description }}" name="description" type="text"
																				placeholder="enter description" />
												</div>
												@error("description")
																{{ $message }}
												@enderror
												<select name="statue">
																<option value="completed">completed</option>
																<option value="uncompleted">uncompleted</option>
																<option value="working on">working on</option>
												</select>
												@error("statue")
																{{ $message }}
												@enderror
												{{-- <div>
																<input value='{{ 1 }}' name="is_manger" type="checkbox" id="manger" />
																<label>manger</label>

												</div> --}}
												<div> <label>Choose proirity</label>
																<select name="proirity_id">
																				@foreach ($proirities as $proirity)
																								<option value="{{ $proirity->id }}">{{ $proirity->name }}</option>
																				@endforeach
																</select>
												</div>
												@error("proirirty_id")
																{{ $message }}
												@enderror
												{{-- <div> <label>Choose member</label>
																<select name="user_id">
																				@foreach ($members as $member)
																								<option value="{{ $member->id }}">{{ $member->name }}</option>
																				@endforeach
																</select>
												</div>
												@error("user_id")
																{{ $message }}
												@enderror --}}
												<button type="submit">save</button>
								</form>
				</body>

</html>

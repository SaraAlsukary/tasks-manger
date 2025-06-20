<!DOCTYPE html>
<html lang="en">

				<head>
								<meta charset="UTF-8">
								<meta name="viewport" content="width=device-width, initial-scale=1.0">
								<meta http-equiv="X-UA-Compatible" content="ie=edge">
								<title>Create</title>
				</head>

				<body>
								<form action="{{ route("members.update", $member->id) }}" method="POST">
												@csrf
												@method("put")
												<div>
																<input value="{{ $member->name }}" name="name" type="text" placeholder="enter name" />
												</div>
												<div>
																<input value="{{ $member->email }}" name="email" type="email" placeholder="enter email" />
												</div>
												<div>
																<input value="{{ $member->password }}" name="password" type="password" placeholder="enter password" />
												</div>

												{{-- <div>
																<input value="{{ true }}" name="is_manger" type="checkbox" id="manger" />
																<label>manger</label>

												</div> --}}
												<div> <label>Choose Team</label>
																<select name="teams[]" multiple>
																				@foreach ($teams as $team)
																								<option value="{{ $team->id }}">{{ $team->name }}</option>
																				@endforeach
																</select>
												</div>
												<button type="submit">save</button>
								</form>
				</body>

</html>

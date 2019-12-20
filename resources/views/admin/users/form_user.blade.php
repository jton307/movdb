<div class="form-group">
  <label for="name" class="font-weight-bold">Name: </label>
  <input type="text" name="name" class="form-control" value="{{ old('name') ?? $user->name}} ">
  <span class="alert text-danger">{{ $errors->first('name') }}</span>
</div>
<div class="form-group">
  <label for="email" class="font-weight-bold">Email: </label>
  <input type="email" name="email" class="form-control" value="{{ old('email') ?? $user->email }}">
  <span class="alert text-danger">{{ $errors->first('email') }}</span>
</div>
<div class="form-group">
  <label for="password" class="font-weight-bold">Password: </label>
  <input type="password" name="password" class="form-control" value="">
  <span class="alert text-danger">{{ $errors->first('password') }}</span>
</div>
<div class="form-group">
  <label for="role_id" class="font-weight-bold">Role: </label>
  <select name="role_id" id="role_id" class="form-control">
    <option value="" disabled>Select a Role</option>
    @foreach($roles as $role)
      <option value="{{ $role->id }}" {{ $role->id == $user->role_id ? 'selected' : '' }}> {{$role->name}}</option>
    @endforeach
  </select>
</div>
<div class="form-group">
  <label for="active" class="font-weight-bold">Status: </label>
  <select name="active" id="active" class="form-control">
    <option value="" disabled>Select a Status</option>
    @foreach($user->activeOptions() as $optionKey =>$optionValue)
      <option value="{{$optionKey}}" {{ $user->active == $optionValue ? 'selected' : '' }}>{{$optionValue}}</option>
    @endforeach
  </select>
</div>
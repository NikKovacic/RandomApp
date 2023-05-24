@props([
    'method',
    'overrideMethod' => false,
    'action',
    'person' => NULL,
])

<form method="{{$method}}" action="{{$action}}">
    @csrf
    @if ($overrideMethod)
        @method($overrideMethod)
    @endif
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" name="name" id="name" value="{{old('name', $person ? $person->name: '' )}}">
        @if ($errors->has('name'))
            <span class="text-danger">{{ $errors->first('name') }}</span>
        @endif
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" id="email" value="{{old('email',$person ? $person->email: '')}}">
        @if ($errors->has('email'))
            <span class="text-danger">{{ $errors->first('email') }}</span>
        @endif
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Phone number</label>
        <input type="text" class="form-control" name="phone" id="phone" value="{{old('phone', $person ? $person->phone: '')}}" aria-describedby="phoneHelp">
        <div id="phoneHelp" class="form-text">Enter number in E164 format (example: +3212345678).</div>
        @if ($errors->has('phone'))
            <span class="text-danger">{{ $errors->first('phone') }}</span>
        @endif
    </div>
    <div class="mb-3">
        <label for="tin" class="form-label">TIN</label>
        <input type="text" class="form-control" name="tin" id="tin" value="{{old('tin', $person ? $person->tin: '')}}">
        @if ($errors->has('tin'))
            <span class="text-danger">{{ $errors->first('tin') }}</span>
        @endif
    </div>
    @if (session('msg'))
        <div class="alert alert-{{session('status')}}" role="alert">
            {{ session('msg') }}
        </div>
    @endif

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

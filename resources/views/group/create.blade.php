@extends('layouts.app')

@section('content')
    <!-- @todo: translate! & add to components! -->
    <div class="container">
        <div class="row justify-content-center mb-3">
            <div class="col-lg-8 col-md-10">
                <a href="{{ route('group.index') }}" class="btn btn-sm btn-outline-secondary float-start">
                    <i class="fa-solid fa-chevron-left"></i> Back
                </a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card">
                    <div class="card-header">Create group</div>
                    <div class="card-body">
                        <form method="POST" action="{{route('group.store')}}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Group name</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{old('name','')}}">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <!-- @todo: need for optimization! -> does not handle big data well! -->
                            <fieldset>
                                <legend class="fs-5">Add members</legend>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Natural people</label>
                                    <select class="select2 form-select" name="natural_people[]" multiple="multiple">
                                        @foreach($natural_people as $person)
                                            <option value="{{$person->id}}">{{$person->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Legal people</label>
                                    <select class="select2 form-select" name="legal_people[]" multiple="multiple">
                                        @foreach($legal_people as $person)
                                            <option value="{{$person->id}}">{{$person->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </fieldset>
                            @if (session('msg'))
                                <div class="alert alert-{{session('status')}}" role="alert">
                                    {{ session('msg') }}
                                </div>
                            @endif
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="module">
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush

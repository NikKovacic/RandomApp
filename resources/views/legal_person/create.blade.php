@extends('layouts.app')

@section('content')
    <!-- @todo: translate! & add to components! -->
    <div class="container">
        <div class="row justify-content-center mb-3">
            <div class="col-lg-8 col-md-10">
                <a href="{{ route('legal-person.index') }}" class="btn btn-sm btn-outline-secondary float-start">
                    <i class="fa-solid fa-chevron-left"></i> Back
                </a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card">
                    <div class="card-header">Add person</div>
                    <div class="card-body">
                        <x-person-form
                            method="POST"
                            action="{{route('legal-person.store')}}"
                        ></x-person-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

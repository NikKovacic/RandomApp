@extends('layouts.app')

@section('content')
    <!-- @todo: translate! & add to components! -> add icons (font awesome) -->
    <div class="container">
        <div class="row justify-content-center mb-3">
            <div class="col-lg-8 col-md-10">
                <a href="{{ route('legal-person.index') }}" class="btn btn-sm btn-outline-secondary float-start">
                    <i class="fa-solid fa-chevron-left"></i> Back
                </a>
                <a href="#deleteModal"
                   data-bs-toggle="modal"
                   role="button"
                   data-text="Are you sure want to delete selected person?"
                   data-title="Delete person"
                   data-action="{{ route('legal-person.destroy', $person->id) }}"
                   data-id="{{$person->id}}"
                   class="btn btn-sm btn-outline-danger float-end ms-2"
                >
                    <i class="fa-solid fa-trash"></i> Delete
                </a>
                <a href="{{ route('legal-person.edit', $person->id) }}" class="btn btn-sm btn-outline-secondary float-end">
                    <i class="fa-solid fa-edit"></i> Edit
                </a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card">
                    <div class="card-header">Person information</div>
                    <div class="card-body">
                        <div class="mb-3">
                            Name: {{$person->name}}
                        </div>
                        <div class="mb-3">
                            Email: {{$person->email}}
                        </div>
                        <div class="mb-3">
                            Phone: {{$person->phone}}
                        </div>
                        <div class="mb-3">
                            TIN: {{$person->tin}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('modals')
    @include('partials._modal-delete')
@endpush




@extends('layouts.app')

@section('content')
    <!-- @todo: translate! & add to components! -->
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
                   class="btn btn-sm btn-outline-danger float-end"
                >
                    <i class="fa-solid fa-trash"></i> Delete
                </a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card">
                    <div class="card-header">Edit person</div>
                    <div class="card-body">
                        <x-person-form
                            method="POST"
                            overrideMethod="PATCH"
                            action="{{route('legal-person.update', $person->id)}}"
                            :person="$person"
                        ></x-person-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('modals')
    @include('partials._modal-delete')
@endpush




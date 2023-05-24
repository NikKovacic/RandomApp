@extends('layouts.app')

@section('content')
    <!-- @todo: translate! & add to components! -->
    <!-- @todo: implement search -->
    <div class="container">
        <div class="row justify-content-center mb-3">
            <div class="col-lg-10 col-md-12">
                <a href="{{ route('legal-person.create') }}" class="btn btn-sm btn-outline-primary float-end"><i class="fa-solid fa-add"></i> Add person</a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12">
                <div class="card mb-3">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @forelse($people as $person)
                                    <tr class="clickable-row" data-url="{{route('legal-person.show', $person->id)}}">
                                        <td class="clickable">{{$person->name}}</td>
                                        <td class="clickable">{{$person->email}}</td>
                                        <td class="clickable">{{$person->phone}}</td>
                                        <td class="text-center">
                                            <span class="text-wrap">
                                                <a href="{{ route('legal-person.edit', $person->id) }}" class="text-decoration-none">
                                                    <i class="fa-solid fa-edit text-secondary me-1"></i>
                                                </a>
                                                <a href="#deleteModal"
                                                   data-bs-toggle="modal"
                                                   role="button"
                                                   data-text="Are you sure want to delete selected person?"
                                                   data-title="Delete person"
                                                   data-action="{{ route('legal-person.destroy', $person->id) }}"
                                                   data-id="{{$person->id}}"
                                                   class="text-decoration-none"
                                                >
                                                    <i class="fa-solid fa-trash text-danger me-1"></i>
                                                </a>
                                                <!-- @todo: call route for sending sending sms/mail! -->
                                                <a href="#" class="text-decoration-none">
                                                    <i class="fa-solid fa-sms text-primary me-1"></i>
                                                </a>
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">There are no users.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                {!! $people->withQueryString()->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
@endsection

@push('modals')
    @include('partials._modal-delete')
@endpush

@push('scripts')
    <script type="module" src="{{asset('modules/module-clickable-row.js')}}" defer></script>
@endpush

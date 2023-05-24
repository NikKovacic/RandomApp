@extends('layouts.app')

@section('content')
    <!-- @todo: translate! & add to components! -->
    <!-- @todo: implement search -->
    <div class="container">
        <div class="row justify-content-center mb-3">
            <div class="col-lg-10 col-md-12">
                <a href="{{ route('group.create') }}" class="btn btn-sm btn-outline-primary float-end"><i class="fa-solid fa-add"></i> Add group</a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12">
                <div class="card mb-3">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                            <th>Name</th>
                            <th>Members</th>
                            <th></th>
                            </thead>
                            <tbody>
                            @forelse($groups as $group)
                                <tr class="clickable-row" data-url="{{route('group.show', $group->id)}}">
                                    <td class="clickable">{{$group->name}}</td>
                                    <td class="clickable">{{$group->natural_persons_count + $group->legal_persons_count}}</td>
                                    <td class="text-center">
                                        <!--@todo: actions and buttons! -> similar as in legal person index-->
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">There are no groups.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                {!! $groups->withQueryString()->links('pagination::bootstrap-5') !!}
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

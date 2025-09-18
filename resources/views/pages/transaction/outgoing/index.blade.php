@extends('layout.main')

@section('content')
<!-- <x-breadcrumb
        :values="[__('menu.transaction.menu'), __('menu.transaction.outgoing_letter')]">
        <a href="{{ route('transaction.outgoing.create') }}" class="btn btn-primary">{{ __('menu.general.create') }}</a>
    </x-breadcrumb> -->

<x-filter
    :since="$since"
    :until="$until"
    :filter="$filter"
    :status="$status"
    :statuses="$statuses"
    letterType="outgoing">
    @if(auth()->user()->role == 'admin' || auth()->user()->role == 'tatausaha')
    <div class="py-3">
        <a href="{{ route('transaction.outgoing.create', ['mode' => 'upload']) }}" class="btn btn-primary">{{ __('menu.general.create') }}</a>
    </div>
    @endif
</x-filter>

@foreach($data as $letter)
<x-letter-card
    :letter="$letter" />
@endforeach

{!! $data->appends(['search' => $search])->links() !!}
@endsection
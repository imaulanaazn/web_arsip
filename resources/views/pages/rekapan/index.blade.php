@extends('layout.main')

@push('style')
<link rel="stylesheet" href="{{asset('sneat/vendor/libs/apex-charts/apex-charts.css')}}" />
@endpush

@section('content')
<div class="row">
    <div class="col-9">
        <div class="card mb-5">
            <div class="card-header">
                <div class="row align-items-end justify-content-between">
                    <form class="col" action="{{ url()->current() }}">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="periode" class="form-label">Periode</label>
                                    <select class="form-select" id="periode" name="periode">
                                        <option
                                            value="" @selected(old('periode', $periode)=='' )>Semua</option>
                                        <option
                                            value="today" @selected(old('periode', $periode)=='today' )>Hari Ini</option>
                                        <option
                                            value="thisMonth" @selected(old('periode', $periode)=='thisMonth' )>Bulanan Ini</option>
                                        <option
                                            value="thisYear" @selected(old('periode', $periode)=='thisYear' )>Tahun Ini</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="type" class="form-label">Jenis</label>
                                    <select class="form-select" id="type" name="type">
                                        <option
                                            value="" @selected(old('type', $type)=='' )>Semua</option>
                                        <option
                                            value="incoming" @selected(old('type', $type)=='incoming' )>Surat Masuk</option>
                                        <option
                                            value="outgoing" @selected(old('type', $type)=='outgoing' )>Surat Keluar</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('menu.general.action') }}</label>
                                    <div class="row">
                                        <div class="col">
                                            <button class="btn btn-primary"
                                                type="submit">{{ __('menu.general.filter') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="col mb-3" style="flex: 0;">
                        <a
                            href="{{ route('rekapan.print', [
                                'periode' => request('periode', $periode),
                                'type' => request('type', $type)
                            ]) }}"
                            target="_blank"
                            class="btn btn-primary">
                            {{ __('menu.general.print') }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nomor Surat</th>
                            <th>Jenis Surat</th>
                            @if($type == 'incoming')
                            <th>Pengirim</th>
                            @elseif($type == 'outgoing')
                            <th>Penerima</th>
                            @else
                            <th>Pengirim</th>
                            <th>Penerima</th>
                            @endif
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    @if($data)
                    <tbody>
                        @foreach($data as $agenda)
                        <tr>
                            <td>
                                <a href="{{ route('transaction.incoming.show', $agenda) }}">{{ $agenda->reference_number }}</a>
                            </td>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                <strong>{{ $agenda->type === 'incoming' ? "Surat Masuk" : "Surat Keluar" }}</strong>
                            </td>
                            @if($type == 'incoming')
                            <td>{{ $agenda->from }}</td>
                            @elseif($type == 'outgoing')
                            <td>{{ $agenda->to }}</td>
                            @else
                            <td>{{ $agenda->from }}</td>
                            <td>{{ $agenda->to }}</td>
                            @endif
                            <td>{{ $agenda->formatted_letter_date }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    @else
                    <tbody>
                        <tr>
                            <td colspan="4" class="text-center">
                                {{ __('menu.general.empty') }}
                            </td>
                        </tr>
                    </tbody>
                    @endif
                </table>
            </div>
        </div>
    </div>
    <div class="col-3 col">
        @if($incomingLetter)
        <div class="col-12 mb-4">
            <x-dashboard-card-simple
                label="Surat Masuk ({{ $label }})"
                :value="$incomingLetter"
                :daily="true"
                color="success"
                icon="bx-envelope"
                :percentage="0" />
        </div>
        @endif
        @if($outgoingLetter)
        <div class="col-12 mb-4">
            <x-dashboard-card-simple
                label="Surat Keluar ({{ $label }})"
                :value="$outgoingLetter"
                :daily="true"
                color="danger"
                icon="bx-envelope"
                :percentage="0" />
        </div>
        @endif
        <div class="col-12 mb-4">
            <x-dashboard-card-simple
                label="Disposisi Surat ({{ $label }})"
                :value="$dispositionLetter"
                :daily="true"
                color="primary"
                icon="bx-envelope"
                :percentage="0" />
        </div>
        <div class="col-12 mb-4">
            <x-dashboard-card-simple
                label="Pengguna Aktif"
                :value="$activeUser"
                :daily="false"
                color="info"
                icon="bx-user-check"
                :percentage="0" />
        </div>
    </div>
</div>

@endsection
@extends('layout.main')

@push('style')
<link rel="stylesheet" href="{{asset('sneat/vendor/libs/apex-charts/apex-charts.css')}}" />
@endpush

@push('script')
<script src="{{asset('sneat/vendor/libs/apex-charts/apexcharts.js')}}"></script>
<script>
    const options = {
        chart: {
            type: 'bar'
        },
        series: [{
            name: '{{ __('dashboard.letter_transaction ') }}',
            data: [{{$thisMonthIncomingLetter}}, {{$thisMonthOutgoingLetter}}, {{$thisMonthDispositionLetter}}]
        }],
        stroke: {
            curve: 'smooth',
        },
        xaxis: {
            categories: [
                '{{ __('dashboard.incoming_letter') }}',
                '{{ __('dashboard.outgoing_letter') }}',
                '{{ __('dashboard.disposition_letter') }}',
            ],
        }
    }
    const chart = new ApexCharts(document.querySelector("#today-graphic"), options);
    chart.render();
</script>
@endpush

@section('content')
<div class="row">
    <div class="col-lg-8 col-md-8 col-12 mb-4 order-0">
        <div class="card mb-4">
            <div class="d-flex align-items-end row">
                <div class="col-sm-7">
                    <div class="card-body">
                        <h4 class="card-title text-primary">{{ $greeting }}</h4>
                        <p class="mb-4">
                            {{ $currentDate }}
                        </p>
                        <p style="font-size: smaller" class="text-gray">*) {{ __('dashboard.today_report') }}</p>
                    </div>
                </div>
                <div class="col-sm-5 text-center text-sm-left">
                    <div class="card-body pb-0 px-0 px-md-4">
                        <img src="{{asset('sneat/img/man-with-laptop-light.png')}}" height="140"
                            alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                            data-app-light-img="illustrations/man-with-laptop-light.png">
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <div class="card">
                <div class="card-body">
                    <div>
                        <div class="">
                            <div class="card-title d-flex align-items-center justify-content-between">
                                <h5 class="text-nowrap mb-2">Grafik Transaksi Surat</h5>
                                <span class="badge bg-label-warning rounded-pill">Bulan Ini</span>
                            </div>
                        </div>
                        <div id="profileReportChart" style="min-height: 80px">
                            <div id="today-graphic"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-12 order-1">
        <div class="row">
            <div class="col-12 mb-4">
                <x-dashboard-card-simple
                    label="Surat Masuk (bulan ini)"
                    :value="$thisMonthIncomingLetter"
                    :daily="true"
                    color="success"
                    icon="bx-envelope"
                    :percentage="$percentageIncomingLetter" />
            </div>
            <div class="col-12 mb-4">
                <x-dashboard-card-simple
                    label="Surat Keluar (bulan ini)"
                    :value="$thisMonthOutgoingLetter"
                    :daily="true"
                    color="danger"
                    icon="bx-envelope"
                    :percentage="$percentageOutgoingLetter" />
            </div>
            <div class="col-12 mb-4">
                <x-dashboard-card-simple
                    label="Disposisi Surat (bulan ini)"
                    :value="$thisMonthDispositionLetter"
                    :daily="true"
                    color="primary"
                    icon="bx-envelope"
                    :percentage="$percentageDispositionLetter" />
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
</div>
@endsection
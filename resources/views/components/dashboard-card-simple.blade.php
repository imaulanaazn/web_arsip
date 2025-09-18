<div class="card">
    <div class="card-body">
        <div class="card-title d-flex align-items-start justify-content-between mb-0">
            <div class="avatar flex-grow-1">
                <span class="fw-semibold d-block">{{ $label }}</span>
               
            </div>
            @if($label != __('dashboard.disposition_letter') && !(auth()->user()->role == 'tatausaha' && $label == __('dashboard.active_user')))
            <div class="dropdown">
                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                    @if($label == __('dashboard.incoming_letter'))
                    <a class="dropdown-item"
                        href="{{ route('transaction.incoming.index') }}">{{ __('dashboard.view_more') }}</a>
                    @elseif($label == __('dashboard.outgoing_letter'))
                    <a class="dropdown-item"
                        href="{{ route('transaction.outgoing.index') }}">{{ __('dashboard.view_more') }}</a>
                    @elseif($label == __('dashboard.active_user'))
                    <a class="dropdown-item"
                        href="{{ route('user.index') }}">{{ __('dashboard.view_more') }}</a>
                    @endif
                </div>
            </div>
            @endif
        </div>
        <div class="d-flex align-items-center justify-content-between">

            <span class="badge bg-label-{{ $color }} p-2">
                <i class="bx {{ $icon }} text-{{ $color }}"></i>
            </span>
             <div class="d-flex align-items-center gap-2">
                 <h3 class="card-title mb-2">{{ $value }}</h3>
                 <!-- @if($percentage > 0)
                 <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> {{ $percentage }}%</small>
                 @elseif($percentage < 0)
                 <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> {{ $percentage }}%</small>
                 @endif -->
             </div>
        </div>
    </div>
</div>
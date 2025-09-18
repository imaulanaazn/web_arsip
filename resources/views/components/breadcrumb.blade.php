<div>
    @if(count($values))
        <div class="d-flex justify-content-between flex-column flex-sm-row">
            <h6 class="fw-bold py-3 mt-0 mb-0">
                @foreach($values as $value)
                    @if($loop->last)
                        {{ $value }}
                    @else
                        <span class="text-muted fw-light">{{ $value }} /</span>
                    @endif
                @endforeach
            </h6>
            <div class="py-3">
                {{ $slot }}
            </div>
        </div>
    @endif
</div>

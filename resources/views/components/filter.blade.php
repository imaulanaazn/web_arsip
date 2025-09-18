 <div class="d-flex justify-content-between align-items-end flex-column flex-sm-row rounded">
     <form action="{{ url()->current() }}">
         <input type="hidden" name="search" value="{{ $search ?? '' }}">
         <div class="row">
             <div class="col px-2">
                 <x-input-form name="since" :label="__('menu.agenda.start_date')" type="date"
                     :value="$since ? date('Y-m-d', strtotime($since)) : ''" />
             </div>
             <div class="col px-2">
                 <x-input-form name="until" :label="__('menu.agenda.end_date')" type="date"
                     :value="$until ? date('Y-m-d', strtotime($until)) : ''" />
             </div>
             <div class="col px-2">
                 <div class="mb-3">
                     <label for="filter" class="form-label">Berdasarkan</label>
                     <select class="form-select" id="filter" name="filter">
                         <option
                             value="letter_date" @selected(old('filter', $filter)=='letter_date' )>{{ __('model.letter.letter_date') }}</option>
                         @if($letterType == 'incoming')
                         <option
                             value="received_date" @selected(old('filter', $filter)=='received_date' )>{{ __('model.letter.received_date') }}</option>
                         @endif
                         <option
                             value="created_at" @selected(old('filter', $filter)=='created_at' )>{{ __('model.general.created_at') }}</option>
                     </select>
                 </div>
             </div>
             @if($letterType == 'incoming')
             <div class="col px-2">
                 <div class="mb-3">
                     <label for="status" class="form-label">Status</label>
                     <select class="form-select" id="status" name="status">
                         <option value="">Semua</option>
                         @foreach($statuses as $value)
                         <option
                             value="{{$value->id}}" @selected($value->id == $status)>{{$value->status}}</option>
                         @endforeach
                     </select>
                 </div>
             </div>
             @else
             <div class="col px-2">
                 <div class="mb-3">
                     <label for="status" class="form-label">Status</label>
                     <select class="form-select" id="status" name="status">
                         <option
                             value="">Semua</option>
                         <option
                             value="1" @selected($status=="1" )>Disahkan</option>
                         <option
                             value="0" @selected($status=="0" )>Belum Disahkan</option>
                     </select>
                 </div>
             </div>
             @endif
             <div class="col px-2">
                 <div class="mb-3">
                     <label class="form-label">{{ __('menu.general.action') }}</label>
                     <button class="btn btn-primary d-block"
                         type="submit">{{ __('menu.general.filter') }}</button>
                 </div>
             </div>
         </div>
     </form>
     {{$slot}}
 </div>
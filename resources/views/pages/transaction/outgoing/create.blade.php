@extends('layout.main')

@section('content')
<!-- <x-breadcrumb
    :values="[__('menu.transaction.menu'), __('menu.transaction.outgoing_letter'), __('menu.general.create')]">
</x-breadcrumb> -->

<div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-6 card mb-4">
        <form method="POST" enctype="multipart/form-data" id="letterForm">
            @csrf
            <div class="card-body row">
                <div class="d-flex mb-4">
                    <a href="{{ request()->fullUrlWithQuery(['mode' => 'upload']) }}" class="{{$mode == 'upload' ? 'text-primary' : 'text-secondary'}}"><u>Upload Surat</u></a>
                    <span class="mx-2">/</span>
                    <a href="{{ request()->fullUrlWithQuery(['mode' => 'tulis']) }}" class="{{$mode == 'tulis' ? 'text-primary' : 'text-secondary'}}"><u>Tulis Surat</u></a>
                </div>
                <input type="hidden" name="mode" value="{{$mode}}">
                <input type="hidden" name="type" value="outgoing">
                <div class="col-sm-12 col-12 col-md-6 col-lg-6">
                    <x-input-form name="reference_number" :label="__('model.letter.reference_number')"/>
                </div>
                <div class="col-sm-12 col-12 col-md-6 col-lg-6">
                    <x-input-form name="agenda_number" :label="__('model.letter.agenda_number')" />
                </div>
                <div class="col-sm-12 col-12 col-md-12 col-lg-12">
                    <x-input-form name="to" :label="__('model.letter.to')" />
                </div>
                <div class="col-sm-12 col-12 col-md-6 col-lg-12">
                    <x-input-form name="letter_date" :label="__('model.letter.letter_date')" type="date" />
                </div>
                <div class="col-sm-12 col-12 col-md-12 col-lg-12">
                    <x-input-textarea-form name="description" :label="__('model.letter.description')" />
                </div>
                <div class="col-sm-12 col-12 col-md-6 col-lg-6">
                    <div class="mb-3">
                        <label for="classification_code" class="form-label">{{ __('model.letter.classification_code') }}</label>
                        <select class="form-select" id="classification_code" name="classification_code">
                            @foreach($classifications as $classification)
                            <option
                                value="{{ $classification->code }}" @selected(old('classification_code')==$classification->code)>
                                {{ $classification->type }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 col-12 col-md-6 col-lg-6">
                    <x-input-form name="note" :label="__('model.letter.note')" />
                </div>
                @if($mode == "tulis")
                <div class="col-sm-12 col-12 col-md-12 col-lg-12 mb-3">
                    <label for="editor" class="form-label">Isi Surat</label>
                    <textarea name="content" id="tinyEditor"></textarea>
                </div>
                @endif
                @if($mode == "tulis" || $mode == "upload")
                <div class="col-sm-12 col-12 col-md-12 col-lg-12">
                    <div class="mb-3">
                        <label for="attachments" class="form-label">{{ __('model.letter.attachment') }}</label>
                        <input type="file" class="form-control @error('attachments') is-invalid @enderror" id="attachments" name="attachments[]" multiple />
                        <span class="error invalid-feedback">{{ $errors->first('attachments') }}</span>
                    </div>
                </div>
                @endif
            </div>
            <!-- <div class="card-footer pt-0">
                @if($mode)
                    @if($mode == 'tulis')
                        <button class="btn btn-outline-primary" type="submit" formaction="{{ route('transaction.outgoing.create_preview') }}">Preview</button>
                    @endif
                    <button class="btn btn-primary" type="submit" formaction="{{ route('transaction.outgoing.store') }}">Simpan</button>
                @endif
            </div> -->
            <div class="card-footer pt-0">
                @if($mode)
                    @if($mode == 'tulis')
                        <button class="btn btn-outline-primary" type="submit" onclick="submitForm('{{ route('transaction.outgoing.create_preview') }}', true)">Preview</button>
                    @endif
                    <button class="btn btn-primary" type="submit" onclick="submitForm('{{ route('transaction.outgoing.store') }}', false)">Simpan</button>
                @endif
            </div>
        </form>
    </div>
</div>
@endsection
<form>
  <div class="form-group row">
    <label for="name" class="col-form-label col-md-2">{{ __('translations.signatures.name') }}</label>
    <div class="col-md-10">
      <input type="text" class="form-control" id="name" name="name" value="{{ $signature->name ?? '' }}"
             autocomplete="off">
    </div>
  </div>
  <div class="form-group row">
    <label for="syntax" class="col-form-label col-md-2">{{ __('translations.signatures.syntax') }}</label>
    <div class="col-md-10" data-toggle="tooltip" title="
      <div class='text-left'>
        <B>{counter} - {{ __('translations.signatures.syntax.counter') }}</B><br/>
        {month} - {{ __('translations.signatures.syntax.month') }}<br/>
        {year} - {{ __('translations.signatures.syntax.year') }}
      </div>
      " data-placement="bottom">
      <input type="text" class="form-control" id="syntax" name="syntax" value="{{ $signature->syntax ?? '' }}"
             autocomplete="off" placeholder="FV/{year}/{month}/{counter}">
    </div>
  </div>
  <div class="form-group row">
    <label for="description" class="col-form-label col-md-2">{{ __('translations.signatures.description') }}</label>
    <div class="col-md-10">
      <textarea class="form-control" id="description" name="description">{{ $signature->description ?? '' }}</textarea>
    </div>
  </div>
  <div class="form-group row">
    <label for="mode" class="col-form-label col-md-2">{{ __('translations.signatures.counter_type') }}</label>
    <div class="col-md-10">
      <select id="mode" class="form-control" name="mode">
        <option value="monthly" @if(isset($signature->mode) && $signature->mode == 'monthly') selected @endif >
          {{ __('translations.signatures.counter_type.monthly') }}
        </option>
        <option value="yearly" @if(isset($signature->mode) && $signature->mode == 'yearly') selected @endif >
          {{ __('translations.signatures.counter_type.yearly') }}
        </option>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label for="description" class="col-form-label col-md-2">{{ __('translations.signatures.invoice_types') }}</label>
    <div class="col-md-10">
      <div class="selectgroup selectgroup-pills">
        @foreach($invoice_types as $invoice_type)
          <label class="selectgroup-item" data-toggle="tooltip" title="{{ $invoice_type->name }}"
                 data-placement="bottom">
            <input type="checkbox" name="invoice_types[]" value="{{ $invoice_type->id }}" class="selectgroup-input"
              @foreach($signature->invoice_types ?? [] as $s_invoice_type)
                @if ($s_invoice_type->id == $invoice_type->id) checked @endif
              @endforeach
            >
            <span class="selectgroup-button">{{ $invoice_type->initials }}</span>
          </label>
        @endforeach
      </div>
      <div class="validation-block"></div>
    </div>
  </div>
</form>
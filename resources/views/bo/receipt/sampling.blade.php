<form
    class="form-horizontal"
    method="POST"
    @if (is_null($receipt->sampling))
        action="{{route('receipt.sampling.store', ['receipt' => $receipt])}}"
    @else
        action="{{route('receipt.sampling.update', ['receipt' => $receipt, 'sampling' => $receipt->sampling])}}"
    @endif
>
    @csrf
    @if (!is_null($receipt->sampling))
        @method('patch')
    @endif

    <fieldset>
        <div class="form-group">
            <div class="row">
                <label class="col-sm-2 control-label" for="gross_sample">{{__('Gross Sample')}}</label>
                <div class="col-sm-10">
                    <input type="number" step="0.1" name="gross_sample" id="gross_sample" class="form-control valid" number="true" aria-invalid="false" value="{{$receipt->sampling->gross_sample ?? ''}}" required>
                </div>
            </div>
        </div>
    </fieldset>

    <fieldset>
        <div class="form-group">
            <div class="row">
                <label class="col-sm-2 control-label" for="net_sample">{{__('Net Sample')}}</label>
                <div class="col-sm-10">
                    <input type="number" step="0.1" name="net_sample" id="net_sample" class="form-control" value="{{$receipt->sampling->net_sample ?? ''}}" required>
                </div>
            </div>
        </div>
    </fieldset>

    <fieldset>
        <div class="form-group">
            <div class="row">
                <label class="col-sm-2 control-label" for="ingress_humidity">{{__('Ingress Humidity')}}</label>
                <div class="col-sm-10">
                    <input type="number" step="0.1" name="ingress_humidity" id="ingress_humidity" class="form-control" value="{{$receipt->sampling->ingress_humidity ?? ''}}" required>
                </div>
            </div>
        </div>
    </fieldset>

    <fieldset>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-12">
                    <button class="btn btn-info btn-fill pull-right" type="submit">{{ __('Save') }}</button>
                </div>
            </div>
        </div>
    </fieldset>

</form>

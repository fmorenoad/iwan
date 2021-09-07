<div>
    <fieldset>
        <div class="form-group">
            <div class="row">
                <label class="col-sm-2 control-label" for="code">{{__('code plot')}}</label>
                <div class="col-sm-10">
                    <input type="text" name="code" id="code" class="form-control" wire:model="code" required>
                </div>
            </div>
        </div>
    </fieldset>
    <fieldset>
        <div class="form-group">
            <div class="row">
                <label class="col-sm-2 control-label" for="plot">{{__('plot')}}</label>
                <div class="col-sm-10">
                    <input type="text" name="plot" id="plot" class="form-control" value="{{$plot->plot ?? 'Parcela no existe'}}" readonly>
                </div>
            </div>
        </div>
    </fieldset>
    <fieldset>
        <div class="form-group">
            <div class="row">
                <label class="col-sm-2 control-label" for="farmer">{{__('Farmer')}}</label>
                <div class="col-sm-10">
                    <input type="text" name="farmer" id="farmer" class="form-control" value="{{$plot->farmer->name ?? 'Parcela no existe'}}" readonly>
                </div>
            </div>
        </div>
    </fieldset>
    <input type="hidden" name="plot_id" value="{{$plot->id ?? 'Parcela no existe'}}">
    <input type="hidden" name="farmer_id" value="{{$plot->farmer->id ?? 'Parcela no existe'}}">
</div>

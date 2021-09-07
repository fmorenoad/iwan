<div class="row">
    <div class="col-lg-4">
        <div class="form-group">
            <div class="typo-line">
                <span class="category">{{__('Plot?')}}</span> <p>{{$receipt->plot->plot}}</p>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <div class="typo-line">
                <span class="category">{{__('Farmer')}}</span> <p>{{$receipt->farmer->name}}</p>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <div class="typo-line">
                <span class="category">{{__('End of plot?')}}</span> <p>{{$receipt->end_of_plot}}</p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <div class="form-group">
            <div class="typo-line">
                <span class="category">{{__('Dispatch Guide')}}</span> <p>{{$receipt->dispatch_guide->number  . ' - ' . $receipt->dispatch_guide->kg . ' kg.'}}</p>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <div class="typo-line">
                <span class="category">{{__('Plot Departure Date')}}</span> <p>{{$receipt->plot_departure_date->format('d-m-Y H:i')}}</p>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <div class="typo-line">
                <span class="category">{{__('Entry Date')}}</span> <p>{{$receipt->entry_date->format('d-m-Y H:i')}}</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <div class="typo-line">
                <span class="category">{{__('PPU')}}</span> <p>{{strtoupper($receipt->ppu)}}</p>
            </div>
        </div>
    </div>
</div>

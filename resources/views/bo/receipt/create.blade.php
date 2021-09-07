@extends('layouts.app', ['activePage' => $activePage, 'activeButton' => $activeButton, 'title' => $title, 'navName' => $navName])
@push('css')
@livewireStyles
@endpush
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="section-image">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="mb-0">{{ __($title) }}</h3>
                                <a href="{{route('receipt.index')}}" class="btn btn-secondary btn-fill pull-right"><i class="w3-xxlarge fa fa-arrow-left"></i>{{ __('Return') }}</a>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{route('receipt.store')}}" class="form-horizontal">
                                    @csrf
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-2 control-label" for="ticket">{{__('Ticket')}}</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="ticket" id="ticket" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-2 control-label" for="enterprise_id">{{__('Enterprise')}}</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" name="enterprise_id" id="enterprise_id" required>
                                                        @foreach ($enterprises as $enterprise)
                                                        <option value="{{$enterprise->id}}">{{$enterprise->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>

                                        <livewire:receipt.plot-show />

                                    <fieldset>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-2 control-label" for="end_of_plot">{{__('end of plot?')}}</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" name="end_of_plot" id="end_of_plot" required>
                                                        <option value="0">No</option>
                                                        <option value="1">Si</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-2 control-label" for="kg_income">{{__('kg income')}}</label>
                                                <div class="col-sm-10">
                                                    <input type="number" name="kg_income" id="kg_income" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-2 control-label" for="plot_departure_date">{{__('plot departure date')}}</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="plot_departure_date" id="datetimepicker" class="form-control datetimepicker" required>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-2 control-label" for="entry_date">{{__('entry date')}}</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="entry_date" id="datetimepicker" class="form-control datetimepicker" required>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-2 control-label" for="ppu">{{__('ppu')}}</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="ppu" id="ppu" class="form-control" maxlength="6" required>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-2 control-label" for="dispatch_guide">{{__('dispatch guide')}}</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="dispatch_guide" id="dispatch_guide" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-2 control-label" for="kg_dispatch_guide">{{__('kg dispatch guide')}}</label>
                                                <div class="col-sm-10">
                                                    <input type="number" name="kg_dispatch_guide" id="kg_dispatch_guide" class="form-control" required>
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

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
@livewireScripts
    <script type="text/javascript">
        $(document).ready(function() {
            demo.initFullCalendar();
        });
    </script>
@endpush

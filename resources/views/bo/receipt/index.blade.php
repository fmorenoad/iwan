@extends('layouts.app', ['activePage' => $activePage, 'activeButton' => $activeButton, 'title' => $title, 'navName' => $navName])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="section-image">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card data-tables">
                            <div class="card-header">
                                <h3 class="mb-0">{{ __($title) }}</h3>
                                <a href="{{route('receipt.create')}}" class="btn btn-primary btn-fill pull-right"><i class="w3-xxlarge fa fa-plus"></i>{{ __('reception') }}</a>
                            </div>
                            <div class="card-body table-striped table-no-bordered table-hover dataTable dtr-inline table-full-width">
                                <div class="toolbar">
                                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                                </div>
                                <div class="fresh-datatables">
                                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>{{ __('Ticket') }}</th>
                                                <th>{{ __('Plant') }}</th>
                                                <th>{{ __('Plot') }}</th>
                                                <th>{{ __('Farmer') }}</th>
                                                <th>{{ __('Dispatch Guide') }}</th>
                                                <th>{{ __('Exit Plot') }}</th>
                                                <th>{{ __('Date Entry') }}</th>
                                                <th>{{ __('PPU') }}</th>
                                                <th>{{ __('State') }}</th>
                                                <th class="disabled-sorting text-right">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($receipts as $receipt)
                                            <tr>
                                                <td>{{$receipt->ticket}}</td>
                                                <td>{{$receipt->enterprise->name}}</td>
                                                <td>{{$receipt->plot->plot}}</td>
                                                <td>{{$receipt->farmer->name}}</td>
                                                <td>{{'N° '.$receipt->dispatch_guide->number.' - '.$receipt->dispatch_guide->kg.' kg.'}}</td>
                                                <td>{{$receipt->plot_departure_date}}</td>
                                                <td>{{$receipt->entry_date}}</td>
                                                <td>{{$receipt->ppu}}</td>
                                                <td>Definir estados</td>
                                                <td>
                                                    <a href="{{route('receipt.dump_truck.create', ['receipt' => $receipt->id])}}" class="btn btn-sm btn-primary btn-fill pull-right">{{ __('dump truck') }}</a>
                                                    <a href="{{route('receipt.show', ['receipt' => $receipt->id])}}" class="btn btn-sm btn-primary btn-fill pull-right">{{ __('sampling') }}</a>
                                                    <a href="{{route('receipt.check_out.create', ['receipt' => $receipt->id])}}" class="btn btn-sm btn-primary btn-fill pull-right">{{ __('check out') }}</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatables').DataTable({
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search records",
                }

            });


            var table = $('#datatables').DataTable();

            // Edit record
            table.on('click', '.edit', function() {
                $tr = $(this).closest('tr');

                if ($tr.hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }

                var data = table.row($tr).data();
                alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
            });

            // Delete a record
            table.on('click', '.remove', function(e) {
                $tr = $(this).closest('tr');
                table.row($tr).remove().draw();
                e.preventDefault();
            });

            //Like record
            table.on('click', '.like', function() {
                alert('You clicked on Like button');
            });
        });
    </script>
@endpush

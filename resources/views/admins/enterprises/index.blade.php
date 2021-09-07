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
                                <a href="{{route('enterprises.create')}}" class="btn btn-primary btn-fill pull-right"><i class="w3-xxlarge fa fa-plus"></i>{{ __('Enterprise') }}</a>
                            </div>
                            <div class="card-body table-striped table-no-bordered table-hover dataTable dtr-inline table-full-width">
                                <div class="toolbar">
                                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                                </div>
                                <div class="fresh-datatables">
                                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ __('DNI') }}</th>
                                                <th>{{ __('Enterprise') }}</th>
                                                <th>{{ __('Description') }}</th>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                <th class="disabled-sorting text-right">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($enterprises as $enterprise)
                                            <tr>
                                                <td>{{$enterprise->id}}</td>
                                                <td>{{$enterprise->dni}}</td>
                                                <td>{{$enterprise->name}}</td>
                                                <td>{{$enterprise->description}}</td>
                                                <td><a href="{{route('enterprises.edit', ['enterprise' => $enterprise])}}" class="btn btn-sm btn-info">
                                                    <i class="w3-xxlarge fa fa-pencil"></i></a></td>
                                                <td>
                                                <form action="{{ route('enterprises.destroy', $enterprise) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"  class="btn btn-sm btn-danger" onclick="return confirm('¿Desea elimnar...?')">
                                                        <i class="w3-xxlarge fa fa-trash"></i>
                                                    </button>
                                                </form></td>
                                                <td></td>
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

<div>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="card-description text-capitalize text-center font-weight-bolder text-dark">
                    {{ $tableName }} List
                </div>
                <div class="table-responsive">
                    <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="20"
                        width="100%">
                        <thead>
                            <tr>
                                @foreach ($columns as $column)
                                    <th class="th-sm text-capitalize">{{ $column }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contents as $content)
                                <tr>
                                    @for ($i = 0; $i < count($columns) - 2; $i++)
                                        <td style="max-width: 300px;" data-toggle="tooltip"
                                            title="{{ $content[$columns[$i]] }}" class="py-1 text-truncate">
                                            {{ $content[$columns[$i]] }}
                                        </td>
                                    @endfor
                                    <td class="th-sm"><a
                                            href="/admin/{{ $tableName }}/{{ $content['id'] }}"><button
                                                class="btn btn-primary">Edit</button></a>
                                    </td>
                                    <td class="th-sm"><a
                                            href="/admin/{{ $tableName }}/delete/{{ $content['id'] }}"><button
                                                class="btn btn-danger">Delete</button></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                @foreach ($columns as $column)
                                    <th class="th-sm text-capitalize">{{ $column }}
                                    </th>
                                @endforeach
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@if ($tableName == 'orders')
    <script>
        $(document).ready(function() {
            $('#dtBasicExample').DataTable({
                destroy: true,
                order: [
                    [0, 'desc']
                ],
            })
        });
    </script>
@endif

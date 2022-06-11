@extends('layouts.app')
@section('content')
    <div class="profile_container">
        <div class="tab">
            <a href="/profile"><button class="tablinks">Profile</button></a>
            <a href="/wallet"><button class="tablinks">Wallet</button></a>
            <a href="/orderHistory"><button class="tablinks active">Order History</button></a>
            <a href="/cart"><button class="tablinks">Cart</button></a>
        </div>
    </div>
    <div class="container">
        <div class="col-md-12 login">
            <div class="table-responsive" style="margin-top:50px;">
                <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="20" width="100%">
                    <thead>
                        <tr>
                            @foreach ($columns as $column)
                                <th class="th-sm text-capitalize">{{ $column }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @for ($j = count($orders) - 1; $j >= 0; $j--)
                            <tr>
                                @for ($i = 0; $i < count($columns); $i++)
                                    <td style="max-width: 300px;" data-toggle="tooltip"
                                        title="{{ $orders[$j][$columns[$i]] }}" class="py-1 text-truncate">
                                        {{ $orders[$j][$columns[$i]] }}
                                    </td>
                                @endfor
                        @endfor
                        </tr>
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
@endsection

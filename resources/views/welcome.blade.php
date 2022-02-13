<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Bank of Chris</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    </head>
    <body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h1>Bank of Chris</h1>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            @if (isset($data['new']))
                                <div class="col-lg-12">
                                    <div class="alert alert-success" role="alert">
                                        <h2>Success! {{ $data['new']['type'] }} #{{ $data['new']['id'] }}</h2>
                                        <ul>
                                            <li>{{ $data['new']['created_at'] }}</li>
                                            <li>{{ $data['new']['amount'] }}</li>
                                            <li>{{ $data['new']['notes'] }}</li>
                                        </ul>
                                    </div>
                                </div>
                            @endif
                            @if (isset($data['deleted']))
                                <div class="col-lg-12">
                                    <div class="alert alert-danger" role="alert">
                                        <h2>Record {{ $data['deleted']['type'] }} #{{ $data['deleted']['id'] }} deleted</h2>
                                    </div>
                                </div>
                            @endif
                            @if (isset($data['all'][0]['current_balance']))
                            <div class="col-lg-12">
                                <div class="alert alert-info" role="alert">
                                    <h2>Current balance £{{ $data['all'][0]['current_balance'] }}</h2>
                                </div>
                            </div>
                            @endif
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h3>Credit/Debit Memo</h3>
                                        <form action="{{ route('store') }}" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="transaction_by" class="form-label">Transaction by</label>
                                                <select name="transaction_by" id="transaction_by" class="form-control">
                                                    <option value="Seeta" {{ (old('transaction_by') == 'Seeta' ? 'selected' : '') }}>Seeta</option>
                                                    <option value="Chris" {{ (old('transaction_by') == 'Chris' ? 'selected' : '') }}>Chris</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="type" class="form-label">Type</label>
                                                <select name="type" id="type" class="form-control">
                                                    <option value="Debit" {{ (old('type') == 'Debit' ? 'selected' : '') }}>Debit</option>
                                                    <option value="Credit" {{ (old('type') == 'Credit' ? 'selected' : '') }}>Credit</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="amount" class="form-label">Amount</label>
                                                <input type="number" step=".01" class="form-control" id="amount" name="amount" value="{{ (old('amount') ? old('amount') : '') }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="notes" class="form-label">Notes</label>
                                                <input type="text" class="form-control" id="notes" name="notes" value="{{ (old('notes') ? old('notes') : '') }}">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Balance</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Notes</th>
                                        <th scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if (isset($data['all']))
                                        @foreach($data['all'] as $item )
                                            <tr>
                                                <th scope="row">{{ $item['id'] }}</th>
                                                <td>{{ date('d/m/Y', strtotime($item['created_at'])) }}</td>
                                                <td>{{ $item['current_balance'] }}</td>
                                                <td>{{ $item['transaction_by'] }}</td>
                                                <td>{{ $item['type'] }}</td>
                                                <td>{{ $item['amount'] }}</td>
                                                <td>{{ $item['notes'] }}</td>
                                                <td class="text-right">
                                                    @if ($data['all'][0]['id']==$item['id'])
                                                    <form action="{{ route('delete', $item['id']) }}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                                    </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <p>No data available.</p>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
</html>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Facture</title>
    <style>
        /* Reset CSS */
        body,
        html {
            margin: 0;
            padding: 0;
        }

        /* Invoice styles */
        .invoice {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f4f4f4;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .invoice .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .invoice .invoice-title {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .invoice .info {
            margin-bottom: 20px;
        }

        .invoice .info .recipient-info {
            margin-bottom: 10px;
        }

        .invoice .info .recipient-info span {
            font-weight: bold;
        }

        .invoice .info .invoice-details {
            margin-bottom: 10px;
        }

        .invoice .info .invoice-details span {
            font-weight: bold;
        }

        .invoice .table {
            width: 100%;
            border-collapse: collapse;
        }

        .invoice .table th,
        .invoice .table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .invoice .table th {
            background-color: #f9f9f9;
            font-weight: bold;
        }

        .invoice .table td.quantity,
        .invoice .table td.price {
            text-align: right;
        }

        .invoice .table td.total {
            font-weight: bold;
        }

        .invoice .total-section {
            margin-top: 20px;
            text-align: right;
        }

        .invoice .total-section span {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="invoice">
        <div class="invoice-title">
            Facture
        </div>
        <div class="info">
            <div class="recipient-info">
                <span>Destinataire</span>
                <p>Client : {{ $data->first()->patient }}</p>
            </div>
            <div class="invoice-details">
                <span>Détails de la facture:</span>
                <p>Date: {{ $data->first()->created_at->formatLocalized('%d %B %Y à %H:%M') }}</p>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Acte</th>
                    <th>Date</th>
                    <th>Montant</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $datas)
                    <tr>
                        <td>{{ $datas->acte }}</td>
                        <td>{{ $datas->created_at }}</td>
                        <td>{{ $datas->montant }}</td>
                    </tr>
                @endforeach
                <tr>
                    <th>Total</th>
                    <th></th>
                    <th>{{ $total->totale }}</th>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>

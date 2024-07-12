<!DOCTYPE html>
<html>

<head>
    <title>Monthly Report</title>
    <style>
        /* Define your styles for the PDF here */
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .invoice-header h2 {
            margin: 0;
        }

        .invoice-details {
            margin-bottom: 20px;
        }

        .invoice-details p {
            margin: 5px 0;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .invoice-table th,
        .invoice-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .invoice-table th {
            background-color: #f2f2f2;
        }

        .total {
            text-align: right;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="invoice-header">
        <h2>Monthly Report</h2>
    </div>

    @foreach ($orders as $order)
        <div class="invoice-details">
            <p><strong>Order ID:</strong> {{ $order->id }}</p>
            <p><strong>Date:</strong> {{ $order->created_at->format('Y-m-d') }}</p>
            <p><strong>Customer Name:</strong> {{ $order->customer->fullname }}</p>
            <!-- Add more details as needed -->
        </div>

        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Size</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->orderItems as $item)
                    <tr>
                        <td>{{ $item->product->sku }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->product->size_no }}</td>
                        <td>{{ $item->product->discount
                            ? intval($item->product->price) - intval($item->product->price) * (intval($item->product->discount) / 100)
                            : intval($item->product->price) }}
                        </td>
                        <td>{{ ($item->product->discount
                            ? intval($item->product->price) - intval($item->product->price) * (intval($item->product->discount) / 100)
                            : intval($item->product->price)) * $item->quantity }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="total">Total:</td>
                    <td>{{ $order->total }}</td>
                </tr>
            </tfoot>
        </table>
    @endforeach
</body>

</html>

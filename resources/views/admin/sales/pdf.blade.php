<style>
    table.steelBlueCols {
        border: 4px solid #555555;
        background-color: #555555;
        width: 400px;
        text-align: center;
        border-collapse: collapse;
    }

    table.steelBlueCols td,
    table.steelBlueCols th {
        border: 1px solid #555555;
        padding: 5px 10px;
    }

    table.steelBlueCols tbody td {
        font-size: 12px;
        font-weight: bold;
        color: #FFFFFF;
    }

    table.steelBlueCols td:nth-child(even) {
        background: #398AA4;
    }

    table.steelBlueCols thead {
        background: #398AA4;
        border-bottom: 10px solid #398AA4;
    }

    table.steelBlueCols thead th {
        font-size: 15px;
        font-weight: bold;
        color: #FFFFFF;
        text-align: left;
        border-left: 2px solid #398AA4;
    }

    table.steelBlueCols thead th:first-child {
        border-left: none;
    }

    table.steelBlueCols tfoot td {
        font-size: 13px;
    }

    table.steelBlueCols tfoot .links {
        text-align: right;
    }

    table.steelBlueCols tfoot .links a {
        display: inline-block;
        background: #FFFFFF;
        color: #398AA4;
        padding: 2px 8px;
        border-radius: 5px;
    }
</style>

<table class="steelBlueCols" style="width: 100%">
    <thead>
        <tr>
            <th>@lang('translate.product_name')</th>
            <th>@lang('translate.quantity')</th>
            <th>@lang('translate.once_price')</th>
            <th>@lang('translate.total_price')</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                @foreach (explode("\n", $saleData['product_name']) as $name)
                <div>{{ $name }}</div>
                @endforeach
            </td>
            <td>
                @foreach (explode("\n", $saleData['quantity']) as $quantity)
                <div>{{ $quantity }}</div>
                @endforeach
            </td>
            <td>
                @foreach (explode("\n", $saleData['once_price']) as $once_price)
                <div>{{ $once_price }}</div>
                @endforeach
            </td>
            <td>{{ $saleData['total_price'] }}</td>
        </tr>
    </tbody>
</table>

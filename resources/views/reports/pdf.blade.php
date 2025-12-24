<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Market Report</title>
    <style>
        body { font-family: sans-serif; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        h1 { margin: 0; color: #1a202c; }
        .date { color: #666; font-size: 0.9em; margin-top: 5px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 12px; }
        th { background-color: #f3f4f6; color: #111; font-weight: bold; text-align: left; padding: 10px; border-bottom: 2px solid #ddd; }
        td { padding: 10px; border-bottom: 1px solid #eee; }
        .text-right { text-align: right; }
        .text-green { color: #16a34a; }
        .text-red { color: #dc2626; }
        .footer { position: fixed; bottom: 0; left: 0; right: 0; text-align: center; font-size: 10px; color: #999; border-top: 1px solid #eee; padding-top: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>FXFLARE Market Intelligence Report</h1>
        <div class="date">Generated on: {{ $date }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Asset</th>
                <th class="text-right">Price (USD)</th>
                <th class="text-right">24h Change</th>
                <th class="text-right">Market Cap</th>
            </tr>
        </thead>
        <tbody>
            @foreach($coins as $coin)
                <tr>
                    <td>
                        <strong>{{ $coin['name'] }}</strong> <span style="color: #666; font-size: 0.8em;">({{ strtoupper($coin['symbol']) }})</span>
                    </td>
                    <td class="text-right">${{ number_format($coin['current_price'], 2) }}</td>
                    <td class="text-right {{ $coin['price_change_percentage_24h'] >= 0 ? 'text-green' : 'text-red' }}">
                        {{ number_format($coin['price_change_percentage_24h'], 2) }}%
                    </td>
                    <td class="text-right">${{ number_format($coin['market_cap']) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        &copy; {{ date('Y') }} FXFLARE. All rights reserved. Data provided by CoinGecko.
    </div>
</body>
</html>

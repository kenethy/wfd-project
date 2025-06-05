<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping Label - {{ $shipment->tracking_number }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            body { margin: 0; }
            .no-print { display: none; }
            .print-only { display: block; }
        }
        .print-only { display: none; }
    </style>
</head>
<body class="bg-white">
    <div class="max-w-4xl mx-auto p-8">
        <!-- Print Button -->
        <div class="no-print mb-6 text-center">
            <button onclick="window.print()" class="bg-purple-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-purple-700 transition-colors duration-200">
                🖨️ Print Label
            </button>
            <button onclick="window.close()" class="bg-slate-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-slate-700 transition-colors duration-200 ml-4">
                ✕ Close
            </button>
        </div>

        <!-- Shipping Label -->
        <div class="bg-white border-2 border-slate-300 rounded-lg p-8 shadow-lg">
            <!-- Header -->
            <div class="border-b-2 border-slate-200 pb-6 mb-6">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-3xl font-bold text-slate-900 mb-2">FACIONA MARKETPLACE</h1>
                        <p class="text-lg text-slate-600">Professional E-commerce Platform</p>
                    </div>
                    <div class="text-right">
                        <div class="flex items-center space-x-2 mb-2">
                            <span class="text-3xl">{{ $shipment->courier_logo }}</span>
                            <span class="text-2xl font-bold text-slate-900">{{ $shipment->courier_name }}</span>
                        </div>
                        <p class="text-lg text-slate-600">{{ $shipment->service_type }} Service</p>
                    </div>
                </div>
            </div>

            <!-- Tracking Information -->
            <div class="grid grid-cols-2 gap-8 mb-8">
                <div class="bg-slate-50 p-6 rounded-lg">
                    <h2 class="text-xl font-bold text-slate-900 mb-4">Tracking Information</h2>
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm text-slate-600">Tracking Number</p>
                            <p class="text-2xl font-mono font-bold text-slate-900">{{ $shipment->tracking_number }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-slate-600">Order Number</p>
                            <p class="text-lg font-semibold text-slate-900">{{ $shipment->order->order_number }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-slate-600">Weight</p>
                            <p class="text-lg font-semibold text-slate-900">{{ $shipment->weight }} kg</p>
                        </div>
                        <div>
                            <p class="text-sm text-slate-600">Shipping Cost</p>
                            <p class="text-lg font-semibold text-slate-900">{{ $shipment->formatted_shipping_cost }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-50 p-6 rounded-lg">
                    <h2 class="text-xl font-bold text-slate-900 mb-4">Delivery Information</h2>
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm text-slate-600">Origin</p>
                            <p class="text-lg font-semibold text-slate-900">{{ $shipment->origin_city }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-slate-600">Destination</p>
                            <p class="text-lg font-semibold text-slate-900">{{ $shipment->destination_city }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-slate-600">Estimated Delivery</p>
                            <p class="text-lg font-semibold text-slate-900">{{ $shipment->estimated_delivery_date->format('F j, Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-slate-600">Service Days</p>
                            <p class="text-lg font-semibold text-slate-900">{{ $shipment->estimated_days }} days</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Addresses -->
            <div class="grid grid-cols-2 gap-8 mb-8">
                <!-- Sender Information -->
                <div class="border-2 border-slate-300 p-6 rounded-lg">
                    <h2 class="text-xl font-bold text-slate-900 mb-4 bg-slate-100 -m-6 p-4 rounded-t-lg">FROM (SENDER)</h2>
                    <div class="space-y-2 mt-4">
                        <p class="text-lg font-bold text-slate-900">FACIONA MARKETPLACE</p>
                        <p class="text-slate-700">Seller: {{ $shipment->order->orderItems->first()->product->seller->name ?? 'Unknown Seller' }}</p>
                        <p class="text-slate-700">Jl. Marketplace No. 123</p>
                        <p class="text-slate-700">{{ $shipment->origin_city }}, 12345</p>
                        <p class="text-slate-700">Indonesia</p>
                        <p class="text-slate-700 font-semibold">Phone: +62 21 1234 5678</p>
                    </div>
                </div>

                <!-- Recipient Information -->
                <div class="border-2 border-slate-300 p-6 rounded-lg">
                    <h2 class="text-xl font-bold text-slate-900 mb-4 bg-slate-100 -m-6 p-4 rounded-t-lg">TO (RECIPIENT)</h2>
                    <div class="space-y-2 mt-4">
                        <p class="text-lg font-bold text-slate-900">{{ $shipment->recipient_name }}</p>
                        <p class="text-slate-700">{{ $shipment->recipient_address }}</p>
                        <p class="text-slate-700">{{ $shipment->destination_city }}</p>
                        <p class="text-slate-700">Indonesia</p>
                        <p class="text-slate-700 font-semibold">Phone: {{ $shipment->recipient_phone }}</p>
                    </div>
                </div>
            </div>

            <!-- Package Contents -->
            <div class="border-2 border-slate-300 p-6 rounded-lg mb-8">
                <h2 class="text-xl font-bold text-slate-900 mb-4 bg-slate-100 -m-6 p-4 rounded-t-lg">PACKAGE CONTENTS</h2>
                <div class="mt-4">
                    <div class="grid grid-cols-4 gap-4 font-semibold text-slate-700 border-b border-slate-300 pb-2 mb-4">
                        <div>Product Name</div>
                        <div>SKU</div>
                        <div>Quantity</div>
                        <div>Value</div>
                    </div>
                    @foreach($shipment->order->orderItems as $item)
                    <div class="grid grid-cols-4 gap-4 text-slate-600 py-2 border-b border-slate-100">
                        <div class="font-medium">{{ $item->product->name }}</div>
                        <div>{{ $item->product->sku ?? 'N/A' }}</div>
                        <div>{{ $item->quantity }}</div>
                        <div>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</div>
                    </div>
                    @endforeach
                    <div class="grid grid-cols-4 gap-4 font-bold text-slate-900 pt-4 border-t-2 border-slate-300 mt-4">
                        <div class="col-span-3">Total Package Value:</div>
                        <div>{{ $shipment->order->formatted_total }}</div>
                    </div>
                </div>
            </div>

            <!-- Barcode Area (Mock) -->
            <div class="text-center border-2 border-dashed border-slate-300 p-8 mb-6">
                <div class="text-6xl font-mono tracking-widest text-slate-400 mb-4">
                    ||||| |||| | |||| ||||| | |||| |||||
                </div>
                <p class="text-2xl font-mono font-bold text-slate-900">{{ $shipment->tracking_number }}</p>
                <p class="text-sm text-slate-600 mt-2">Scan this barcode for tracking</p>
            </div>

            <!-- Footer -->
            <div class="border-t-2 border-slate-200 pt-6">
                <div class="grid grid-cols-3 gap-8 text-center">
                    <div>
                        <p class="text-sm text-slate-600">Created Date</p>
                        <p class="font-semibold text-slate-900">{{ $shipment->created_at->format('F j, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-600">Status</p>
                        <p class="font-semibold text-slate-900">{{ $shipment->status_label }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-600">Reference</p>
                        <p class="font-semibold text-slate-900">{{ $shipment->order->order_number }}</p>
                    </div>
                </div>
            </div>

            <!-- Instructions -->
            <div class="mt-8 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <h3 class="font-bold text-yellow-800 mb-2">📋 Shipping Instructions</h3>
                <ul class="text-sm text-yellow-700 space-y-1">
                    <li>• Handle with care - fragile items inside</li>
                    <li>• Keep package dry and away from moisture</li>
                    <li>• Deliver to recipient only - signature required</li>
                    <li>• Contact customer at provided phone number if delivery issues</li>
                    <li>• Return to sender if delivery fails after 3 attempts</li>
                </ul>
            </div>
        </div>

        <!-- Print Footer -->
        <div class="print-only text-center mt-8 text-sm text-slate-600">
            <p>Generated by Faciona Marketplace - {{ now()->format('F j, Y \a\t g:i A') }}</p>
            <p>This is an official shipping label. Please handle with care.</p>
        </div>
    </div>

    <script>
        // Auto-print when page loads (optional)
        // window.onload = function() { window.print(); }
    </script>
</body>
</html>

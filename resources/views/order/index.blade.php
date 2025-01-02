@php

function timeFormat($time){
    return (new \DateTime())->setTimeStamp($time)->format('Y-m-d H:i:s');
}

function totalEach($item, $quantity){
    return $item * $quantity;
}

$total = 0;

foreach ($orders as $item) {
    $total += $item['price'] * $item['quantity'];
}
@endphp

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 lg:pt-[3rem] pt-10">
            <div class="overflow-hidden shadow-sm sm:rounded-lg p-2">
                <div class="p-6 text-gray-900 backdrop-blur-lg rounded-md bg-slate-200 min-h-[28rem] text-sm sm:text-[17px]">
                    @if (!($orders->isEmpty()))
                    <div class="flex items-center justify-between pl-[40%] mb-4">
                        <h1 class="font-extrabold text-2xl text-center">Order List</h1>
                        <small class="">Date: {{(new \DateTime())->format('F j, Y')}}</small>
                    </div>
                   <div class="flex flex-col gap-6">
                    @foreach ($orders as $order)
                        <div class="border-2 border-gray-300 rounded-lg p-6 shadow-lg hover:shadow-xl shadow-black/50 hover:shadow-black/50 transition-shadow duration-300">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-xl font-semibold text-gray-800">Order #{{ $order->id }}</h3>
                                <span class="text-sm text-gray-500">{{ $order->created_at->format('F j, Y') }}</span>
                            </div>
                
                            <div class="mb-4">
                                <p class="font-medium text-gray-700">Address: <span class="font-normal">{{ $order->address }}</span></p>
                                <p class="font-medium text-gray-700">Status: <span class="font-normal capitalize">{{ $order->status }}</span></p>
                                <p class="font-medium text-gray-700">Total Amount: <span class="font-normal text-green-600">${{ number_format($order->total_price, 2) }}</span></p>
                            </div>
                
                            <div class="border-t border-gray-200 pt-4">
                                <h4 class="text-lg font-semibold text-gray-800 mb-2">Ordered Products:</h4>
                                @foreach ($order->ordered_products as $orderProduct)
                                    <div class="flex justify-between items-center border-b border-gray-100 py-2">
                                        <div class="flex flex-col">
                                            <p class="font-medium text-gray-700">Product: <span class="font-normal">{{ $orderProduct->products->name }}</span></p>
                                            <p class="font-medium text-gray-700">Quantity: <span class="font-normal">{{ $orderProduct->quantity }}</span></p>
                                        </div>
                                        <div class="flex flex-col items-end">
                                            <p class="font-medium text-gray-700">Price: <span class="font-normal text-blue-600">${{ number_format($orderProduct->products->price, 2) }}</span></p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                    @else
                        <div class="w-full h-full flex flex-col gap-4 justify-center items-center py-8">
                            <x-noCart/>
                            <h1 class="text-4xl m-auto text-center font-extrabold">You don't have any Ordered Item!</h1>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@php
    function timeFormat($time){
        return (new \DateTime())->setTimeStamp($time)->format('Y-m-d H:i:s');
    }

    function totalEach($item, $quantity){
        return $item * $quantity;
    }

    $total = 0;
    foreach ($cartItems as $item) {
        $total += $item['price'] * $item['quantity'];
    }
@endphp

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 lg:pt-[3rem] pt-10">
            <div class="overflow-hidden shadow-sm sm:rounded-lg p-6 bg-gradient-to-tl from-blue-50 via-blue-100 to-blue-200">
                <div class="p-6 text-gray-900 backdrop-blur-md rounded-lg bg-white/70 min-h-[28rem] text-sm sm:text-[17px]">
                    <div id="cartTable">
                        @if (!empty($cartItems))
                        <div class="flex items-center justify-between mb-4">
                            <h1 class="font-extrabold text-3xl text-center text-gray-800">Your Cart</h1>
                            <small class="text-gray-600">Date: {{(new \DateTime())->format('Y-m-d')}}</small>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full p-0 sm:p-4 table-auto border-separate border-spacing-2 rounded-lg shadow-lg bg-white">
                                <thead class="bg-blue-600 text-white">
                                    <tr>
                                        <th class="py-2 px-1 sm:px-4">No.</th>
                                        <th class="py-2 px-2 sm:px-4">Product</th>
                                        <th class="py-2 px-2 sm:px-4">Quantity</th>
                                        <th class="py-2 px-1 sm:px-4">Price</th>
                                        <th class="py-2 px-4 hidden sm:block">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($cartItems as $key => $item)
                                    <tr class="text-center text-gray-800 hover:bg-blue-50 transition duration-200">
                                        <td class="py-2 px-1 sm:px-4">{{ $item['index'] }}</td>
                                        <td class="py-2 px-2 sm:px-4 text-left md:text-center">{{ $item['name'] }}</td>
                                        <td class="py-2 px-2 sm:px-4">
                                            <input 
                                                type="number" 
                                                value="{{ $item['quantity'] }}" 
                                                min="1" 
                                                class="quantityChange w-16 text-black border border-gray-300 bg-transparent outline-none text-center rounded-lg p-1 transition duration-200 focus:ring-2 focus:ring-blue-500"
                                                data-item-id="{{ $key }}"
                                            />
                                        </td>
                                        <td class="py-2 px-1 sm:px-4">$ {{ $item['price'] }}</td>
                                        <td class="hidden sm:block py-2 px-4">$ {{ totalEach($item['price'], $item['quantity']) }}</td>
                                    </tr>
                                @endforeach
                                <tr class="font-semibold text-lg text-gray-800">
                                    <td class="hidden sm:block"></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-nowrap px1 sm:px-4 border-t-2 h-8 border-gray-400 text-center flex justify-between px-4">Total: <span>$ {{ $total }}</span></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <button id="formOpen" class="w-full font-extrabold cursor-pointer hover:bg-blue-700 hover:text-white text-white bg-blue-600 rounded-lg h-12 mt-6 transition duration-300 ease-in-out">
                            Proceed to Checkout
                        </button>

                    @else
                        <div class="w-full h-full flex flex-col gap-4 justify-center items-center py-8">
                            <x-noCart />
                            <h1 class="text-4xl m-auto text-center font-extrabold text-gray-800">Your Cart is Empty</h1>
                        </div>
                    </div>
                    @endif
                </div>

                @if(!empty($cartItems))
                <form class="hidden bg-white p-6 rounded-lg shadow-lg w-full max-w-lg mx-auto" method="POST" action="{{route('order.store')}}" id="orderForm">
                    @csrf
                    <input type="hidden" name="cartItems" value="{{json_encode($cartItems)}}">

                    <!-- Display Cart Items -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium">Your Products:</label>
                        <div class="space-y-2 h-40 overflow-y-auto border border-gray-300 p-2 rounded-lg shadow-sm">
                            @foreach($cartItems as $item)
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-800 font-medium">{{ $item['name'] }}</span>
                                    <span class="text-gray-600">x{{ $item['quantity'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="total" class="block text-gray-700 font-medium mb-2">Total Amount:</label>
                        <div class="flex items-center space-x-2">
                            <span class="text-xl text-green-500 font-bold">$</span>
                            <input type="text" name="total" value="{{$total}}" readonly class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="address" class="block mb-2 text-gray-700 font-medium">Delivery Address:</label>
                        <input type="text" name="address" required class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter your address" />
                    </div>

                    <div>
                        <input type="submit" value="Place Order" class="w-full font-extrabold cursor-pointer text-white bg-blue-600 rounded-lg h-12 hover:bg-blue-700 hover:text-white transition duration-300 ease-in-out" />
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

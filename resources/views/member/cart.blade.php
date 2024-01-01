<x-member-layout :user="$user">
    <div class="mx-auto mt-10 flex flex-row w-3/4  bg-white rounded p-7">
        <table class="table-fixed w-2/3 border-collapse rounded-md">
            <thead>
              <tr>
                <th class="rounded-s-md bg-slate-100 text-slate-500 text-left p-3">Item Detail</th>
                <th class="bg-slate-100 text-slate-500 text-left p-3">Price</th>
                <th class="rounded-e-md bg-slate-100 text-slate-500 text-left p-3">Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($carts as $item)
              <tr>
                <td class="px-3 py-5 border-b-8 border-white">
                  <div class="w-20 h-20 flex flex-row">
                    <img src="{{asset($item->product->image)}}" />
                  </div>
                </td>
                <td class="px-3 py-5 border-b-8 border-white">${{$item->price}}</td>
                <td class="px-3 py-5 border-b-8 border-white">
                  <div class="flex flex-row gap-2">
                    <form action="{{route('member.cart.destroy', $item->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                      <button type="submit">
                        <i class="w-4 h-4" data-feather="trash"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
              @empty    
              <tr v-else>
                <td colspan="3" class="text-center text-sm text-slate-300">
                    There is no item in your cart
                </td>
              </tr>
              @endforelse
              <tr>
                <td colspan="3" class="text-center text-sm text-slate-300">
                    <a href="{{route('ych-comission')}}" class="text-sm underline">Continue shopping for items</a>
                </td>
              </tr>
            </tbody>
        </table>
        <div class="w-1/3 flex flex-col">
            <div class="w-full flex flex-col justify-between mx-3 bg-slate-100 rounded">
                <div class="flex flex-col">
                    <div class="p-5">
                        <span>Order Summary</span>
                    </div>
                    <hr /> 
                    <div class="flex flex-col mt-3">
                        <div class="flex flex-row px-5 py-3">
                            <span>Subtotal</span>
                            <span class="ml-auto">${{$totalPrice}}</span>
                        </div>
                        <div class="flex flex-col px-5 py-3">
                            <span>Coupon Code</span>
                            <input type="text" class="w-3/4 rounded text-sm border border-gray-200" placeholder="Enter coupon code" />
                        </div>
                    </div>
                </div>
                <div class="flex flex-col">
                    <hr/>
                    <div class="flex flex-row p-5">
                        <div>Grand Total</div>
                        <div class="ml-auto">${{$totalPrice}}</div>
                    </div>
                </div>
            </div>
            <form action="{{route('member.cart.checkout')}}" method="POST">
              @csrf
              <button type="submit" class="mx-3 py-3 mt-3 w-full rounded bg-88-orange text-white uppercase">
                  Checkout
              </button>
            </form>
        </div>
    </div>
</x-member-layout>
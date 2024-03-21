<x-member-layout :user="$user">
    <div class="mx-auto mt-12 flex flex-row w-2/4 items-center justify-center">
        <div class="flex flex-col bg-white rounded p-7 items-center w-3/4">
            <div class="w-32 h-32">
                <img class="w-full h-full" src="{{ asset('pp.webp') }}" alt="">
            </div>
            <div class="py-3 px-24 w-full ">
                <div class="border rounded flex flex-col gap-3 p-6 w-full">
                    <div class="details flex flex-col">
                        <h3>Order Details</h3>
                        <span>{{$product->product_name}}</span>
                    </div>
                    <div class="date flex flex-col">
                        <h4>Date</h4>
                        <span>March 18, 2024</span>
                    </div>
                    <div class="price flex flex-col">
                        <div class="flex justify-between">
                            <span>Subtotal</span>
                            <span>$ {{$product->price}}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Total paid</span>
                            <span>$ {{$product->price}}</span>
                        </div>
                    </div>
                    <div class="w-full mt-5">
                        <form action="{{route('member.vtuber.download', $product->id)}}">
                            <button type="submit" class="w-full py-5 bg-88-orange rounded-full text-white">
                                <span class="text-xl">View Content</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-member-layout>


<script>

</script>
<x-member-layout :user="$user">
    <div class="mx-auto mt-10 flex flex-row w-3/4  bg-white rounded p-7">
        <div>
          <table class="table-fixed w-full border-collapse rounded-md">
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
                    <a href="{{route('ych-comission','static')}}" class="text-sm underline">Continue shopping for items</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="w-1/3 flex flex-col">
            <div class="overflow-auto w-full min-h-1/2-screen min-h-lvh max-h-lvh flex flex-col justify-between mx-3 bg-white rounded border">
                <div class="flex flex-col">
                    <div class="p-5 flex flex-col">
                        <h1 class="text-2xl mb-2">Commission Request</h1>

                        <div class="bg-slate-100 p-2 rounded">
                          <p>Requesting as <span class="capitalize">{{$user->name}}</span></p>
                        </div>
                    </div>
                    <hr /> 
                    <div class="flex flex-col mt-3 px-5 py-3 gap-7">
                        <div class=" mb-3">
                          <p>Once you submit your request, we'll review it to determine if we're the right fit for your needs. If so, we'll send you a proposal with your exact pricing and timing before we move forward. Please provide as much detail upfront as possible, thankyou!</p>
                        </div>
                        <form action="{{route('member.cart.checkout')}}" method="POST" enctype="multipart/form-data">
                          @csrf
                          <ol class="flex flex-col gap-10 p-3 list-decimal">
                            <li>
                              <div class="flex flex-col gap-1 ">
                                <p>Please provide any social media or any platform that you use (especially where we can contact you)</p>
                                <textarea name="socialMedia" class="w-full rounded text-sm border border-gray-200" placeholder="Social media" rows="5" required></textarea>
                              </div>
                            </li>
                            <li>
                              <div class="flex-col gap-1">
                                <p>How will you be using this work</p>
                                <div class="flex flex-col gap-1">
                                    <div class="flex items-center gap-1">
                                      <input type="radio" id="personal" name="useFor" value="personal" required>
                                      <label for="personal">Personal</label>
                                    </div>
                                    <div class="flex items-center gap-1">
                                      <input type="radio" id="streaming" name="useFor" value="streaming">
                                      <label for="streaming">Commercial/streaming</label>
                                    </div>
                                    <div class="flex items-center gap-1">
                                      <input type="radio" id="merchandise" name="useFor" value="merchandise">
                                      <label for="merchandise">Commercial/merchandise</label>
                                    </div>
                                    <div class="flex items-center gap-1">
                                      <input type="radio" id="other" name="useFor" value="other">
                                      <input type="text" name="useForOther" class="border-slate-200 px-3 py-2 w-full" placeholder="Other">
                                    </div>
                                </div>
                              </div>
                            </li>
                            <li>
                              <div class="flex flex-col gap-1">
                                <p>Please provide reference for your character and the emotes you need (preferably front view with proper lighting if there's any)</p>
                                <input type="file" name="refferences" required>
                              </div>
                            </li>
                            <li>
                              <div class="flex flex-col">
                                <p>Please specify your hard deadline if there's any</p>
                                <div class="bg-gray-100 rounded-2xl p-3">
                                    <div class="bg-gray-100 rounded-2xl">
                                      <input name="deadline" class="w-full bg-gray-100 border-transparent focus:border-transparent" type="text" id="datepicker" autocomplete="off">
                                    </div>
                                </div>
                              </div>
                            </li>
                            <li>
                              <div class="flex flex-col">
                                <p>Please send us proof of payment after you have paid</p>
                              </div>
                            </li>
                            <li>
                              <div class="flex flex-col gap-1">
                                <p>If you have ordered from us before and you want to use the same character for your request please send a screenshot of that previous work</p>
                                <input type="file" name="latestDesign">
                              </div>
                            </li>
                            {{-- <li>
                              <div class="flex flex-col gap-1">
                                <label for="cars">Feel free to choose a promotional voucher in case you possess one.</label>
                                <select class="rounded-2xl" name="cars" id="cars">
                                  <option value="volvo">Volvo</option>
                                  <option value="saab">Saab</option>
                                  <option value="mercedes">Mercedes</option>
                                  <option value="audi">Audi</option>
                                </select>
                              </div>
                            </li> --}}
                          </ol>
                          <button type="submit" class="py-3 mt-3 w-full rounded bg-88-orange text-white uppercase">
                              Submit
                          </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-member-layout>


<script>
   $(document).ready(function() {
        // Initialize the datepicker
        $("#datepicker").datepicker({
          minDate: 0
        });
    });
</script>
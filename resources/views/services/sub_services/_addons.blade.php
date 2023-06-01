<form action="{{ route('viewsubservice.quote') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="card drop-shadow-2xl bg-white mb-5">
        <div class="card-body">
            <h3 class="font-bold text-2xl">{{ $subservice->name }}</h3>
            <br>

            <input type="hidden" name="subservice_id" value="{{ $subservice->id }}">
            <input type="hidden" name="qty" value="1">
            <table class="table mb-5 w-full border-collapse">
                <thead>
                    <tr>
                        <th scope="col p-2.5 text-left font-semibold text-lg border-b-2 border-[#333] text-[#333]">
                            <h4 class="text-kayise-blue">Add-Ons</h4>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($options as $option)
                    <tr id="addonrow{{ $option->id }}">

                        <td class="d-flex align-items-center">

                            <div class="inline mr-4">
                                <input type="hidden" name="options[{{ $option->id }}][name]" value="{{ $option->name }}">
                                <input type="hidden" name="options[{{ $option->id }}][price]" value="{{ $option->price }}">
                                <input type="checkbox" name="options[{{ $option->id }}][id]" data-thapelo="{{ $option->id }}" id="option{{ $option->id }}">
                                <label for="option{{ $option->id }}">{{ $option->name }}</label>
                            </div>
                            @if($option->quantified)
                            <div class="qty_count inline">
                                <input type="number" name="options[{{ $option->id }}][qty]" id="option{{ $option->id }}_qty">
                            </div>
                            @else
                            <input type="hidden" name="options[{{ $option->id }}][qty]" id="option{{ $option->id }}_qty" value="1">
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
            <br>
            @if(Auth::check())
            <button class="inline-flex items-center px-4 py-2 bg-kayise-blue border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:brightness-150 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" type="submit">Request Quotation</button>
            @else
            <button type="button" id="loginModal-btn" class="inline-flex items-center px-4 py-2 bg-kayise-blue border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:brightness-150 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" data-toggle="loginModal" data-target="#loginModal">Request Quotation</button>
            @endif
        </div>
    </div>
</form>
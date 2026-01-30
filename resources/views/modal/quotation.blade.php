<div class="container py-20">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header font-bold md:text-2xl"><span>Get a quotation for :</span></div>
                <div class="card-body">

                    <h1>{{ $subservice->name }}</h1>
                    <p>{{ $subservice->description }}</p>
    
                    <form action="{{ route('viewsubservice.quote') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="subservice_id" value="{{ $subservice->id }}">
                        <table class="table">
                            <thead>
                               <tr>
                                    <th scope="col"><h2>Add-Ons</h2></th>
                               </tr>
                            </thead>
                            <tbody>
                                @foreach($options as $option)
                                <tr>
                                    <td> <input type="checkbox" name="option_ids[]" value="{{ $option->id }}">{{ $option->name }} </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if (Auth::check())
                        <button style="background-color: #64bc5c" class="btn btn-success m-3" type="submit">Request Quotation</button>
                        @else
                        <a href="{{ route('login') }}" class="btn btn-success m-3">Request Quote</a>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
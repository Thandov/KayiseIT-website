<x-app-layout>
   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         {{ __('Get A Quotation') }}
      </h2>
   </x-slot>
   <div class="container py-20">
      <div class="row justify-content-center">
         <div class="col-md-8">
            <div class="card">
               <div class="card-header font-bold md:text-2xl"><span>Get a quotation for :</span></div>
               <div class="card-body">





    <h1>{{ $subservice->name }}</h1>
    <p>{{ $subservice->description }}</p>

    <br>
    
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

        <br>
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

</x-app-layout>

<style>
/* Style for the header section */
.x-app-layout h2 {
    font-size: 24px;
    font-weight: 600;
    color: #333;
}

/* Style for the container */
.container {
    margin: 0 auto;
    padding: 20px;
    max-width: 800px;
}

/* Style for the card */
.card {
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    margin-bottom: 20px;
}

/* Style for the card header */
.card-header {
    background-color: #333;
    color: #fff;
    font-size: 20px;
    font-weight: 600;
    padding: 15px;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
}

/* Style for the card body */
.card-body {
    padding: 20px;
}

/* Style for the heading */
h1 {
    font-size: 28px;
    font-weight: 600;
    color: #333;
}

/* Style for the paragraph */
p {
    font-size: 16px;
    line-height: 1.5;
    color: #555;
}

/* Style for the table */
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

/* Style for the table head */
thead th {
    font-size: 18px;
    font-weight: 600;
    color: #333;
    padding: 10px;
    text-align: left;
    border-bottom: 2px solid #333;
}

/* Style for the table body */
tbody td {
    font-size: 16px;
    line-height: 1.5;
    color: #555;
    padding: 10px;
    border-bottom: 1px solid #eee;
}

/* Style for the button */
.btn {
    display: inline-block;
    font-size: 16px;
    font-weight: 600;
    color: #fff;
    background-color: #333;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    cursor: pointer;
}

/* Style for the button on hover */
.btn:hover {
    background-color: #555;
}

/* Style for the success button */
.btn-success {
    background-color: green;
}

/* Style for the margin */
.m-3 {
    margin: 15px;
}
</style>

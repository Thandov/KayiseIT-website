<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ADD New Service') }}
        </h2>
    </x-slot>
    @if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            

    
        <form action="{{ route('newaddservice.storing', $service->id) }}" method="post">
  @csrf


<br>
<div class="card">
    <div class="form-group">
        <div class="card-header"><label for="subservices">Subservices</label></div>
        <div class="card-body">
            <div id="subservices">
                <!-- Add dynamic subservices here -->
            </div>
            <button type="button" class="btn btn"  style="background-color : grey" id="addSubservice">Add Subservice</button>
        </div>
        <button type="submit" style="background-color : blue" class="btn btn-primary">Submit</button>
    </div>
    
</div>



</form>


           
        </div>
    </div>
</div>
</x-app-layout>

<script>
  $(document).ready(function() {
    var subserviceCounter = 0;

    $('#addSubservice').click(function() {
      var subserviceName = 'subservice_name_[]' + subserviceCounter;
      var subserviceDescription = 'subservice_description_[]' + subserviceCounter;
      var subservicePriceType = 'subservice_price_type_[]' + subserviceCounter;
      var subservicePrice = 'subservice_price_[]' + subserviceCounter;
      var subserviceOptionsContainer = 'subservice_options_container_' + subserviceCounter;
      $('#subservices').append(
        '<input type="text" name="' + subserviceName + '" placeholder="subservice name" class="form-control mb-2">' +
        '<textarea name="' + subserviceDescription + '" placeholder="subservice description" class="form-control mb-2"></textarea>' +
        '<select name="' + subservicePriceType + '" class="form-control mb-2">' +
          '<option value="static">Static Price</option>' +
          '<option value="dynamic">Dynamic Price</option>' +
        '</select>' +
        '<div class="' + subserviceOptionsContainer + '" style="display: none;"></div>'  +
        '<input type="number" name="' + subservicePrice + '" placeholder="subservice price" class="form-control mb-2 ' + subserviceOptionsContainer + '"><br>' 
      );

      $('[name="' + subservicePriceType + '"]').change(function() {
        if ($(this).val() === 'static') {
          $('.' + subserviceOptionsContainer).hide();
          $('[name="' + subservicePrice + '"]').show();
        } else {
          $('.' + subserviceOptionsContainer).show();
          $('[name="' + subservicePrice + '"]').hide();
        }
      });
      
      var optionCounter = 0;
      $('.' + subserviceOptionsContainer).append(
        '<button type="button" class="btn btn" id="addOption_' + subserviceCounter + '" style="background-color : grey">Add Option</button><br><br>'
      );
      $('#addOption_' + subserviceCounter).click(function() {
        var optionName = 'subservice_option_name_[]' + subserviceCounter + '_' + optionCounter;
        var optionPrice = 'subservice_option_price_[]' + subserviceCounter + '_' + optionCounter;
        $('.' + subserviceOptionsContainer).append(
          '<input type="text" name="' + optionName + '" placeholder="option name" class="form-control mb-2">' +
          '<input type="number" name="' + optionPrice + '" placeholder="option price" class="form-control mb-2">' +
          '<br>'
        );
        optionCounter++;
      });

      subserviceCounter++;
    });
  });

</script>

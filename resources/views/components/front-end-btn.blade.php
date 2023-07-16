<?php
if ($color === "red") :
    $color = "rounded-md bg-red-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600"; ?>
    <input type="submit" value="Delete" class="{{$color}}">
<?php elseif ($color === "blue") :
    $color = "rounded-md bg-blue-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600"; ?>
    <a href="{{ $linking }}" class="{{$color}}" id="{{$showme}}">{{$name}}</a>
<?php
endif;
?>
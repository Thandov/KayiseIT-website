<?php
if ($color === "red") :
    $color = "rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600"; ?>
    <input type="submit" value="Delete" class="capitalize {{ $color }}">
<?php elseif ($color === "submit") :
    if ($name = "delete") {
        $color = "rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600";
    } else {
        $color = "rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600";
    }
?>
    <input type="submit" value="{{ $name }}" class="capitalize {{ $color }}">
<?php elseif ($color === "blue") :
    $color = "rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"; ?>
    <a href="{{ $linking }}" class="capitalize {{ $color }}" id="{{ $showme }}">{{ $name }}</a>
<?php
endif;
?>
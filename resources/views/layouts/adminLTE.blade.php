
        
<?php
    // root est la racine de notre css courrant
    $root = 'adminLTE';
?>

@include('layouts.partials.header')

@include('layouts.partials.left')


<div class="content-wrapper">
    @yield('content')
</div>

@include('layouts.partials.footer')
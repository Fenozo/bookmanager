
        
<?php
    // root est la racine de notre css courrant
    $root = 'adminLTE';
?>

@include('layouts.frontOffice.partials.header')

@include('layouts.frontOffice.partials.left')


<div class="content-wrapper">
    @yield('content')
</div>

@include('layouts.frontOffice.partials.footer')
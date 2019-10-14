
        
<?php
    // root est la racine de notre css courrant
    $root = 'adminLTE';
?>

@include('layouts.backOffice.partials.header')

@include('layouts.backOffice.partials.left')


<div class="content-wrapper">
    @yield('content')
</div>

@include('layouts.backOffice.partials.footer')
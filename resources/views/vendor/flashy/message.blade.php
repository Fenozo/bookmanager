
<div id="flashy-template" >
@if(Session::has('flashy_notification.message'))
    <div class="flashy flashy--{{ Session::get('flashy_notification.type') }}">
        <a href="#" class="flashy__body" target="_blank"></a>
    </div>
@endif
</div>
<input type="hidden" id="flashy" data-message="{{ Session::get('flashy_notification.message') }}" data-link="{{ Session::get('flashy_notification.link') }}">
@if(Session::has('flashy_notification.message'))
<script>
    flashy("{{ Session::get('flashy_notification.message') }}", "{{ Session::get('flashy_notification.link') }}");
</script>
@endif
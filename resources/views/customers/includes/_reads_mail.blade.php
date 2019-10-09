@if ($customer->reads_mail)
    <span class="fas fa-eye green" title="Reads mail"></span>
@else
    <span class="fas fa-eye-slash grey" title="Not sure"></span>
@endif
@if ($customer->accepts_mail)
    <span class="fas fa-envelope-open green" title="Accepts emails"></span>
@else
    <span class="fas fa-envelope orange" title="Has unsubscribed"></span>
@endif
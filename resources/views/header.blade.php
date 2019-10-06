<img src="/img/admin-mailer-header.png" alt="Header" width="100%" height="260">
<div class="mt-n5">
    <div id="admin-links" class="list-group list-group-horizontal">
        <a href="{{ route($prefix . 'index') }}"
           class="list-group-item list-group-item-action bg-transparent border-0 align-center">
            <span class="bigger-120">Start</span>
        </a>
        <a href="{{ route($prefix . 'campaigns.index') }}"
           class="list-group-item list-group-item-action bg-transparent border-0 align-center">
            <span class="bigger-120">Campaigns</span>
        </a>
        <a href="{{ route($prefix . 'emails.index') }}"
           class="list-group-item list-group-item-action bg-transparent border-0 align-center">
            <span class="bigger-120">Emails</span>
        </a>
        <a href="{{ route($prefix . 'lists.index') }}"
           class="list-group-item list-group-item-action bg-transparent border-0 align-center">
            <span class="bigger-120">Lists</span>
        </a>
        <a href="{{ route($prefix . 'customers.index') }}"
           class="list-group-item list-group-item-action bg-transparent border-0 align-center">
            <span class="bigger-120">Customers</span>
        </a>
        <a href="{{ route($prefix . 'logs.index') }}"
           class="list-group-item list-group-item-action bg-transparent border-0 align-center">
            <span class="bigger-120">Tracking</span>
        </a>
    </div>
</div>
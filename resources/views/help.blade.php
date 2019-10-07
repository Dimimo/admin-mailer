<div class="box-rounded-grey my-4">
    <h4>How does it work?</h4>
    <p class="text-justify">
        This package takes care of mass mailing potential customers. It is designed with ease of use in mind.
        There are 4 main parts that make it all work. In the background it also has a tracking system.
    </p>
    <p class="text-justify">
        Overall, these are the steps needed to send out mass mails to customers:
    </p>
    <ol>
        <li>
            On the one hand, <a href="{{ route($prefix . 'customers.index') }}">customers</a> are at the hart of the
            program. That's where the email addresses are. Before creating customers, you need to:
        </li>
        <li>
            Create <a href="{{ route($prefix . 'lists.index') }}">lists</a>. These lists are a collection of customers.
            It are these lists that are connected to Campaigns. A Campaign can have many lists and a list can be part
            of several Campaigns. Read on to understand the best strategy how it should be done.
        </li>
        <li>
            <a href="{{ route($prefix . 'campaigns.index') }}">Campaigns</a> bring it all together. Customers through
            lists and emails created in Campaigns. In a sense, Campaigns are time independent. Emails are not.
        </li>
        <li>
            <a href="{{ route($prefix . 'emails.index') }}">Emails</a> are created in Campaigns. It has a title and a
            body, that represent the email you are going to send to each customer. You can make use of magical options.
            Creating an email does not yet send it, so don't worry to try stuff. You will be notified without a shred
            of doubt when you are going to send the email out to the connected customers. There is a handy copy
            function, just in case you want to use the same email in different campaigns.
        </li>
    </ol>
    <p class="text-justify">
        <u>Great care is taken in explaining what the input fields mean.</u> Please make use of the information
        provided.
    </p>
    <p class="text-success text-justify">
        When you create an email, don't worry. <i>You have to make extra moves</i> to really send it out to the
        customers. You can send it to yourself and see how it would look like. You can make as many adaptions as you
        wish and send it to yourself as many times you like.
    </p>
    <p class="text-justify">
        When you are happy with the Campaign, connected customers and the email, it's time to send it out. You can
        still have a last checkup if all is to your wish. <span class="text-danger">Once you start the process of
        sending the email to all customers, there is NO way back.</span>
    </p>
    <p class="text-justify">
        The emails are send in <strong>real time</strong>. <u>It is your browser that loops through all customers and
            instructs the server to send them out</u>. One by one. <strong>This is the reason why you don't refresh the
            browser during the process.</strong> As a bonus, you have a reply to your browser as the emails are send out
        one by one. Just wait until the process is done. It should take about <strong>one second per email</strong>.
    </p>
    <hr>

    <h4>A word about organisation:</h4>
    <p class="text-justify">
        Although Campaigns hold it all together, it are the lists that are at the heart of the organisation. With the
        purpose of Campaigns in mind, you should organise the lists accordingly. The reason why it is done this way is
        because every customer can be part of <strong>only</strong> one list. This is to avoid spamming-like activity
        by having the same customer in several lists.
    </p>
    <p class="text-justify">
        In other words: if you plan Campaigns on geographical importance, you should group customers in geographical
        nominations. If you plan to create Campaigns on speciality (hotel owners for example), you should create
        lists based on this goal. Of course you can do both, resulting in a lot of lists. That is not a problem in
        itself. The choice is yours.
    </p>
    <p class="text-justify">
        <strong>Important is that you give both lists and Campaigns a meaningful name</strong> so it's easier to have
        an overview of what is what and who is who. For example <i>Cebu Hotels</i> or <i>All universities</i> in
        lists and <i>Hotel owners</i> or <i>Education</i> in Campaigns.
    </p>
    <hr>

    <h4>Tracking</h4>
    <p class="text-justify">
        There is a tracking feature build in the send mails. How it works is that the top image is not an image at all.
        In reality it's a link to a part of the program that figures out who is reading the email, informs the
        database, and sends a picture back to the email client of the customer.
    </p>
    <p class="text-justify">
        Although this technique is widely used by even the biggest corporations like Microsoft, Google and Netflix,
        it's not failsafe. Many email clients have the option to not show the pictures by default. If that's the case
        the customer can read the email but we won't know.
    </p>
    <p class="text-justify">
        Every email send creates an entry in the database where the customer and email are linked. This database table
        is where tracking information is collected. There is also a flag in the customer table itself, that shows you
        if a customer reads emails <span class="fas fa-eye green"></span> or not <span
                class="fas fa-eye-slash grey"></span>. This is purely informational and has no influence at all on the
        overall process of future Campaigns or emails.
    </p>
    <p class="text-justify">
        But then again: this technique is not failsafe.
    </p>
    <hr>

    <h4>Unsubscribe</h4>
    <p class="text-justify">
        Every email has a unique unsubscribe link at the bottom. <strong>This is both for legal reasons and
            courtesy.</strong> Don't forget we are the ones who contact them. Not the other way around.
    </p>
    <p class="text-justify">
        Once a customer clicks the link, the person will automatically be unsubscribed. There is a re-subscribe link
        just in case it was clicked by accident. The unsubscription page is no-nonsense. We don't ask 'Why?' or 'Are you
        sure?' It's just done. No hassle.
    </p>
    <p class="text-justify">
        If someone unsubscribes, the customer still is in the list, but won't receive emails anymore. If you look at
        customers overview, you will see the <span class="fas fa-envelope orange"></span> symbol. Although you can
        manually re-subscribe the customer, this is <strong>not recommended</strong>. Unless they ask us by email.
    </p>
    <p class="text-justify">
        If they choose to unsubscribe, so be it!
    </p>
</div>
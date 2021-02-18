<div class="contact-form">
    <form class="form-horizontal" method="post">
        <header class="head-form">
        <h2>E-Mail</h2>
        <p>Sie können hier eine Email an uns schreiben.</p>
        </header>
        <div class="field-set">
            <div class="form-group">
                <label style="padding-top: 20px;">Name</label>
                <input class="form-input" id="name" type="text"  name="userName">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input class="form-input" id="email" type="text" name="userEmail">
            </div>
            <div class="form-group">
                <label>Betreff</label>
                <input class="form-input" id="subject" type="text" name="subject">
            </div>
            <div class="form-group">
                <label>Nachricht</label> <br>
                <textarea type="text" id="message" name="content" cols="60" rows="6"></textarea>
            </div>
        </div>
        <div>
            <input class="save" id="send" type="submit" name="send" value="Send">
        </div>
    </form>
</div>
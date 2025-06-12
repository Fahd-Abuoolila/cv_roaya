<form action="settings" method="POST" id="setting_form_mood">
</form>
<script>
    let li_settings = document.querySelector('#settings');
    let setting_form_mood = document.querySelector('#setting_form_mood');

    li_settings.addEventListener('click', function(event) {
        event.preventDefault();
        let target = this.getAttribute('href');
        console.log(target);
        if(target == 'settings'){
            setting_form_mood.innerHTML += "<input type='hidden' name='mood' value='create'>";
        }
        setting_form_mood.setAttribute('action', target);
        setting_form_mood.submit();
    });
</script>
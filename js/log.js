function show_password() {
    let show = document.querySelector('#show');
    let pass = document.querySelector('#pass_1');
    if (pass.type == 'password') {
        pass.type = 'text';
        show.classList.remove('fa-eye-slash');
        show.classList.add('fa-eye');
    } else {
        pass.type = 'password';
        show.classList.add('fa-eye-slash');
        show.classList.remove('fa-eye');
    }
}

function show_password_check() {
    let show = document.querySelector('#show_check');
    let pass_check = document.querySelector('#pass_check');
    if (pass_check.type == 'password') {
        pass_check.type = 'text';
        show.classList.remove('fa-eye-slash');
        show.classList.add('fa-eye');
    } else {
        pass_check.type = 'password';
        show.classList.add('fa-eye-slash');
        show.classList.remove('fa-eye');
    }
}

// login
window.addEventListener('online', function () {
    const offlineAlert = document.getElementById('offline-alert');
    if (offlineAlert) {
        offlineAlert.remove();
    }
    const onlineAlert = document.createElement('div');
    onlineAlert.id = 'online-alert';
    onlineAlert.innerText = 'تم استعادة الاتصال بالإنترنت';
    onlineAlert.style.cssText = `
        position: fixed;
        top: 10px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #13b670;
        color: #000;
        padding: 10px 20px;
        border-radius: 5px;
        z-index: 1000;
        font-size: 16px;
        font-weight: bold;
    `;
    document.body.appendChild(onlineAlert);
    setTimeout(() => {
        onlineAlert.remove();
    }, 3000);
});
window.addEventListener('offline', function () {
    const offlineAlert = document.createElement('div');
    offlineAlert.id = 'offline-alert';
    offlineAlert.innerText = 'الإنترنت غير متصل، برجاء التحقق من الاتصال بالإنترنت';
    offlineAlert.style.cssText = `
        position: fixed;
        top: 10px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #ff0000;
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px;
        z-index: 1000;
        font-size: 16px;
        font-weight: bold;
    `;
    document.body.appendChild(offlineAlert);
});
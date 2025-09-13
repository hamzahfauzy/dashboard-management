function doLogin(){
    const formData = new FormData;
    formData.append('username', $('#signInUsername').val())
    formData.append('password', $('#signInPassword').val())
    fetch('/login', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(res => {
        if(res.message == 'success')
        {
            window.location = '/dashboard'
        }
        else
        {
            alert('Login gagal, silahkan periksa kembali username / email / no. hp dan password')
        }
    })
    .catch(error => {
        alert('Login gagal, silahkan periksa kembali username / email / no. hp dan password')
    })

    return false
}
$('#createUser').click(function(){
    const formData = new FormData;
    formData.append('code', $('#createForm').find('#code').val())
    formData.append('name', $('#createForm').find('#name').val())
    formData.append('username', $('#createForm').find('#username').val())
    formData.append('password', $('#createForm').find('#password').val())
    formData.append('level', $('#createForm').find('#level').val())

    fetch('/users', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(res => {
        alert(res.message)
        if(res.message == 'insert data success')
        {
            window.location.reload()
        }
    })
    .catch(error => alert(error))
})

$('#editUser').click(function(){
    const formData = new FormData;
    const id = $('#editForm').find('#id').val()
    formData.append('_method', 'PUT')
    formData.append('code', $('#editForm').find('#code').val())
    formData.append('name', $('#editForm').find('#name').val())
    formData.append('username', $('#editForm').find('#username').val())
    formData.append('password', $('#editForm').find('#password').val())
    formData.append('level', $('#editForm').find('#level').val())

    fetch('/users?id=' + id, {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(res => {
        alert(res.message)
        if(res.message == 'update data success')
        {
            window.location.reload()
        }
    })
    .catch(error => alert(error))
})

$('.deleteBtn').click(function(){
    if(!confirm('Apakah anda yakin akan menghapus data ini ?')) return
    const id = $(this).data('id')

    fetch('/users?id=' + id, {
        method: 'DELETE',
    })
    .then(res => res.json())
    .then(res => {
        alert(res.message)
        if(res.message == 'delete data success')
        {
            window.location.reload()
        }
    })
    .catch(error => alert(error))
})

$('.editBtn').click(function(){
    const id = $(this).data('id')

    fetch('/user?id=' + id)
    .then(res => res.json())
    .then(res => {
        if(res.message == 'data retrieved')
        {
            $('#editForm').find('#id').val(res.data.id)
            $('#editForm').find('#code').val(res.data.code)
            $('#editForm').find('#name').val(res.data.name)
            $('#editForm').find('#username').val(res.data.username)
            $('#editForm').find('#password').val(res.data.password)
            $('#editForm').find('#level').val(res.data.level)
        }
        else
        {
            alert(res.message)
        }
    })
    .catch(error => alert(error))
})
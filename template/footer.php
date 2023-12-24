    
</body>
<script>
    let password = document.getElementById('password');
    let show = document.getElementById('show');

    let cpassword = document.getElementById('cpassword');
    let cp_show = document.getElementById('cp_show');
    show.addEventListener('click', ()=>{
        if(password.type == 'password'){
            password.type='text';
            show.className = 'bi bi-eye-slash-fill';
        }else{
            password.type='password';
            show.className = 'bi bi-eye-fill';
        }
    });
    cp_show.addEventListener('click', ()=>{
        if(cpassword.type == 'password'){
            cpassword.type='text';
            cp_show.className = 'bi bi-eye-slash-fill';
        }else{
            cpassword.type='password';
            cp_show.className = 'bi bi-eye-fill';
        }
    });
</script>
</html>
<template>
  <div>
    <form  v-on:submit.prevent="onSubmit" class="cool-form" >
      <h1>Авторизация главного администратора</h1>
      <div>
        <p><label>Введите логин: </label></p>
        <input class="input-cool" id="inpLoginMainAdmin"  type="password" placeholder="Логин"/>
      </div>
      <div>
        <p><label>Введите пароль: </label></p>
        <input class="input-cool" id="inpPassMainAdmin"  type="password" placeholder="Пароль"/>
      </div>
      <hr>
      <div>
        <button class="cool-button"  type="button" id="butLog" @click="authorize">Войти</button>
      </div>
    </form>
  </div>
</template>

<script>
import router from '../router/router'
import Swal from "sweetalert2";

export default {
  data() {
    return {
    }
  },

  methods: {

    authorize: function () {
      let login = document.getElementById("inpLoginMainAdmin").value;
      let pass = document.getElementById("inpPassMainAdmin").value;

      if (login == "superSECRETlogin" && pass == "superSECRETpass") {
        Swal.fire({
          icon: 'success',
          title: 'Успех!',
          text: 'Вы успешно авторизировались!',
        })

        router.replace('mainAdmin')

        document.getElementById('Main_Admin_page').style.display = "inline";

        document.getElementById('Login').style.display = "none";
        document.getElementById('Regis').style.display = "none";
        document.getElementById('Admin').style.display = "none";
        document.getElementById('MainAdmin').style.display = "none";
        document.getElementById('Home').style.display = "none";

        document.getElementById('Exit').innerHTML = "Выйти";
        document.getElementById('Exit').style.display = "inline";

      }
      else {
              Swal.fire({
                icon: 'error',
                title: 'Произошла ошибка!',
                text: 'Проверьте корректность введённых данных.',
              })
      }
    }
  }
}
</script>

<style>
.cool-form{
  text-align: center;
  width: fit-content !important;
  max-width: max-content;
  margin: 10% auto auto;
  background-color: white;
  border-radius: 20px;
  padding: 0px 20px 20px 20px;
}
.input-cool{
  height: 20px;
  border-radius: 5px;
  width: 100%;
}
.cool-button{
  display: inline;
  background-color: #ccffd3;
  border-radius: 8px;
  border: 1px black solid;
  font-size: 16px;
}
</style>

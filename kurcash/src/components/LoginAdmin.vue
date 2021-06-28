<template>
  <div>
    <form v-on:submit.prevent="onSubmit" class="cool-form">
      <h1>Авторизация администратора</h1>
      <div>
        <p><label>Введите адрес электронной почты: </label></p>
        <input class="input-cool" id="inpEmailAdm" required v-model="emailAdm" type="email" placeholder="Адрес электронной почты"/>
      </div>
      <div>
        <p><label>Введите пароль: </label></p>
        <input class="input-cool" id="inpPassAdm" required v-model="passwordAdm" type="password" placeholder="Введите пароль"/>
      </div>
      <hr/>
      <div>
        <button class="cool-button" style="display: inline"  type="button" id="butLog" @click="authorize">Войти</button>
      </div>
    </form>
  </div>
</template>

<script>
import axios from 'axios'
import router from '../router/router'
import Swal from "sweetalert2";


export default {
  data() {
    return {
      emailAdm: "",
      passwordAdm: "",
    }
  },

  methods: {

    authorize: function () {
      let email = document.getElementById("inpEmailAdm").value;
      let pass = document.getElementById("inpPassAdm").value;
      let params = {email: `${email}`, pass: `${pass}`};
      let this_Comp = this;
      axios
          .get("http://localhost/loginAdmin.php", {params})

          .then(function (response) {

            console.log(response.data.result); //вывод в консоль информации об успешности авторизации

            if (response.data.result) {
              this_Comp.$store.commit('SET_Is_Auth', true)
              router.replace('admin');

              document.getElementById('Name_Surname').innerHTML = "Администратор";
              document.getElementById('Name_Surname').style.display = "inline";

              document.getElementById('Login').style.display = "none";
              document.getElementById('Regis').style.display = "none";
              document.getElementById('Admin').style.display = "none";
              document.getElementById('Home').style.display = "none";

              document.getElementById('Admin_page').style.display = "inline";

              document.getElementById('Exit').innerHTML = "Выйти";
              document.getElementById('Exit').style.display = "inline";
            }
            else {
              Swal.fire({
                icon: 'error',
                title: 'Произошла ошибка!',
                text: 'Проверьте правильность введённых данных! Если Вы - пользователь, пожалуйста, воспользуйтесь разделом «Авторизоваться»',
              })
            }
          });
    },
  }
}
</script>
<template>
  <div>
    <form  v-on:submit.prevent="onSubmit" class="cool-form" >
      <h1>Авторизация</h1>
      <div>
        <p><label>Введите адрес электронной почты: </label></p>
        <input class="input-cool" id="inpEmail" required v-model="email" type="email" placeholder="Адрес электронной почты"/>
      </div>
      <div>
        <p><label>Введите пароль: </label></p>
        <input class="input-cool" id="inpPass" required v-model="password" type="password" placeholder="Введите пароль"/>
      </div>
      <hr>
      <div>
        <button class="cool-button"  type="button" id="butLog" @click="authorize">Войти</button> |
        <button class="cool-button"  type="button" id="butGoToReg" @click="goToReg">Зарегистрироваться</button>
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
      email: "",
      password: "",
    }
  },

  methods: {

    authorize: function () {
      let email = document.getElementById("inpEmail").value;
      let pass = document.getElementById("inpPass").value;
      let params = {email: `${email}`, pass: `${pass}`};
      let this_Comp = this;
      axios
          .get("http://localhost/login.php", {params})

          .then(function (response) {

            console.log(response.data.result); //вывод в консоль информации об успешности авторизации

            if (response.data.result) {
              this_Comp.$store.commit('SET_ID',response.data.user_id);
              this_Comp.$store.commit('SET_Name',response.data.name);
              this_Comp.$store.commit('SET_Surname',response.data.surname)
              this_Comp.$store.commit('SET_Is_Auth', true)
              let id = this_Comp.$store.getters.GET_ID;
              let params = {id: `${id}`};
              axios
                  .get("http://localhost/insertLogin.php", {params})

              router.replace('home');

              document.getElementById('Name_Surname').innerHTML = this_Comp.$store.getters.GET_Name + " " + this_Comp.$store.getters.GET_Surname;
              document.getElementById('Name_Surname').style.display = "inline";

              document.getElementById('LichnKab').style.display = "inline";

              document.getElementById('Login').style.display = "none";
              document.getElementById('Regis').style.display = "none";
              document.getElementById('Admin').style.display = "none";
              document.getElementById('MainAdmin').style.display = "none";

              document.getElementById('Home').style.display = "inline";

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
          });
    },

    goToReg: function () { //тут переход к регистрации из авторизации
      router.replace('register')
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
